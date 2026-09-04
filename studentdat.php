<?php
include "db_conn.php";
session_start();

// Resolve where a student's saved photo actually lives on disk.
// Photos may be in the current student_profile/ folder, directly in
// images/, or in some other legacy subfolder from before this upload
// page existed — so after checking the two known spots, fall back to
// searching the whole images/ tree for a file with this exact name.
function resolveStudentPicUrl($pic)
{
  if (empty($pic)) {
    return null;
  }

  $picClean = ltrim(str_replace('\\', '/', $pic), '/');
  $needle = basename($picClean);

  // Fast path: the two locations we expect.
  $candidates = [
    'images/student_profile/' . $needle,
    'images/' . $picClean, // in case the DB value already includes a subfolder
    'images/' . $needle,
  ];
  foreach ($candidates as $rel) {
    if (file_exists(__DIR__ . '/' . $rel)) {
      return $rel;
    }
  }

  // Fallback: search every subfolder under images/ for this filename.
  $imagesRoot = __DIR__ . '/images';
  if (is_dir($imagesRoot)) {
    $it = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($imagesRoot, FilesystemIterator::SKIP_DOTS)
    );
    foreach ($it as $file) {
      if ($file->isFile() && strcasecmp($file->getFilename(), $needle) === 0) {
        $relPath = str_replace('\\', '/', substr($file->getPathname(), strlen(__DIR__) + 1));
        return $relPath;
      }
    }
  }

  return null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <title>CERTIFICATE MANAGEMENT SYSTEM</title>
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="lightbox.min.css">
  <script src="lightbox-plus-jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap');

    :root {
      --dark: #1a120b;
      --dark-2: #2b1d13;
      --gold: #d4af37;
      --gold-soft: #c9a227;
      --gold-pale: #f0e2b8;
      --accent: #c1663b;
      --cream: #f2ece1;
      --cream-card: #fffdf9;
      --box: #f4ecdf;
      --border: #e8dfc9;
      --muted: #8a7d6b;
      --radius: 20px;
      --shadow: 0 10px 28px rgba(120, 100, 60, 0.10);
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      margin: 0;
      padding: 0;
      width: 100%;
      min-height: 100vh;
      overflow-x: hidden;
      font-family: 'Poppins', sans-serif;
      background: var(--cream);
      color: var(--dark);
    }

    .n {
      text-decoration: none;
    }

    /* ---------- Top navbar ---------- */
    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 14px;
      padding: 18px 32px;
      background: linear-gradient(120deg, var(--dark) 0%, var(--dark-2) 100%);
      width: 100%;
    }

    .brand {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      font-size: 1.5rem;
      color: #fff;
      letter-spacing: 0.3px;
    }

    .brand span {
      color: var(--gold);
    }

    .nav-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .nav-actions #btn1 {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 10px 22px;
      background: transparent;
      color: var(--gold-pale);
      border: 1px solid var(--gold-soft);
      border-radius: 999px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 0.75rem;
      letter-spacing: 0.4px;
      cursor: pointer;
      transition: all 0.25s ease;
      text-transform: uppercase;
      white-space: nowrap;
    }

    .nav-actions #btn1:hover {
      background: var(--gold);
      color: var(--dark);
      border-color: var(--gold);
    }

    .nav-actions .logout-btn {
      background: var(--gold) !important;
      color: var(--dark) !important;
      border-color: var(--gold) !important;
      font-weight: 700 !important;
    }

    /* ---------- Page layout ---------- */
    .container {
      width: 100%;
      max-width: 900px;
      margin: 50px auto 70px;
      padding: 0 24px;
      display: flex;
      justify-content: center;
    }

    .profile-card {
      width: 100%;
      background: var(--cream-card);
      border: 1px solid rgba(212, 175, 55, 0.20);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 44px 48px;
    }

    /* ---------- Header: avatar + label + name ---------- */
    .profile-header {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 22px;
      margin-bottom: 36px;
    }

    .avatar {
      width: 96px;
      height: 96px;
      border-radius: 50%;
      background: var(--gold-pale);
      border: 3px solid var(--gold-soft);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.2rem;
      color: var(--accent);
      flex-shrink: 0;
      position: relative;
    }

    .avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .avatar .camera-badge {
      position: absolute;
      bottom: -2px;
      right: -2px;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: var(--gold);
      border: 2px solid #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 3px 8px rgba(26, 18, 11, .25);
      transition: background .2s ease, transform .2s ease;
    }

    .avatar .camera-badge:hover {
      background: var(--accent);
      transform: scale(1.08);
    }

    .profile-header .who {
      text-align: left;
    }

    .profile-header .tag {
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 1.2px;
      color: var(--gold-soft);
      text-transform: uppercase;
      margin-bottom: 4px;
    }

    .profile-header .name {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      font-size: 1.9rem;
      color: var(--dark);
    }

    /* ---------- Info grid ---------- */
    .info-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      margin-bottom: 36px;
    }

    .info-box {
      background: var(--box);
      border-left: 4px solid var(--accent);
      border-radius: 10px;
      padding: 14px 18px;
      overflow: hidden;
    }

    .info-box .label {
      font-size: 0.68rem;
      font-weight: 700;
      letter-spacing: 1px;
      color: var(--muted);
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    .info-box .value {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      font-size: 1.15rem;
      color: var(--dark);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .divider {
      border: none;
      border-top: 1px dashed var(--border);
      margin: 0 0 32px;
    }


    .section-title {
      text-align: center;
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      font-size: 1.7rem;
      color: var(--dark);
      margin: 0 0 8px;
    }

    .section-title span {
      color: var(--gold-soft);
    }

    .section-sub {
      text-align: center;
      font-size: 0.92rem;
      color: var(--muted);
      margin: 0 0 26px;
    }

    .action-cards {
      display: flex;
      gap: 18px;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 34px;
    }

    .action-card {
      flex: 1 1 200px;
      max-width: 260px;
      background: var(--box);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 30px 18px;
      text-align: center;
      cursor: pointer;
      transition: all 0.25s ease;
    }

    .action-card:hover {
      border-color: var(--gold-soft);
      transform: translateY(-3px);
      box-shadow: var(--shadow);
    }

    .action-card i {
      font-size: 1.7rem;
      color: var(--accent);
      margin-bottom: 12px;
      display: block;
    }

    .action-card .label-text {
      font-weight: 600;
      font-size: 0.95rem;
      color: var(--dark);
    }

    .add-section {
      text-align: center;
    }

    .add-section p {
      font-size: 0.92rem;
      color: var(--muted);
      margin: 0 0 18px;
    }

    .add-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 13px 40px;
      background: var(--gold);
      color: var(--dark);
      border: none;
      border-radius: 999px;
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      font-size: 0.85rem;
      letter-spacing: 0.4px;
      cursor: pointer;
      transition: all 0.25s ease;
      text-transform: uppercase;
    }

    .add-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 18px rgba(212, 175, 55, 0.35);
    }

    @media only screen and (max-width: 720px) {
      .navbar {
        justify-content: center;
        text-align: center;
      }

      .profile-card {
        padding: 32px 22px;
      }

      .profile-header {
        flex-direction: column;
        text-align: center;
      }

      .profile-header .who {
        text-align: center;
      }

      .info-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media only screen and (max-width: 460px) {
      .info-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <div class="navbar">
    <div class="brand">Certificate <span>Management</span> System</div>
    <div class="nav-actions">
      <a href="accer.php" class="n"><button type="button" id="btn1">Academic Certificates</button></a>
      <a href="ustudedet.php" class="n"><button type="button" id="btn1">Update Details</button></a>
      <a href="chnpsw.php" class="n"><button type="button" id="btn1">Change Password</button></a>
      <a href="logout.php" class="n"><button type="button" id="btn1" class="logout-btn">Logout</button></a>
    </div>
  </div>

  <div class="container">
    <?php
    $uname = $_SESSION['username'];
    $query = "select * from studentdetails where username=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $uname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($result)) {
      $_SESSION['name'] = $row['name'];
      $_SESSION['rollno'] = $row['username'];
      $_SESSION['classteacher_id'] = $row['classteacher_id'];   // ADD
      $_SESSION['counsular_id'] = $row['counsular_id'];          // ADD
    ?>
      <div class="profile-card">

        <div class="profile-header">
          <div class="avatar">
            <?php $picUrl = resolveStudentPicUrl($row['pic'] ?? null); ?>
            <?php if ($picUrl): ?>
              <img src="<?php echo htmlspecialchars($picUrl); ?>" alt="Profile photo">
            <?php else: ?>
              <i class="fa-solid fa-user"></i>
            <?php endif; ?>

            <a href="student_profile_pic.php" class="n camera-badge" title="Change profile picture">
              <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="var(--dark)" stroke-width="2">
                <path d="M4 8h3l2-2h6l2 2h3v11H4z" stroke-linejoin="round" />
                <circle cx="12" cy="13.5" r="3.2" />
              </svg>
            </a>
          </div>
          <div class="who">
            <div class="tag">Student Profile</div>
            <div class="name"><?php echo htmlspecialchars($row['name']); ?></div>
          </div>
        </div>

        <div class="info-grid">
          <div class="info-box">
            <div class="label">Roll No.</div>
            <div class="value"><?php echo htmlspecialchars($row['username']); ?></div>
          </div>
          <div class="info-box">
            <div class="label">Branch</div>
            <div class="value"><?php echo htmlspecialchars($row['department']); ?></div>
          </div>
          <div class="info-box">
            <div class="label">Year of Studying</div>
            <div class="value"><?php echo htmlspecialchars($row['year']); ?></div>
          </div>
          <div class="info-box">
            <div class="label">Counsular</div>
            <div class="value"><?php echo htmlspecialchars($row['counsular']); ?></div>
          </div>
          <div class="info-box">
            <div class="label">Class Incharge</div>
            <div class="value"><?php echo htmlspecialchars($row['classteacher']); ?></div>
          </div>
        </div>

        <hr class="divider">

        <div class="section-title">Search <span>Certificate</span></div>
        <p class="section-sub">Find and view your certificates instantly</p>

        <div class="action-cards">
          <a href="ssearch.php" class="n">
            <div class="action-card">
              <i class="fa-solid fa-file-lines"></i>
              <div class="label-text">Your Certificates</div>
            </div>
          </a>
        </div>

        <hr class="divider">

        <div class="add-section">
          <p>To add your certificate to your collection, click Add</p>
          <a href="studentadd.php" class="n"><button type="button" class="add-btn">Add</button></a>
        </div>

      </div>
    <?php
    } ?>
  </div>

  <script src="mainl.js"></script>
</body>

</html>