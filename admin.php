<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <title>CERTIFICATE MANAGEMENT SYSTEM</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700|Playfair+Display:700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --dark: #191310;
      --dark2: #241a14;
      --gold: #d4af6a;
      --gold-deep: #c9982f;
      --cream: #f7f1e6;
      --cream-soft: #f2e9d8;
      --rust: #b5502e;
      --text-light: #f3ece0;
      --text-muted: #cfc4b4;
      --radius: 16px;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--cream);
      color: #2b2420;
      overflow-x: hidden;
    }

    a.n {
      text-decoration: none;
    }

    /* ===== Top bar ===== */
    .topbar {
      background: linear-gradient(180deg, var(--dark) 0%, var(--dark2) 100%);
      padding: 22px 5%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 14px;
      border-bottom: 1px solid rgba(212, 175, 106, 0.25);
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .brand .badge {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      border: 2px solid var(--gold);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gold);
      font-size: 22px;
      background: rgba(212, 175, 106, 0.08);
    }

    .brand h1 {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      color: var(--text-light);
      letter-spacing: 0.5px;
    }

    .brand h1 span {
      color: var(--gold);
    }

    .topbar-actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .pill-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 11px 22px;
      border-radius: 30px;
      border: 1px solid var(--gold);
      background: transparent;
      color: var(--gold);
      font-family: 'Poppins', sans-serif;
      font-weight: 500;
      font-size: 0.9rem;
      letter-spacing: 0.3px;
      cursor: pointer;
      transition: all .35s ease;
      white-space: nowrap;
    }

    .pill-btn:hover {
      background: var(--gold);
      color: var(--dark);
      transform: translateY(-2px);
      box-shadow: 0 8px 18px rgba(212, 175, 106, 0.35);
    }

    .pill-btn.solid {
      background: var(--gold);
      color: var(--dark);
      border: 1px solid var(--gold);
    }

    .pill-btn.solid:hover {
      background: var(--gold-deep);
      border-color: var(--gold-deep);
    }

    /* ===== Hero strip ===== */
    .hero-strip {
      background: linear-gradient(180deg, var(--dark2) 0%, var(--dark) 100%);
      padding: 30px 5% 70px;
      text-align: center;
      position: relative;
    }

    .hero-strip .tag {
      color: var(--text-muted);
      letter-spacing: 3px;
      font-size: 0.8rem;
      text-transform: uppercase;
      margin-bottom: 10px;
    }

    .hero-strip h2 {
      font-family: 'Playfair Display', serif;
      color: var(--text-light);
      font-size: 2.1rem;
      font-weight: 700;
    }

    .hero-strip h2 span {
      color: var(--gold);
    }

    /* ===== Stat cards ===== */
    .stats-wrapper {
      display: flex;
      justify-content: center;
      gap: 28px;
      flex-wrap: wrap;
      margin-top: -55px;
      padding: 0 5%;
      position: relative;
      z-index: 2;
    }

    .stat-card {
      background: #fff;
      border-radius: var(--radius);
      padding: 28px 30px;
      width: 230px;
      text-align: center;
      box-shadow: 0 18px 34px rgba(25, 19, 16, 0.18);
      transition: transform .35s ease, box-shadow .35s ease;
    }

    .stat-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 24px 40px rgba(25, 19, 16, 0.22);
    }

    .stat-card .icon-circle {
      width: 66px;
      height: 66px;
      border-radius: 50%;
      background: var(--cream-soft);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
      font-size: 26px;
      color: var(--rust);
    }

    .stat-card h3 {
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      color: #7a6f62;
      font-weight: 500;
      margin-bottom: 6px;
    }

    .stat-card .count {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: var(--dark);
      font-weight: 700;
    }

    .actions-section {
      padding: 60px 6% 70px;
    }

    .actions-section .section-title {
      text-align: center;
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      margin-bottom: 30px;
      color: var(--dark);
    }

    .actions-section .section-title span {
      color: var(--rust);
    }

    .actions-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 18px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .action-btn {
      display: flex;
      align-items: center;
      gap: 14px;
      background: linear-gradient(135deg, var(--dark) 0%, var(--dark2) 100%);
      color: var(--text-light);
      border-radius: 14px;
      padding: 16px 22px;
      height: 84px;
      width: 100%;
      font-weight: 500;
      font-size: 0.95rem;
      line-height: 1.25;
      text-align: left;
      border: 1px solid transparent;
      transition: all .35s ease;
    }

    .action-btn .icon-badge {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      background: rgba(212, 175, 106, 0.15);
      color: var(--gold);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }

    .action-btn:hover {
      border-color: var(--gold);
      transform: translateY(-4px);
      box-shadow: 0 14px 26px rgba(25, 19, 16, 0.18);
    }

    .action-btn:hover .icon-badge {
      background: var(--gold);
      color: var(--dark);
    }

    /* ===== Responsive ===== */
    @media only screen and (max-width: 900px) {
      .brand h1 {
        font-size: 1.15rem;
      }

      .hero-strip h2 {
        font-size: 1.5rem;
      }

      .stat-card {
        width: 45%;
      }

      .illustration img {
        width: 180px;
      }
    }

    @media only screen and (max-width: 560px) {
      .topbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .stat-card {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <!-- ===== Top bar ===== -->
  <div class="topbar">
    <div class="brand">

      <h1>Certificate <span>Management</span> System</h1>
    </div>
    <div class="topbar-actions">
      <a href="studentdetailss.php" class="n">
        <button type="button" class="pill-btn"><i class="fas fa-user-graduate"></i> Student Details</button>
      </a>
      <a href="logout.php" class="n">
        <button type="button" class="pill-btn solid"><i class="fas fa-sign-out-alt"></i> Logout</button>
      </a>
    </div>
  </div>

  <!-- ===== Hero / heading strip ===== -->
  <div class="hero-strip">
    <div class="tag">Admin Dashboard</div>
    <h2>Digital Records, <span>Verified</span></h2>
  </div>

  <!-- ===== Stat cards ===== -->
  <div class="stats-wrapper">
    <div class="stat-card">
      <div class="icon-circle"><i class="fas fa-users"></i></div>
      <h3>No. of Signups</h3>
      <div class="count">
        <?php
        include "db_conn.php";
        $q = "select * from faculty";
        $res = mysqli_query($conn, $q);
        $to = mysqli_num_rows($res);

        $q1 = "select * from studentdetails";
        $res1 = mysqli_query($conn, $q1);
        $to1 = mysqli_num_rows($res1);

        $total = $to + $to1;
        echo $total;
        ?>
      </div>
    </div>

    <div class="stat-card">
      <div class="icon-circle"><i class="fas fa-user-graduate"></i></div>
      <h3>No. of Students</h3>
      <div class="count">
        <?php
        include "db_conn.php";
        $q = "select * from studentdetails";
        $res = mysqli_query($conn, $q);
        echo mysqli_num_rows($res);
        ?>
      </div>
    </div>

    <div class="stat-card">
      <div class="icon-circle"><i class="fas fa-chalkboard-teacher"></i></div>
      <h3>No. of Faculty</h3>
      <div class="count">
        <?php
        include "db_conn.php";
        $q = "select * from faculty";
        $res = mysqli_query($conn, $q);
        echo mysqli_num_rows($res);
        ?>
      </div>
    </div>
  </div>

  <?php
  include "db_conn.php";
  $q = "SELECT * from sworkshop where year='1st year' and branch='CSE(AI&ML)'";
  $res = mysqli_query($conn, $q);
  if ($res) {
    $rowcount = mysqli_num_rows($res);
  }
  include "db_conn.php";
  $qr = "SELECT * from sworkshop where year='1st year' and branch='CSE'";
  $ress = mysqli_query($conn, $qr);
  if ($ress) {
    $rowc = mysqli_num_rows($ress);
  }

  include "db_conn.php";
  $qrr = "SELECT * from sworkshop where year='1st year' and branch='CSE(IOT)'";
  $resss = mysqli_query($conn, $qrr);
  if ($resss) {
    $rowcc = mysqli_num_rows($resss);
  }

  include "db_conn.php";
  $qry = "SELECT * from sworkshop where year='3rd year' and branch='CSE(AI&ML)'";
  $resul = mysqli_query($conn, $qry);
  if ($resul) {
    $rowcoun = mysqli_num_rows($resul);
  }

  include "db_conn.php";
  $qryy = "SELECT * from sworkshop where year='3rd year' and branch='CSE'";
  $resull = mysqli_query($conn, $qryy);
  if ($resull) {
    $rowcounn = mysqli_num_rows($resull);
  }

  include "db_conn.php";
  $qrryy = "SELECT * from sworkshop where year='3rd year' and branch='CSE(IOT)'";
  $resssy = mysqli_query($conn, $qrryy);
  if ($resssy) {
    $rowccy = mysqli_num_rows($resssy);
  }
  ?>


  <div class="actions-section">
    <div class="section-title">Quick <span>Actions</span></div>
    <div class="actions-grid">

      <a href="asearch.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-database"></i></span> Student Data
        </button>
      </a>

      <a href="facultysearch.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-search"></i></span> Faculty Data
        </button>
      </a>

      <a href="counsellor.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-user-friends"></i></span> Assign Counsellor
        </button>
      </a>

      <a href="classincharge.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-chalkboard"></i></span> Assign Class Incharge
        </button>
      </a>

      <a href="analysis.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-chart-pie"></i></span> Analysis
        </button>
      </a>

      <a href="stuacademic.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-award"></i></span> Student Academic Certificates
        </button>
      </a>

      <a href="addfac.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-user-plus"></i></span> Add Faculty
        </button>
      </a>
      <a href="newuser.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-user-graduate"></i></span> Add Student
        </button>
      </a>

      <a href="csvdataupload.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-file-csv"></i></span> Add CSV Files
        </button>
      </a>

      <a href="consolidated.php" class="n">
        <button type="button" class="action-btn">
          <span class="icon-badge"><i class="fas fa-clipboard-list"></i></span> Consolidated Faculty Report
        </button>
      </a>

    </div>
  </div>

</body>

</html>