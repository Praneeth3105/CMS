<?php

include "db_conn.php";
session_start();

// Resolve where a student's saved photo actually lives on disk.
// Photos may be in the current student_profile/ folder, directly in
// images/, or some other legacy subfolder — so after checking the two
// known spots, fall back to searching the whole images/ tree for a
// file with this exact name.
function resolveStudentPicUrl($pic)
{
  if (empty($pic)) {
    return null;
  }

  $picClean = ltrim(str_replace('\\', '/', $pic), '/');
  $needle = basename($picClean);

  $candidates = [
    'images/student_profile/' . $needle,
    'images/' . $picClean,
    'images/' . $needle,
  ];
  foreach ($candidates as $rel) {
    if (file_exists(__DIR__ . '/' . $rel)) {
      return $rel;
    }
  }

  $imagesRoot = __DIR__ . '/images';
  if (is_dir($imagesRoot)) {
    $it = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($imagesRoot, FilesystemIterator::SKIP_DOTS)
    );
    foreach ($it as $file) {
      if ($file->isFile() && strcasecmp($file->getFilename(), $needle) === 0) {
        return str_replace('\\', '/', substr($file->getPathname(), strlen(__DIR__) + 1));
      }
    }
  }

  return null;
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <title>CERTIFICATE MAINTANCE SYSTEM</title>
  <link rel="stylesheet" href="lightbox.min.css">
  <script src="lightbox-plus-jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap');

    :root {
      --bg-cream: #f4efe4;
      --bg-dark: #17120e;
      --bg-dark2: #211a14;
      --gold: #caa24c;
      --gold-light: #e6c877;
      --white: #ffffff;
      --ink: #2a231c;
      --border: #e6ddc8;
      --shadow: 0 10px 30px rgba(23, 18, 14, 0.10);
    }

    * {
      box-sizing: border-box;
    }

    body {
      background: var(--bg-cream);
      font-family: 'Poppins', sans-serif;
      color: var(--ink);
      margin: 0;
      padding-bottom: 60px;
    }

    h1 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      margin: 26px 0 16px 0;
    }

    h1::after {
      content: "";
      display: block;
      width: 64px;
      height: 3px;
      background: var(--gold);
      margin-top: 10px;
      border-radius: 2px;
    }

    .topbar {
      background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-dark2) 100%);
      padding: 18px 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: var(--shadow);
    }

    .topbar .n {
      text-decoration: none;
    }

    .btn,
    button,
    input[type=submit] {
      background: var(--bg-dark);
      color: var(--gold-light);
      border: 1px solid var(--gold);
      border-radius: 999px;
      padding: 10px 22px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn:hover,
    button:hover,
    input[type=submit]:hover {
      background: var(--gold);
      color: var(--bg-dark);
    }

    .topbar .btn {
      float: none;
    }

    .panel {
      background: var(--white);
      margin: 24px 32px;
      padding: 24px 28px;
      border-radius: 14px;
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }

    .filters {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      margin-bottom: 22px;
    }

    select {
      background-color: var(--white) !important;
      color: var(--ink) !important;
      border: 1px solid var(--gold) !important;
      border-radius: 8px;
      padding: 11px 16px;
      font-size: 15px;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      float: none !important;
      width: 220px !important;
    }

    #myTable {
      border-collapse: collapse;
      width: 100%;
      background: var(--white);
      font-size: 14.5px;
      border-radius: 10px;
      overflow: hidden;
    }

    #myTable th,
    #myTable td {
      text-align: left;
      padding: 12px 14px;
      border-bottom: 1px solid var(--border);
    }

    #myTable tr.header {
      background: var(--bg-dark);
      color: var(--gold-light);
      font-weight: 600;
    }

    #myTable tr:hover {
      background-color: #faf6ea;
    }

    .n {
      text-decoration: none;
    }

    .scroll {
      height: auto;
      width: 100%;
      overflow-x: auto;
    }

    @media only screen and (max-width: 900px) {
      .scroll {
        width: 100%;
      }

      .panel {
        margin: 16px;
        padding: 18px;
      }

      .filters {
        flex-direction: column;
      }

      select {
        width: 100% !important;
      }
    }
  </style>
</head>

