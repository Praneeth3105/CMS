<?php
session_start();
include_once('db_conn.php');

$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <title>CERTIFICATE MANAGEMENT SYSTEM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Keep your existing <style> block from the original file — unchanged, omitted here for brevity -->
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
      --shadow-lg: 0 20px 45px rgba(26, 18, 11, 0.14);
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
      overflow-x: hidden;
    }

    .n {
      text-decoration: none;
    }

    /* ---------- Top bar ---------- */
    .topbar {
      background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 100%);
      padding: 18px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      box-shadow: var(--shadow);
    }

    .brand {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem;
      font-weight: 700;
      color: #fff;
      margin: 0;
      letter-spacing: 0.3px;
    }

    .brand span {
      color: var(--gold);
    }

    .topbar-actions {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .btn,
    button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background: transparent;
      color: var(--gold-pale);
      border: 1px solid var(--gold-soft);
      border-radius: 999px;
      padding: 10px 22px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 0.75rem;
      letter-spacing: 0.4px;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn:hover,
    button:hover {
      background: var(--gold);
      color: var(--dark);
      border-color: var(--gold);
      transform: translateY(-1px);
    }

    /* small action buttons inside tables (Edit / Delete / Download) */
    #demo .btn {
      padding: 7px 16px;
      font-size: 0.7rem;
      white-space: nowrap;
      background: transparent;
      color: var(--dark);
      border-color: var(--border);
    }

    #demo .btn:hover {
      background: var(--box);
      border-color: var(--gold-soft);
      color: var(--dark);
    }

    /* Download button styled distinctly */
    a[href*="download"] .btn,
    a[download] .btn {
      background: var(--gold-pale);
      border-color: var(--gold-soft);
      color: var(--dark);
      padding: 8px 12px;
    }

    a[download] .btn:hover {
      background: var(--gold);
    }

    /* Delete button styled distinctly (matches the "Delete" label text) */
    td a[href^="dwa"] .btn {
      color: var(--danger);
      border-color: rgba(182, 67, 47, 0.35);
      background: transparent;
    }

    td a[href^="dwa"] .btn:hover {
      background: rgba(182, 67, 47, 0.08);
      border-color: var(--danger);
      color: var(--danger);
    }

    /* CSS-only fix for the Font Awesome download glyph (no external icon font loaded) */
    .btn i.fa {
      font-size: 0 !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 14px;
      height: 14px;
    }

    .btn i.fa::before {
      content: "\2193";
      font-size: 14px;
      line-height: 1;
      font-style: normal;
    }

    /* ---------- Page heading + selector ---------- */
    .page-head {
      text-align: center;
      padding: 38px 20px 26px;
    }

    .page-head h1 {
      font-family: 'Playfair Display', serif;
      font-size: 1.8rem;
      font-weight: 700;
      letter-spacing: 0.3px;
      margin: 0 0 22px;
      color: var(--dark);
    }

    .page-head h1 span {
      color: var(--accent);
    }

    .selector-row {
      display: flex;
      justify-content: center;
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
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.6px;
      color: var(--muted);
      text-transform: uppercase;
      padding-left: 14px;
      white-space: nowrap;
    }

    select#mySelect {
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
      outline: none;
    }

    select#mySelect:focus {
      border-color: var(--gold-soft);
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    /* ---------- Section containers ---------- */
    #demo {
      max-width: 1300px;
      margin: 0 auto;
      padding: 0 24px;
    }

    .optionDiv {
      display: none;
      background: var(--cream-card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow-lg);
      padding: 30px;
      margin-bottom: 30px;
      position: relative;
      overflow: hidden;
    }

    .optionDiv::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: linear-gradient(90deg, var(--accent), var(--gold) 50%, var(--accent));
    }

    .optionDiv h1 {
      font-family: 'Playfair Display', serif;
      font-size: 1.3rem;
      font-weight: 700;
      margin: 6px 0 18px;
      color: var(--dark);
    }

    /* ---------- Search inputs ---------- */
    .optionDiv .search-wrap {
      position: relative;
      max-width: 420px;
      margin-bottom: 20px;
    }

    .optionDiv .search-wrap svg {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      width: 16px;
      height: 16px;
      stroke: var(--muted);
      pointer-events: none;
    }

    .optionDiv input[type="text"] {
      width: 100%;
      font-size: 0.88rem;
      font-family: 'Poppins', sans-serif;
      padding: 12px 18px 12px 42px;
      border: 1px solid var(--border);
      border-radius: 999px;
      background: var(--box);
      color: var(--dark);
      outline: none;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .optionDiv input[type="text"]:focus {
      border-color: var(--gold-soft);
      background: var(--cream-card);
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    /* ---------- Tables ---------- */
    .scroll {
      overflow-x: auto;
      width: 100%;
      border-radius: 12px;
      border: 1px solid var(--border);
    }

    .optionDiv table {
      border-collapse: collapse;
      width: 100%;
      min-width: 1300px;
      font-size: 0.82rem;
      background: var(--cream-card);
    }

    .optionDiv table tr.header {
      background: var(--dark);
    }

    .optionDiv table th {
      text-align: left;
      padding: 13px 14px;
      color: var(--gold-pale);
      font-weight: 600;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      font-size: 0.68rem;
      white-space: nowrap;
    }

    .optionDiv table td {
      text-align: left;
      padding: 12px 14px;
      color: var(--dark);
      vertical-align: middle;
      border-bottom: 1px solid var(--border);
    }

    .optionDiv table tbody tr:nth-child(even),
    .optionDiv table tr:not(.header):nth-child(even) {
      background: var(--box);
    }

    .optionDiv table tr:not(.header):hover {
      background: var(--gold-pale) !important;
    }

    .optionDiv table img,
    .optionDiv table embed {
      border-radius: 8px;
      border: 1px solid var(--border);
      display: block;
    }

    .optionDiv table a {
      color: var(--accent);
      font-weight: 600;
      text-decoration: none;
    }

    .optionDiv table a:hover {
      text-decoration: underline;
    }

    /* ---------- Empty state row ---------- */
    .optionDiv table tr.empty-row td {
      text-align: center;
      padding: 34px 14px;
      color: var(--muted);
      font-style: italic;
      font-size: 0.85rem;
      background: var(--cream-card) !important;
      border-bottom: none;
      white-space: normal;
    }

    @media only screen and (max-width: 900px) {
      .topbar {
        justify-content: center;
        text-align: center;
      }

      .optionDiv {
        padding: 18px;
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
  <div class="topbar">
    <h1 class="brand">Certificate <span>Management</span> System</h1>
    <div class="topbar-actions">
      <a href="facultydat.php" class="n"><button type="button" class="btn">Back</button></a>
      <a href="logout.php" class="n"><button type="button" class="btn">Logout</button></a>
    </div>
  </div>

  <div class="page-head">
    <h1>Your <span>Certificates</span></h1>
    <div class="selector-row">
      <div class="selector-card">
        <label for="mySelect">View</label>
        <select id='mySelect' onchange="myFun()" name='opt' required>
          <option value=''>Select the Option</option>
          <option value='fdp'>FDP Attended</option>
          <option value='fdporg'>FDP Organized</option>
          <option value='events'>Workshop </option>
          <option value='certificate'>Certificates</option>
          <option value='paperpublication'>Paper Publications</option>
          <option value='conferencepapers'>Conferences</option>
          <option value='bookpublished'>Book Chapters Published</option>
          <option value='bookedited'>Book Chapters Edited</option>
          <option value='textbook'>Textbook</option>
          <option value='patents'>Patents</option>
          <option value='nptel'>NPTEL</option>
          <option value='achievements'>Achievements</option>
          <option value='outsideparticipations'>Outside Participations</option>
          <option value='revieweractivities'>Reviewer Activities</option>
          <option value='professionalmembership'>Professional Membership</option>
          <option value='phddetails'>PhD Details</option>
          <option value='consultancywork'>Consultancy Work</option>
          <option value='workingmodels'>Working Models</option>
          <option value='fundingprojects'>Funding Projects</option>
        </select>
      </div>
    </div>
  </div>

  <div id='demo'>

    <!-- ============ FDP ATTENDED -> fdp ============ -->
    <div id="fdpDiv" class="optionDiv">
      <h1>FDP Attended</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInput2' onkeyup='myFunction2()' placeholder='search for FDP Name..'>
      </div>
      <div class='scroll'>
        <table id='myTable2'>
          <tr class='header'>
            <th>Name</th>
            <th>FDP Name</th>
            <th>Organisation</th>
            <th>Mode</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration</th>
            <th>Department</th>
            <th>Certificate</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM fdp WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['fdpname']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['mode']; ?></td>
                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
                <td><?php echo $rows['department']; ?></td>
                <td><?php echo !empty($rows['certificate_link']) ? "<a href='" . htmlspecialchars($rows['certificate_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='efdp.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=fdp&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='11'>No FDP records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- ============ FDP ORGANIZED -> fdporg ============ -->
    <div id="fdporgDiv" class="optionDiv">
      <h1>FDP Organized</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputfo' onkeyup='myFunctionfo()' placeholder='search for FDP Name..'>
      </div>
      <div class='scroll'>
        <table id='myTablefo'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>FDP Name</th>
            <th>Association</th>
            <th>Mode</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration</th>
            <th>Certificate</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM fdporg WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['fdp_name']; ?></td>
                <td><?php echo $rows['association']; ?></td>
                <td><?php echo $rows['mode']; ?></td>
                <td><?php echo $rows['start_date']; ?></td>
                <td><?php echo $rows['end_date']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
                <td><?php echo !empty($rows['certificate_link']) ? "<a href='" . htmlspecialchars($rows['certificate_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='efdporg.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=fdporg&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='11'>No FDP-organized records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>
    <div id="eventsDiv" class="optionDiv">
      <h1>Workshop </h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputev' onkeyup='myFunctionev()' placeholder='search by type (workshop/seminar/conference)..'>
      </div>
      <div class='scroll'>
        <table id='myTableev'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Type</th>
            <th>Organisation</th>
            <th>Mode</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration</th>
            <th>Certificate</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM ffworkshop WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['workshop']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['mode']; ?></td>
                <td><?php echo $rows['start_date']; ?></td>
                <td><?php echo $rows['end_date']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
                <td><?php echo !empty($rows['certificate_link']) ? "<a href='" . htmlspecialchars($rows['certificate_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='eworkshop.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=ffworkshop&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='11'>No workshop/seminar/conference records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- ============ CERTIFICATES -> certificates ============ -->
    <div id="certificateDiv" class="optionDiv">
      <h1>Certificates</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInput1' onkeyup='myFunction1()' placeholder='search for certificate name..'>
      </div>
      <div class='scroll'>
        <table id='myTable1'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Certificate</th>
            <th>Organisation</th>
            <th>Mode</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration</th>
            <th>Certificate Link</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM certificates WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['certificate']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['mode']; ?></td>
                <td><?php echo $rows['start_date']; ?></td>
                <td><?php echo $rows['end_date']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
                <td><?php echo !empty($rows['certificate_link']) ? "<a href='" . htmlspecialchars($rows['certificate_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='ecert.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=certificates&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='11'>No certificate records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- ============ PAPER PUBLICATIONS -> paperpublications ============ -->
    <div id="paperpublicationDiv" class="optionDiv">
      <h1>Paper Publications</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInput3' onkeyup='myFunction3()' placeholder='search for paper title..'>
      </div>
      <div class='scroll'>
        <table id='myTable3'>
          <tr class='header'>
            <th>Name</th>
            <th>Title</th>
            <th>Journal</th>
            <th>Indexing Type</th>
            <th>Volume</th>
            <th>Number</th>
            <th>Academic Year</th>
            <th>Month</th>
            <th>URL/DOI</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM paperpublications WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['title']; ?></td>
                <td><?php echo $rows['journal']; ?></td>
                <td><?php echo $rows['indexing_type']; ?></td>
                <td><?php echo $rows['volume']; ?></td>
                <td><?php echo $rows['number']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['month']; ?></td>
                <td><?php echo !empty($rows['url_doi']) ? "<a href='" . htmlspecialchars($rows['url_doi']) . "' target='_blank'>Link</a>" : "—"; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='epp.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=paperpublications&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='12'></td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- ============ CONFERENCES -> conferences (this section was missing before) ============ -->
    <div id="conferencepapersDiv" class="optionDiv">
      <h1>Conferences</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputconf' onkeyup='myFunctionconf()' placeholder='search for paper title..'>
      </div>
      <div class='scroll'>
        <table id='myTableconf'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Co-authors</th>
            <th>Author Position</th>
            <th>Paper Title</th>
            <th>Conference Proceedings</th>
            <th>UGC/Scopus</th>
            <th>URL</th>
            <th>DOI</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM conferences WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['co_authors_count']; ?></td>
                <td><?php echo $rows['author_type']; ?></td>
                <td><?php echo $rows['paper_title']; ?></td>
                <td><?php echo $rows['conference_proceedings']; ?></td>
                <td><?php echo $rows['ugc_scopus']; ?></td>
                <td><?php echo !empty($rows['url']) ? "<a href='" . htmlspecialchars($rows['url']) . "' target='_blank'>Link</a>" : "—"; ?></td>
                <td><?php echo $rows['doi']; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='econf.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=conferences&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='12'>No conference records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- ============ BOOK CHAPTERS PUBLISHED -> bookpublish ============ -->
    <div id="bookpublishedDiv" class="optionDiv">
      <h1>Book Chapters Published</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInput4' onkeyup='myFunction4()' placeholder='search for title..'>
      </div>
      <div class='scroll'>
        <table id='myTable4'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Month</th>
            <th>No. of Authors</th>
            <th>Author Position</th>
            <th>Title</th>
            <th>Publisher</th>
            <th>Scopus/SCI</th>
            <th>ISBN</th>
            <th>DOI</th>
            <th>URL</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM bookpublish WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['month']; ?></td>
                <td><?php echo $rows['no_of_authors']; ?></td>
                <td><?php echo $rows['author_position']; ?></td>
                <td><?php echo $rows['title']; ?></td>
                <td><?php echo $rows['publisher']; ?></td>
                <td><?php echo $rows['scopus_sci']; ?></td>
                <td><?php echo $rows['isbn']; ?></td>
                <td><?php echo $rows['doi']; ?></td>
                <td><?php echo !empty($rows['url']) ? "<a href='" . htmlspecialchars($rows['url']) . "' target='_blank'>Link</a>" : "—"; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='ebp.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=bookpublish&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='14'>No book publication records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- ============ BOOK CHAPTERS EDITED -> bookedited ============ -->
    <div id="bookeditedDiv" class="optionDiv">
      <h1>Book Chapters Edited</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInput5' onkeyup='myFunction5()' placeholder='search for book name..'>
      </div>
      <div class='scroll'>
        <table id='myTable5'>
          <tr class='header'>
            <th>Name</th>
            <th>No. of Authors</th>
            <th>Book Name</th>
            <th>Publisher</th>
            <th>ISBN</th>
            <th>URL</th>
            <th>Academic Year</th>
            <th>Month</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM bookedited WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['no_of_authors']; ?></td>
                <td><?php echo $rows['book_name']; ?></td>
                <td><?php echo $rows['publisher_name']; ?></td>
                <td><?php echo $rows['isbn_number']; ?></td>
                <td><?php echo !empty($rows['url']) ? "<a href='" . htmlspecialchars($rows['url']) . "' target='_blank'>Link</a>" : "—"; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['month']; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='ebe.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=bookedited&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='11'>No book-edited records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- ============ TEXTBOOK -> textbook ============ -->
    <!-- No faculty_id column in this table, filtered by faculty_name -->
    <div id="textbookDiv" class="optionDiv">
      <h1>Textbook</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputtb' onkeyup='myFunctiontb()' placeholder='search for textbook name..'>
      </div>
      <div class='scroll'>
        <table id='myTabletb'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Month</th>
            <th>Main Editor</th>
            <th>Textbook Name</th>
            <th>Publisher</th>
            <th>URL</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM textbook WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['month']; ?></td>
                <td><?php echo $rows['main_editor']; ?></td>
                <td><?php echo $rows['textbook_name']; ?></td>
                <td><?php echo $rows['publisher_name']; ?></td>
                <td><?php echo !empty($rows['url']) ? "<a href='" . htmlspecialchars($rows['url']) . "' target='_blank'>Link</a>" : "—"; ?></td>
                <td><a href='etextbook.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=textbook&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='9'>No textbook records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- ============ PATENTS -> patents ============ -->
    <!-- No faculty_id column in this table, filtered by faculty_name -->
    <div id="patentsDiv" class="optionDiv">
      <h1>Patents</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputpt' onkeyup='myFunctionpt()' placeholder='search for patent details..'>
      </div>
      <div class='scroll'>
        <table id='myTablept'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Month</th>
            <th>Patent Details</th>
            <th>Area</th>
            <th>Application No.</th>
            <th>Status</th>
            <th>Type</th>
            <th>Filing Agency</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM patents WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['month']; ?></td>
                <td><?php echo $rows['patent_details']; ?></td>
                <td><?php echo $rows['area_of_patent']; ?></td>
                <td><?php echo $rows['application_number']; ?></td>
                <td><?php echo $rows['status']; ?></td>
                <td><?php echo $rows['patent_type']; ?></td>
                <td><?php echo $rows['filing_agency']; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='epatents.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=patents&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='12'>No patent records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <div id="nptelDiv" class="optionDiv">
      <h1>NPTEL</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputnp' onkeyup='myFunctionnp()' placeholder='search for course name..'>
      </div>
      <div class='scroll'>
        <table id='myTablenp'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Course Name</th>
            <th>Duration</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Percentage</th>
            <th>Top %</th>
            <th>Remarks</th>
            <th>Certificate</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM nptel WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['course_name']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
                <td><?php echo $rows['start_date']; ?></td>
                <td><?php echo $rows['end_date']; ?></td>
                <td><?php echo $rows['percentage']; ?></td>
                <td><?php echo $rows['top_percentage']; ?></td>
                <td><?php echo $rows['remarks']; ?></td>
                <td><?php echo !empty($rows['certificate_link']) ? "<a href='" . htmlspecialchars($rows['certificate_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='enptel.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=nptel&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='12'>No NPTEL records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <div id="achievementsDiv" class="optionDiv">
      <h1>Achievements</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputach' onkeyup='myFunctionach()' placeholder='search for award name..'>
      </div>
      <div class='scroll'>
        <table id='myTableach'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Award Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Organization</th>
            <th>Link</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM achievements WHERE faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['award_name']; ?></td>
                <td><?php echo $rows['description']; ?></td>
                <td><?php echo $rows['achievement_date']; ?></td>
                <td><?php echo $rows['organization']; ?></td>
                <td><?php echo !empty($rows['achievement_link']) ? "<a href='" . htmlspecialchars($rows['achievement_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='eachievements.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=achievements&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='9'>No achievement records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <div id="outsideparticipationsDiv" class="optionDiv">
      <h1>Outside Participations</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputop' onkeyup='myFunctionop()' placeholder='search for organization..'>
      </div>
      <div class='scroll'>
        <table id='myTableop'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Month</th>
            <th>Date Attended</th>
            <th>Organization</th>
            <th>Conference/Journal</th>
            <th>Type</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM outside_participations WHERE  faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['month']; ?></td>
                <td><?php echo $rows['date_attended']; ?></td>
                <td><?php echo $rows['organization']; ?></td>
                <td><?php echo $rows['conference_journal_name']; ?></td>
                <td><?php echo $rows['type']; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='eoutside.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=outside_participations&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='10'>No outside-participation records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>
    <div id="revieweractivitiesDiv" class="optionDiv">
      <h1>Reviewer Activities</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputra' onkeyup='myFunctionra()' placeholder='search for organization..'>
      </div>
      <div class='scroll'>
        <table id='myTablera'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Month</th>
            <th>Date Attended</th>
            <th>Organization</th>
            <th>Conference/Journal</th>
            <th>Type</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM reviewer_activities WHERE  faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['month']; ?></td>
                <td><?php echo $rows['date_attended']; ?></td>
                <td><?php echo $rows['organization']; ?></td>
                <td><?php echo $rows['conference_journal_name']; ?></td>
                <td><?php echo $rows['type']; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='ereviewer.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=reviewer_activities&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='10'>No reviewer-activity records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <div id="professionalmembershipDiv" class="optionDiv">
      <h1>Professional Membership</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputpm' onkeyup='myFunctionpm()' placeholder='search for membership name..'>
      </div>
      <div class='scroll'>
        <table id='myTablepm'>
          <tr class='header'>
            <th>Name</th>
            <th>Membership Name</th>
            <th>Membership ID</th>
            <th>Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM professional_membership  WHERE  faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['membership_name']; ?></td>
                <td><?php echo $rows['membership_id']; ?></td>
                <td><?php echo $rows['membership_type']; ?></td>
                <td><?php echo $rows['start_date']; ?></td>
                <td><?php echo $rows['end_date']; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='emembership.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=professional_membership&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='9'>No professional-membership records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <div id="phddetailsDiv" class="optionDiv">
      <h1>PhD Details</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputphd' onkeyup='myFunctionphd()' placeholder='search for university name..'>
      </div>
      <div class='scroll'>
        <table id='myTablephd'>
          <tr class='header'>
            <th>Name</th>
            <th>University</th>
            <th>Status</th>
            <th>Domain</th>
            <th>Date of Completion</th>
            <th>Pursuing Year</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM phd_details WHERE  faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['university_name']; ?></td>
                <td><?php echo $rows['status']; ?></td>
                <td><?php echo $rows['domain_name']; ?></td>
                <td><?php echo $rows['date_of_completion']; ?></td>
                <td><?php echo $rows['pursuing_year']; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='ephd.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=phd_details&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='9'>No PhD records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <div id="consultancyworkDiv" class="optionDiv">
      <h1>Consultancy Work <span style="color:var(--danger);font-size:.7rem;text-transform:none;">(showing ALL faculty — see note in code)</span></h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputcw' onkeyup='myFunctioncw()' placeholder='search for organization..'>
      </div>
      <div class='scroll'>
        <table id='myTablecw'>
          <tr class='header'>
            <th>Academic Year</th>
            <th>Description</th>
            <th>Organization</th>
            <th>Amount</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration</th>
            <th>Students Involved</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM consultancy_work WHERE  faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['description']; ?></td>
                <td><?php echo $rows['organization']; ?></td>
                <td><?php echo $rows['amount']; ?></td>
                <td><?php echo $rows['start_date']; ?></td>
                <td><?php echo $rows['end_date']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
                <td><?php echo $rows['students_involved']; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='econsultancy.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=consultancy_work&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='11'>No consultancy-work records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <div id="workingmodelsDiv" class="optionDiv">
      <h1>Working Models <span style="color:var(--danger);font-size:.7rem;text-transform:none;">(showing ALL faculty — see note in code)</span></h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputwm' onkeyup='myFunctionwm()' placeholder='search for model name..'>
      </div>
      <div class='scroll'>
        <table id='myTablewm'>
          <tr class='header'>
            <th>Academic Year</th>
            <th>Model Name</th>
            <th>Duration</th>
            <th>Students Count</th>
            <th>Domain</th>
            <th>Proof</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM working_models WHERE  faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['model_name']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
                <td><?php echo $rows['students_count']; ?></td>
                <td><?php echo $rows['domain_name']; ?></td>
                <td><?php echo !empty($rows['proof_link']) ? "<a href='" . htmlspecialchars($rows['proof_link']) . "' target='_blank'>View</a>" : "—"; ?></td>
                <td><a href='eworkingmodels.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=working_models&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='8'>No working-model records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <div id="fundingprojectsDiv" class="optionDiv">
      <h1>Funding Projects</h1>
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
          <circle cx="11" cy="11" r="7" />
          <path d="M21 21l-4.3-4.3" stroke-linecap="round" />
        </svg>
        <input type='text' id='myInputfp' onkeyup='myFunctionfp()' placeholder='search for project title..'>
      </div>
      <div class='scroll'>
        <table id='myTablefp'>
          <tr class='header'>
            <th>Name</th>
            <th>Academic Year</th>
            <th>Title</th>
            <th>Agency</th>
            <th>Amount</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration</th>
            <th>Funding Type</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php
          $query = "SELECT * FROM funding_projects WHERE  faculty_id='$id'";
          $result = mysqli_query($conn, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
          ?>
              <tr>
                <td><?php echo $rows['faculty_name']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php echo $rows['title']; ?></td>
                <td><?php echo $rows['agency_name']; ?></td>
                <td><?php echo $rows['amount']; ?></td>
                <td><?php echo $rows['start_date']; ?></td>
                <td><?php echo $rows['end_date']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
                <td><?php echo $rows['funding_type']; ?></td>
                <td><a href='efunding.php?id=<?php echo $rows['id']; ?>'><button class='btn'>Edit</button></a></td>
                <td><a href='dwa.php?table=funding_projects&id=<?php echo $rows['id']; ?>'><button class='btn'>Delete</button></a></td>
              </tr>
          <?php
            }
          } else {
            echo "<tr class='empty-row'><td colspan='11'>No funding-project records found yet.</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

  </div>
  <br>

  <script type="text/javascript">
    function myFun() {
      var sections = document.getElementsByClassName('optionDiv');
      for (var i = 0; i < sections.length; i++) sections[i].style.display = 'none';
      var val = document.getElementById("mySelect").value;
      if (val) {
        var target = document.getElementById(val + "Div");
        if (target) target.style.display = 'block';
      }
    }
  </script>

  <script src="mainl.js"></script>
  <script>
    function myFunction2() {
      filterTable("myInput2", "myTable2", 1);
    }

    function myFunctionfo() {
      filterTable("myInputfo", "myTablefo", 2);
    }

    function myFunctionev() {
      filterTable("myInputev", "myTableev", 2);
    }

    function myFunction1() {
      filterTable("myInput1", "myTable1", 2);
    }

    function myFunction3() {
      filterTable("myInput3", "myTable3", 1);
    }

    function myFunctionconf() {
      filterTable("myInputconf", "myTableconf", 4);
    }

    function myFunction4() {
      filterTable("myInput4", "myTable4", 5);
    }

    function myFunction5() {
      filterTable("myInput5", "myTable5", 2);
    }

    function myFunctiontb() {
      filterTable("myInputtb", "myTabletb", 4);
    }

    function myFunctionpt() {
      filterTable("myInputpt", "myTablept", 3);
    }

    function myFunctionnp() {
      filterTable("myInputnp", "myTablenp", 2);
    }

    function myFunctionach() {
      filterTable("myInputach", "myTableach", 2);
    }

    function myFunctionop() {
      filterTable("myInputop", "myTableop", 4);
    }

    function myFunctionra() {
      filterTable("myInputra", "myTablera", 4);
    }

    function myFunctionpm() {
      filterTable("myInputpm", "myTablepm", 1);
    }

    function myFunctionphd() {
      filterTable("myInputphd", "myTablephd", 1);
    }

    function myFunctioncw() {
      filterTable("myInputcw", "myTablecw", 2);
    }

    function myFunctionwm() {
      filterTable("myInputwm", "myTablewm", 1);
    }

    function myFunctionfp() {
      filterTable("myInputfp", "myTablefp", 2);
    }

    function filterTable(inputId, tableId, colIndex) {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById(inputId);
      filter = input.value.toUpperCase();
      table = document.getElementById(tableId);
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        if (tr[i].classList.contains('empty-row')) continue;
        td = tr[i].getElementsByTagName("td")[colIndex];
        if (td) {
          txtValue = td.textContent || td.innerText;
          tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
      }
    }
  </script>
</body>

</html>