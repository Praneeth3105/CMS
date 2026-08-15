<?php
include_once('db_conn.php');
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$rollno = $_SESSION['username'];
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      --danger: #b6432f;
      --radius: 18px;
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
      font-family: 'Poppins', sans-serif;
      background: var(--cream);
      color: var(--dark);
    }

    .n {
      text-decoration: none;
    }

    /* ---------- Navbar ---------- */
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
      font-size: 1.4rem;
      color: #fff;
    }

    .brand span {
      color: var(--gold);
    }

    .nav-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .nav-actions button {
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

    .nav-actions button:hover {
      background: var(--gold);
      color: var(--dark);
      border-color: var(--gold);
    }

    .nav-actions .logout-btn {
      background: var(--gold);
      color: var(--dark);
      border-color: var(--gold);
      font-weight: 700;
    }

    /* ---------- Page wrapper ---------- */
    .page {
      max-width: 1200px;
      margin: 0 auto;
      padding: 36px 24px 70px;
    }

    /* ---------- Category selector ---------- */
    .selector-row {
      display: flex;
      justify-content: center;
      margin-bottom: 34px;
    }

    .selector-card {
      background: var(--cream-card);
      border: 1px solid var(--border);
      border-radius: 999px;
      box-shadow: var(--shadow);
      padding: 8px 10px;
      display: flex;
      align-items: center;
      gap: 10px;
      width: 100%;
      max-width: 460px;
    }

    .selector-card label {
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.6px;
      color: var(--muted);
      text-transform: uppercase;
      padding-left: 14px;
      white-space: nowrap;
    }

    #mySelect {
      flex: 1;
      appearance: none;
      background: var(--box);
      color: var(--dark);
      border: 1px solid var(--border);
      border-radius: 999px;
      padding: 11px 18px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 0.85rem;
      cursor: pointer;
    }

    #mySelect:focus {
      outline: 2px solid var(--gold-soft);
    }

    /* ---------- Section card ---------- */
    .section-card {
      background: var(--cream-card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 30px 30px 24px;
      margin-bottom: 24px;
    }

    .section-card h1 {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      font-size: 1.5rem;
      margin: 0 0 4px;
      color: var(--dark);
    }

    .section-sub {
      font-size: 0.85rem;
      color: var(--muted);
      margin: 0 0 18px;
    }

    /* ---------- Search input ---------- */
    .search-wrap {
      position: relative;
      max-width: 420px;
      margin-bottom: 22px;
    }

    .search-wrap i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 0.85rem;
    }

    .search-wrap input[type="text"] {
      width: 100%;
      font-size: 0.9rem;
      padding: 12px 16px 12px 40px;
      border: 1px solid var(--border);
      border-radius: 999px;
      background: var(--box);
      font-family: 'Poppins', sans-serif;
      color: var(--dark);
    }

    .search-wrap input[type="text"]:focus {
      outline: none;
      border-color: var(--gold-soft);
      background: var(--cream-card);
    }

    /* ---------- Table ---------- */
    .scroll {
      width: 100%;
      overflow-x: auto;
      border-radius: 12px;
      border: 1px solid var(--border);
    }

    table {
      border-collapse: collapse;
      width: 100%;
      min-width: 900px;
      font-size: 0.85rem;
      background: var(--cream-card);
    }

    table thead tr,
    table tr.header {
      background: var(--dark);
    }

    table thead th,
    table tr.header th {
      color: var(--gold-pale);
      font-weight: 600;
      font-size: 0.72rem;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      text-align: left;
      padding: 14px 16px;
      white-space: nowrap;
    }

    table td {
      padding: 12px 16px;
      border-bottom: 1px solid var(--border);
      vertical-align: middle;
      color: var(--dark);
    }

    table tbody tr:nth-child(even) {
      background: var(--box);
    }

    table tbody tr:hover {
      background: var(--gold-pale);
    }

    table td img,
    table td embed {
      border-radius: 8px;
      display: block;
      border: 1px solid var(--border);
    }

    table a {
      color: var(--accent);
      font-weight: 600;
    }

    /* ---------- Action buttons inside table ---------- */
    .act-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      padding: 7px 16px;
      border-radius: 999px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 0.72rem;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      cursor: pointer;
      border: 1px solid transparent;
      white-space: nowrap;
      transition: all 0.2s ease;
    }

    .act-btn.download {
      background: var(--gold-pale);
      color: var(--dark);
      border-color: var(--gold-soft);
      padding: 8px 12px;
    }

    .act-btn.download:hover {
      background: var(--gold);
    }

    .act-btn.edit {
      background: transparent;
      color: var(--dark);
      border-color: var(--border);
    }

    .act-btn.edit:hover {
      border-color: var(--gold-soft);
      background: var(--box);
    }

    .act-btn.delete {
      background: transparent;
      color: var(--danger);
      border-color: rgba(182, 67, 47, 0.35);
    }

    .act-btn.delete:hover {
      background: rgba(182, 67, 47, 0.08);
    }

    @media only screen and (max-width: 720px) {
      .navbar {
        justify-content: center;
        text-align: center;
      }

      .section-card {
        padding: 22px 16px 18px;
      }

      .selector-card {
        flex-direction: column;
        align-items: stretch;
        border-radius: 16px;
      }

      .selector-card label {
        padding-left: 4px;
      }
    }
  </style>
