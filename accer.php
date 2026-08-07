<?php
          include "db_conn.php";
          session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>CERTIFICATE MAINTENANCE SYSTEM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="lightbox-plus-jquery.min.js"></script>
  <style>
    :root {
      --dark: #1c1510;
      --dark-2: #241b14;
      --gold: #c9a227;
      --gold-light: #d9b84a;
      --cream: #f5efe4;
      --card-bg: #ffffff;
      --text-dark: #2b2318;
      --text-muted: #6b6155;
      --border: #e6ddc9;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Georgia, 'Times New Roman', serif;
      background: var(--cream);
      color: var(--text-dark);
      overflow-y: auto;
    }
    .topbar {
      background: linear-gradient(180deg, var(--dark) 0%, var(--dark-2) 100%);
      padding: 18px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 2px solid var(--gold);
    }

    .topbar h1 {
      color: #f2ead8;
      font-size: 22px;
      margin: 0;
      letter-spacing: 0.5px;
    }

    .topbar h1 span {
      color: var(--gold-light);
    }

    .btn {
      font-family: Georgia, serif;
      font-weight: 600;
      font-size: 14px;
      letter-spacing: 0.4px;
      padding: 10px 22px;
      border-radius: 999px;
      border: 1px solid var(--gold);
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-dark {
      background: var(--dark);
      color: var(--gold-light);
    }

    .btn-dark:hover {
      background: #000;
    }

    .btn-gold {
      background: var(--gold);
      color: var(--dark);
      border-color: var(--gold);
    }

    .btn-gold:hover {
      background: var(--gold-light);
    }

    .n {
      text-decoration: none;
    }

    .top-actions {
      display: flex;
      gap: 12px;
    }

    .page-heading {
      text-align: center;
      margin: 34px 0 22px;
    }

    .page-heading .eyebrow {
      color: var(--text-muted);
      letter-spacing: 3px;
      font-size: 12px;
      text-transform: uppercase;
      font-family: Arial, sans-serif;
      margin-bottom: 6px;
    }

    .page-heading h2 {
      font-size: 30px;
      margin: 0;
      color: var(--text-dark);
    }

    .page-heading h2 span {
      color: #a0522d;
    }


    .container {
      max-width: 1300px;
      margin: 0 auto 60px;
      padding: 0 24px;
    }

    .login-content {
      background: var(--card-bg);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(28, 21, 16, 0.08);
      padding: 24px;
    }

    .search-wrap {
      position: relative;
      margin-bottom: 18px;
    }

    .search-wrap::before {
      content: "\1F50D";
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 16px;
      opacity: 0.55;
    }

    #myInput,
    #myInput1,
    #myInput2,
    #myInput3,
    #myInput4,
    #myInput5 {
      width: 100%;
      font-size: 15px;
      font-family: Arial, sans-serif;
      padding: 12px 16px 12px 40px;
      border: 1px solid var(--border);
      border-radius: 10px;
      background: #faf7f0;
      outline: none;
      transition: border-color 0.2s ease;
    }

    #myInput:focus,
    #myInput1:focus,
    #myInput2:focus,
    #myInput3:focus,
    #myInput4:focus,
    #myInput5:focus {
      border-color: var(--gold);
    }

    .scroll {
      overflow-x: auto;
      width: 100%;
      border-radius: 12px;
      border: 1px solid var(--border);
    }

    #myTable,
    #myTable1,
    #myTable2,
    #myTable3,
    #myTable4,
    #myTable5 {
      border-collapse: collapse;
      width: 100%;
      font-family: Arial, sans-serif;
      font-size: 15px;
      min-width: 1100px;
    }

    #myTable th,
    #myTable td,
    #myTable1 th,
    #myTable1 td,
    #myTable2 th,
    #myTable2 td,
    #myTable3 th,
    #myTable3 td,
    #myTable4 th,
    #myTable4 td,
    #myTable5 th,
    #myTable5 td {
      text-align: left;
      padding: 14px 12px;
    }

    #myTable tr.header,
    #myTable1 tr.header,
    #myTable2 tr.header,
    #myTable3 tr.header,
    #myTable4 tr.header,
    #myTable5 tr.header {
      background: var(--dark);
    }

    #myTable tr.header th,
    #myTable1 tr.header th,
    #myTable2 tr.header th,
    #myTable3 tr.header th,
    #myTable4 tr.header th,
    #myTable5 tr.header th {
      color: var(--gold-light);
      font-weight: 600;
      letter-spacing: 0.3px;
      white-space: nowrap;
    }

    #myTable tr,
    #myTable1 tr,
    #myTable2 tr,
    #myTable3 tr,
    #myTable4 tr,
    #myTable5 tr {
      border-bottom: 1px solid var(--border);
    }

    #myTable tr:hover:not(.header),
    #myTable1 tr:hover:not(.header),
    #myTable2 tr:hover:not(.header),
    #myTable3 tr:hover:not(.header),
    #myTable4 tr:hover:not(.header),
    #myTable5 tr:hover:not(.header) {
      background-color: #faf3e3;
    }

    #myTable td img,
    #myTable1 td img,
    #myTable2 td img,
    #myTable3 td img,
    #myTable4 td img,
    #myTable5 td img {
      border-radius: 8px;
      border: 1px solid var(--border);
      object-fit: cover;
    }

    .update-wrap {
      text-align: center;
      margin-top: 24px;
    }
  </style>