<body>
  <div class="topbar">
    <a href="admin.php" class="n"><button type="button" class="btn" id="btn1">Back</button></a>
    <a href="logout.php" class="n"><button type="button" class="btn">Logout</button></a>
  </div>

  <div class="panel">
    <form method="post" action="ucharge.php">
      <div class="filters">
        <select name='faculty' required>
          <option selected disabled value="">Faculties</option>
          <?php

          $query = "SELECT * FROM faculty";
          $result = mysqli_query($conn, $query);
          while ($rows = mysqli_fetch_assoc($result)) {
          ?>

            <option value="<?php echo htmlspecialchars($rows['id']); ?>"><?php echo htmlspecialchars($rows['name']); ?></option>
          <?php
          }
          ?>
        </select>
        <select id='year' onchange='filterTable()'>
          <option value="year">Year</option>
          <option value="1">1st</option>
          <option value="2">2nd</option>
          <option value="3">3rd</option>
          <option value="4">4th</option>
        </select>
        <select id='year1' onchange='filterTable()'>
          <option value="Branch">Branch</option>
          <option value="CSM">CSM</option>
          <option value="CSE">CSE</option>
          <option value="CSO">CSO</option>
          <option value="CIC">CIC</option>
          <option value="EEE">EEE</option>
          <option value="ECE">ECE</option>
          <option value="MECH">MECH</option>
          <option value="CIVIL">CIVIL</option>
          <option value="CSD">CSD</option>
        </select>
      </div>


      <h1>STUDENT DETAILS</h1>
      <div class="container">

        <div class="login-content">
          <div class="scroll">

            <table id="myTable">
              <tr class="header">
                <th><input type='checkbox' id='selectAll' onclick='toggleAll(this)'> Check All</th>
                <th>Rollno</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Department</th>
                <th>year</th>
                <th>Address</th>
                <th>Email</th>
                <th>Class Teacher</th>
                <th>Counsular</th>
                <th>Photo</th>
              </tr>
              <?php

              $query = "SELECT * FROM studentdetails ";
              $result = mysqli_query($conn, $query);
              while ($rows = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><input type='checkbox' name='check[]' value='<?php echo htmlspecialchars($rows['username']); ?>' style='width:90%;height:90%;'></td>
                  <td><?php echo htmlspecialchars($_SESSION['un'] = $rows['username']); ?></td>
                  <td><?php echo htmlspecialchars($rows['name']); ?></td>
                  <td><?php echo htmlspecialchars($rows['number']); ?></td>
                  <td><?php echo htmlspecialchars($rows['department']); ?></td>
                  <td><?php echo htmlspecialchars($rows['year']); ?></td>
                  <td><?php echo htmlspecialchars($rows['location']); ?></td>
                  <td><?php echo htmlspecialchars($rows['email']); ?></td>
                  <td><?php echo htmlspecialchars($rows['classteacher']); ?></td>
                  <td><?php echo htmlspecialchars($rows['counsular']); ?></td>
                  <td><?php
                      $picUrl = resolveStudentPicUrl($rows['pic'] ?? null);
                      if ($picUrl) {
                        echo "<a href='" . htmlspecialchars($picUrl) . "' data-lightbox='mygallery'><img src='" . htmlspecialchars($picUrl) . "' width='200' height='100'></a>";
                      } else {
                        echo "&mdash;";
                      }
                      ?></td>

                </tr>
              <?php
              }
              ?>

            </table>
          </div>
          <br>
          <input type='submit' value='Assign' name='submit'>
        </div>

      </div>

    </form>
  </div>
  <script src="mainl.js"></script>
  <script>
    function filterTable() {
      var yearInput = document.getElementById("year");
      var branchInput = document.getElementById("year1");

      var yearFilter = yearInput.value === "year" ? "" : yearInput.value.trim().toUpperCase();
      var branchFilter = branchInput.value === "Branch" ? "" : branchInput.value.trim().toUpperCase();

      var table = document.getElementById("myTable");
      var tr = table.getElementsByTagName("tr");

      for (var i = 0; i < tr.length; i++) {
        if (tr[i].classList.contains("header")) continue; // skip header row

        var tds = tr[i].getElementsByTagName("td");
        if (tds.length < 6) continue;

        var yearVal = (tds[5].textContent || tds[5].innerText).trim().toUpperCase();
        var branchVal = (tds[4].textContent || tds[4].innerText).trim().toUpperCase();

        var yearMatch = yearFilter === "" || yearVal === yearFilter;
        var branchMatch = branchFilter === "" || branchVal === branchFilter;

        tr[i].style.display = (yearMatch && branchMatch) ? "" : "none";
      }

      // reset select-all when the filter changes, so it doesn't look stuck checked
      var selectAll = document.getElementById("selectAll");
      if (selectAll) {
        selectAll.checked = false;
      }
    }

    function toggleAll(source) {
      var table = document.getElementById("myTable");
      var tr = table.getElementsByTagName("tr");
      for (var i = 0; i < tr.length; i++) {
        // skip the header row and any row hidden by the year/branch filter
        if (tr[i].classList.contains('header')) continue;
        if (tr[i].style.display === "none") continue;

        var checkbox = tr[i].querySelector("input[type='checkbox']");
        if (checkbox) {
          checkbox.checked = source.checked;
        }
      }
    }
  </script>
</body>

</html>