</head>

<body>

  <div class="navbar">
    <div class="brand">Certificate <span>Management</span> System</div>
    <div class="nav-actions">
      <a href="studentdat.php" class="n"><button type="button">Back</button></a>
      <a href="logout.php" class="n"><button type="button" class="logout-btn">Logout</button></a>
    </div>
  </div>

  <div class="page">

    <div class="selector-row">
      <div class="selector-card">
        <label for="mySelect">View</label>
        <select id='mySelect' onchange="myFun()" name='opt' required>
          <option value=''>Select the Option</option>
          <option value='workshop'>Workshops</option>
          <option value='internship'>Internships</option>
          <option value='project'>Projects</option>
          <option value='certificate'>Certificates</option>
          <option value='extracircular'>Extra Circulars</option>
          <option value='cocircular'>Co Circulars</option>
        </select>
      </div>
    </div>

    <div id="demo">

      <!-- ════════════ WORKSHOP ════════════ -->
      <!-- ════════════ WORKSHOP ════════════ -->
      <div id="sec_workshop" class="section-card" style="display:none;">
        <h1>Workshops</h1>
        <p class="section-sub">All workshops you've added to your collection</p>

        <div class="search-wrap">
          <i class="fa fa-search"></i>
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Workshop Name..." title="Type in a name">
        </div>

        <div class="scroll">
          <table id="myTable">
            <tr class="header">
              <th>Roll No</th>
              <th>Name</th>
              <th>Workshop Name</th>
              <th>Organisation</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>Place</th>
              <th>File</th>
              <th>Branch</th>
              <th>Year</th>
              <th>Counsellor</th>
              <th>Class Teacher</th>
              <th>Download</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>

            <?php
            $q = "SELECT * FROM sworkshop WHERE RollNo='$rollno'";
            $res = mysqli_query($conn, $q);

            if ($res && mysqli_num_rows($res) > 0) {

              while ($rows = mysqli_fetch_assoc($res)) {

                $file = $rows['file'];
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $filepath = "images/" . $file;
            ?>

                <tr>
                  <td><?php echo $rows['RollNo']; ?></td>
                  <td><?php echo $rows['Name']; ?></td>
                  <td><?php echo $rows['WorkShopName']; ?></td>
                  <td><?php echo $rows['OrgName']; ?></td>
                  <td><?php echo $rows['StartDate']; ?></td>
                  <td><?php echo $rows['EndDate']; ?></td>
                  <td><?php echo $rows['Duration']; ?></td>
                  <td><?php echo $rows['Place']; ?></td>

                  <td>
                    <?php if ($ext == "pdf") { ?>
                      <embed src="<?php echo $filepath; ?>" type="application/pdf" width="160" height="90">
                    <?php } else { ?>
                      <a href="<?php echo $filepath; ?>" data-lightbox="mygallery">
                        <img src="<?php echo $filepath; ?>" width="160" height="90">
                      </a>
                    <?php } ?>
                  </td>

                  <td><?php echo $rows['branch']; ?></td>
                  <td><?php echo $rows['year']; ?></td>
                  <td><?php echo $rows['counsular']; ?></td>
                  <td><?php echo $rows['classteacher']; ?></td>

                  <td>
                    <a href="<?php echo $filepath; ?>" download>
                      <button class="act-btn download">
                        <i class="fa fa-download"></i>
                      </button>
                    </a>
                  </td>

                  <td>
                    <a href="sewa.php?editwn=<?php echo urlencode($rows['WorkShopName']); ?>">
                      <button class="act-btn edit">Edit</button>
                    </a>
                  </td>

                  <td>
                    <a href="sdwa.php?editwn=<?php echo urlencode($rows['WorkShopName']); ?>&edi=<?php echo urlencode($rows['file']); ?>">
                      <button class="act-btn delete">Delete</button>
                    </a>
                  </td>
                </tr>

            <?php
              }
            } else {
              echo "<tr class='empty-row'>
                        <td colspan='16'>No Workshop records found yet.</td>
                      </tr>";
            }
            ?>

          </table>
        </div>
      </div>
      <!-- ════════════ INTERNSHIP ════════════ -->
      <div id="sec_internship" class="section-card" style="display:none;">
        <h1>Internships</h1>
        <p class="section-sub">All internships you've added to your collection</p>
        <div class="search-wrap">
          <i class="fa fa-search"></i>
          <input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Search by Company Name..." title="Type in a name">
        </div>
        <div class="scroll">
          <table id="myTable1">
            <tr class="header">
              <th>Roll No</th>
              <th>Name</th>
              <th>Company Name</th>
              <th>Branch</th>
              <th>Year</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>Amount</th>
              <th>Paid</th>
              <th>Tech/Non-Tech</th>
              <th>File</th>
              <th>Counsellor</th>
              <th>Class Teacher</th>
              <th>Download</th> 
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            <?php
            $q = "SELECT * FROM sinternship WHERE rollno='$rollno'";
            $res = mysqli_query($conn, $q);
            while ($rows = mysqli_fetch_assoc($res)) {
              $pic = "images/" . $rows['pic'];
            ?>
              <tr>
                <td><?php echo $rows['rollno']; ?></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['companyname']; ?></td>
                <td><?php echo $rows['branch']; ?></td>
                <td><?php echo $rows['year']; ?></td>
                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
                <td><?php echo $rows['amount']; ?></td>
                <td><?php echo $rows['paid']; ?></td>
                <td><?php echo $rows['tech']; ?></td>
                <td><a href="<?php echo $pic; ?>" data-lightbox="mygallery"><img src="<?php echo $pic; ?>" width="160" height="90"></a></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><a href="<?php echo $pic; ?>" download><button class="act-btn download"><i class="fa fa-download"></i></button></a></td>
                <td><a href="sewb.php?editwn=<?php echo urlencode($rows['companyname']); ?>"><button class="act-btn edit">Edit</button></a></td>
                <td><a href="sdwa1.php?editwn=<?php echo urlencode($rows['companyname']); ?>&edi=<?php echo urlencode($rows['pic']); ?>"><button class="act-btn delete">Delete</button></a></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ════════════ PROJECT ════════════ -->
      <div id="sec_project" class="section-card" style="display:none;">
        <h1>Projects</h1>
        <p class="section-sub">All projects you've added to your collection</p>
        <div class="search-wrap">
          <i class="fa fa-search"></i>
          <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search by Project Name..." title="Type in a name">
        </div>
        <div class="scroll">
          <table id="myTable2">
            <tr class="header">
              <th>Roll Number</th>
              <th>Team Number</th>
              <th>Name</th>
              <th>Project Title</th>
              <th>Academic Year</th>
              <th>Drive Link</th>
              <th>Branch</th>
              <th>Counsellor</th>
              <th>Class Teacher</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            <?php
            $q = "SELECT * FROM sproject WHERE Roll_Number='$rollno'";
            $res = mysqli_query($conn, $q);
            while ($rows = mysqli_fetch_assoc($res)) {
            ?>
              <tr>
                <td><?php echo $rows['Roll_Number']; ?></td>
                <td><?php echo $rows['Team_Number']; ?></td>
                <td><?php echo $rows['Name']; ?></td>
                <td><?php echo $rows['Project_title']; ?></td>
                <td><?php echo $rows['academicyear']; ?></td>
                <td><a href="<?php echo $rows['Drive_link']; ?>" target="_blank">Drive Link</a></td>
                <td><?php echo $rows['branch']; ?></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><a href="sewc.php?editwn=<?php echo urlencode($rows['Project_title']); ?>"><button class="act-btn edit">Edit</button></a></td>
                <td><a href="sdwa2.php?editwn=<?php echo urlencode($rows['Project_title']); ?>"><button class="act-btn delete">Delete</button></a></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ════════════ CERTIFICATE / COURSE ════════════ -->
      <div id="sec_certificate" class="section-card" style="display:none;">
        <h1>Certificates</h1>
        <p class="section-sub">All certificates you've added to your collection</p>
        <div class="search-wrap">
          <i class="fa fa-search"></i>
          <input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Search by Course Name..." title="Type in a name">
        </div>
        <div class="scroll">
          <table id="myTable3">
            <tr class="header">
              <th>Roll No</th>
              <th>Name</th>
              <th>Course Name</th>
              <th>Organisation</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>Year</th>
              <th>File</th>
              <th>Branch</th>
              <th>Counsellor</th>
              <th>Class Teacher</th>
              <th>Download</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            <?php
            $q = "SELECT * FROM course WHERE RollNo='$rollno'";
            $res = mysqli_query($conn, $q);
            while ($rows = mysqli_fetch_assoc($res)) {
              $fp = "images/" . $rows['file'];
            ?>
              <tr>
                <td><?php echo $rows['RollNo']; ?></td>
                <td><?php echo $rows['Name']; ?></td>
                <td><?php echo $rows['CourseName']; ?></td>
                <td><?php echo $rows['OrganisationName']; ?></td>
                <td><?php echo $rows['StartDate']; ?></td>
                <td><?php echo $rows['EndDate']; ?></td>
                <td><?php echo $rows['Duration']; ?></td>
                <td><?php echo $rows['academicyear']; ?></td>
                <td><a href="<?php echo $fp; ?>" data-lightbox="mygallery"><img src="<?php echo $fp; ?>" width="160" height="90"></a></td>
                <td><?php echo $rows['branch']; ?></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><a href="<?php echo $fp; ?>" download><button class="act-btn download"><i class="fa fa-download"></i></button></a></td>
                <td><a href="sewd.php?editwn=<?php echo urlencode($rows['CourseName']); ?>"><button class="act-btn edit">Edit</button></a></td>
                <td><a href="sdwa3.php?editwn=<?php echo urlencode($rows['CourseName']); ?>&edi=<?php echo urlencode($rows['file']); ?>"><button class="act-btn delete">Delete</button></a></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ════════════ EXTRA CIRCULAR ════════════ -->
      <div id="sec_extracircular" class="section-card" style="display:none;">
        <h1>Extra Circulars</h1>
        <p class="section-sub">All extra-circular activities you've added to your collection</p>
        <div class="search-wrap">
          <i class="fa fa-search"></i>
          <input type="text" id="myInput4" onkeyup="myFunction4()" placeholder="Search by Event Name..." title="Type in a name">
        </div>
        <div class="scroll">
          <table id="myTable4">
            <tr class="header">
              <th>Roll No</th>
              <th>Name</th>
              <th>Year</th>
              <th>Branch</th>
              <th>Event Name</th>
              <th>Conducting College</th>
              <th>Organisation</th>
              <th>Dates</th>
              <th>Internal/External</th>
              <th>Academic Year</th>
              <th>File</th>
              <th>Counsellor</th>
              <th>Class Teacher</th>
              <th>Download</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            <?php
            $q = "SELECT * FROM extracircular WHERE rollno='$rollno'";
            $res = mysqli_query($conn, $q);
            while ($rows = mysqli_fetch_assoc($res)) {
              $fp = "images/" . $rows['file'];
            ?>
              <tr>
                <td><?php echo $rows['rollno']; ?></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['year']; ?></td>
                <td><?php echo $rows['branch']; ?></td>
                <td><?php echo $rows['eventname']; ?></td>
                <td><?php echo $rows['conductingclg']; ?></td>
                <td><?php echo $rows['orgname']; ?></td>
                <td><?php echo $rows['dates']; ?></td>
                <td><?php echo $rows['ie']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><a href="<?php echo $fp; ?>" data-lightbox="mygallery"><img src="<?php echo $fp; ?>" width="160" height="90"></a></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><a href="<?php echo $fp; ?>" download><button class="act-btn download"><i class="fa fa-download"></i></button></a></td>
                <td><a href="sewe.php?editwn=<?php echo urlencode($rows['eventname']); ?>"><button class="act-btn edit">Edit</button></a></td>
                <td><a href="sdwa4.php?editwn=<?php echo urlencode($rows['eventname']); ?>&edi=<?php echo urlencode($rows['file']); ?>"><button class="act-btn delete">Delete</button></a></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ════════════ CO CIRCULAR ════════════ -->
      <div id="sec_cocircular" class="section-card" style="display:none;">
        <h1>Co Circulars</h1>
        <p class="section-sub">All co-circular activities you've added to your collection</p>
        <div class="search-wrap">
          <i class="fa fa-search"></i>
          <input type="text" id="myInput5" onkeyup="myFunction5()" placeholder="Search by Event Name..." title="Type in a name">
        </div>
        <div class="scroll">
          <table id="myTable5">
            <tr class="header">
              <th>Roll No</th>
              <th>Name</th>
              <th>Year</th>
              <th>Branch</th>
              <th>Event Name</th>
              <th>Conducting College</th>
              <th>Organisation</th>
              <th>Dates</th>
              <th>Internal/External</th>
              <th>Academic Year</th>
              <th>File</th>
              <th>Counsellor</th>
              <th>Class Teacher</th>
              <th>Download</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            <?php
            $q = "SELECT * FROM cocircular WHERE rollno='$rollno'";
            $res = mysqli_query($conn, $q);
            while ($rows = mysqli_fetch_assoc($res)) {
              $fp = "images/" . $rows['file'];
            ?>
              <tr>
                <td><?php echo $rows['rollno']; ?></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['year']; ?></td>
                <td><?php echo $rows['branch']; ?></td>
                <td><?php echo $rows['eventname']; ?></td>
                <td><?php echo $rows['conductingclg']; ?></td>
                <td><?php echo $rows['orgname']; ?></td>
                <td><?php echo $rows['dates']; ?></td>
                <td><?php echo $rows['ie']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><a href="<?php echo $fp; ?>" data-lightbox="mygallery"><img src="<?php echo $fp; ?>" width="160" height="90"></a></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><a href="<?php echo $fp; ?>" download><button class="act-btn download"><i class="fa fa-download"></i></button></a></td>
                <td><a href="sewf.php?editwn=<?php echo urlencode($rows['eventname']); ?>"><button class="act-btn edit">Edit</button></a></td>
                <td><a href="sdwa5.php?editwn=<?php echo urlencode($rows['eventname']); ?>&edi=<?php echo urlencode($rows['file']); ?>"><button class="act-btn delete">Delete</button></a></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

    </div><!-- end #demo -->

  </div><!-- end .page -->

  <script>
    var sections = ['workshop', 'internship', 'project', 'certificate', 'extracircular', 'cocircular'];

    function myFun() {
      var val = document.getElementById("mySelect").value;
      sections.forEach(function(s) {
        document.getElementById("sec_" + s).style.display = (s === val) ? "block" : "none";
      });
    }

    function myFunction() {
      filterTable("myInput", "myTable", 2);
    }

    function myFunction1() {
      filterTable("myInput1", "myTable1", 2);
    }

    function myFunction2() {
      filterTable("myInput2", "myTable2", 3);
    }

    function myFunction3() {
      filterTable("myInput3", "myTable3", 2);
    }

    function myFunction4() {
      filterTable("myInput4", "myTable4", 4);
    }

    function myFunction5() {
      filterTable("myInput5", "myTable5", 4);
    }

    function filterTable(inputId, tableId, colIndex) {
      var input = document.getElementById(inputId);
      var filter = input.value.toUpperCase();
      var table = document.getElementById(tableId);
      var tr = table.getElementsByTagName("tr");
      for (var i = 0; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName("td")[colIndex];
        if (td) {
          var txt = td.textContent || td.innerText;
          tr[i].style.display = txt.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
      }
    }
  </script>

  <script src="mainl.js"></script>
</body>

</html>