</head>

<body>

  <div class="topbar">
    <h1>Certificate <span>Management</span> System</h1>
    <div class="top-actions">
      <a href="studentdat.php" class="n"><button type="button" class="btn btn-dark">&larr; Back</button></a>
      <a href="acceradd.php" class="n"><button type="button" class="btn btn-gold">+ Add</button></a>
    </div>
  </div>

  <div class="page-heading">
    <div class="eyebrow">Digital Records, Verified</div>
    <h2>Academic <span>Certificates</span></h2>
  </div>

  <div class="container">
    <div class="login-content">
      <div class="search-wrap">
        <input type="text" id="myInput" onkeyup="filterTable()" placeholder="Search by name or roll number...">
      </div>
      <div class="scroll">
        <table id="myTable">
          <tr class="header">
            <th>Name</th>
            <th>Rollno</th>
            <th>Aadhar Card</th>
            <th>SSC Memo</th>
            <th>Inter Memo</th>
            <th>1-1 Memo</th>
            <th>1-2 Memo</th>
            <th>2-1 Memo</th>
            <th>2-2 Memo</th>
            <th>3-1 Memo</th>
            <th>3-2 Memo</th>
            <th>4-1 Memo</th>
            <th>4-2 Memo</th>
          </tr>
          <?php
          $uname = $_SESSION['username'];
          $query = "SELECT * FROM academic where rollno='$uname'";
          $result = mysqli_query($conn, $query);
          while ($rows = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?php echo $rows['name']; ?></td>
              <td><?php echo $rows['rollno']; ?></td>
              <td><?php echo "<a href='file/" . $rows['aadhar'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['aadhar'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['ssc'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['ssc'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['inter'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['inter'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['semoo'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semoo'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['semot'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semot'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['semto'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semto'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['semtt'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semtt'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['semtho'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semtho'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['semtht'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semtht'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['semfo'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semfo'] . "' width='140' height='90' ></a>"; ?></td>
              <td><?php echo "<a href='file/" . $rows['semft'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semft'] . "' width='140' height='90' ></a>"; ?></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
      <div class="update-wrap">
        <a href="accerupd.php" class="n"><button type="button" class="btn btn-gold" style="width:30%;">Update</button></a>
      </div>
    </div>
  </div>

  <script>
    function filterTable() {
      var input, filter, table, tr, td, i, j, txtValue, found;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      for (i = 1; i < tr.length; i++) {
        found = false;
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < 2 && j < td.length; j++) {
          if (td[j]) {
            txtValue = td[j].textContent || td[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              found = true;
            }
          }
        }
        tr[i].style.display = found ? "" : "none";
      }
    }
  </script>

</body>

</html>
