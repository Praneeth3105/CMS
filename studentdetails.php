<?php
include_once('db_conn.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <title>CERTIFICATE MAINTANCE SYSTEM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    :root {
      --dark: #1a120b;
      --dark-2: #2b1d13;
      --gold: #d4af37;
      --gold-soft: #c9a227;
      --gold-pale: #f0e2b8;
      --cream: #f5efe6;
      --cream-card: #fffdf8;
      --rust: #b5502e;
      --border: #e6ddc8;
      --muted: #8a7d6b;
      --radius: 20px;
      --radius-sm: 14px;
      --shadow: 0 10px 30px rgba(26, 18, 11, 0.12);
      --shadow-lg: 0 20px 45px rgba(26, 18, 11, 0.16);
    }

    * {
      box-sizing: border-box;
    }

    body {
      background: var(--cream);
      font-family: Arial, Helvetica, sans-serif;
      color: var(--dark);
      margin: 0;
      padding-bottom: 60px;
      overflow-x: hidden;
    }

    .n {
      text-decoration: none;
    }

    /* ---------- Top bar ---------- */
    .topbar {
      background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 100%);
      padding: 18px 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      box-shadow: var(--shadow);
    }
    .brand {
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem;
      font-weight: 700;
      color: var(--cream);
      letter-spacing: 0.3px;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .brand span {
      color: var(--gold);
    }

    .topbar-actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }

    .btn,
    button {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--dark-2);
      color: var(--gold-pale);
      border: 1px solid var(--gold-soft);
      border-radius: 999px;
      padding: 10px 22px;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 600;
      font-size: 13px;
      letter-spacing: 0.3px;
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

    .topbar .btn {
      margin: 0;
    }

    /* ---------- Page heading ---------- */
    .page-head {
      text-align: center;
      padding: 34px 20px 6px;
    }

    .page-head h1 {
      font-size: 1.7rem;
      letter-spacing: 1px;
      margin: 0;
      color: var(--dark);
      text-align: center;
      padding-left: 650px;
    }

    .page-head h1 span {
      color: var(--rust);
    }

    /* ---------- Panel ---------- */
    .container {
      max-width: 1300px;
      margin: 0 auto;
      padding: 0 24px 40px;
    }

    .login-content {
      background: var(--cream-card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow-lg);
      padding: 30px;
    }

    /* ---------- Search input ---------- */
    #myInput {
      background-color: var(--cream);
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%238a7d6b' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='7'/%3E%3Cpath d='M21 21l-4.3-4.3' stroke-linecap='round'/%3E%3C/svg%3E");
      background-position: 14px center;
      background-repeat: no-repeat;
      background-size: 18px 18px;
      width: 100%;
      font-size: 15px;
      font-family: Arial, Helvetica, sans-serif;
      padding: 13px 20px 13px 42px;
      border: 1px solid var(--border);
      border-radius: 999px;
      margin-bottom: 20px;
      outline: none;
      color: var(--dark);
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    #myInput:focus {
      border-color: var(--gold-soft);
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    /* ---------- Table ---------- */
    .scroll {
      height: auto;
      overflow-x: auto;
      width: 100%;
      border-radius: var(--radius-sm);
      border: 1px solid var(--border);
    }

    #myTable {
      border-collapse: collapse;
      width: 100%;
      min-width: 1150px;
      font-size: 14.5px;
      background: var(--cream-card);
    }

    #myTable thead tr,
    #myTable tr.header {
      background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 100%);
    }

    #myTable th {
      text-align: left;
      padding: 14px 16px;
      color: var(--gold-pale);
      font-weight: 600;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      font-size: 12.5px;
      white-space: nowrap;
    }

    #myTable td {
      text-align: left;
      padding: 13px 16px;
      color: var(--dark);
    }

    #myTable tr:not(.header) {
      border-bottom: 1px solid var(--border);
      transition: background 0.15s ease;
    }

    #myTable tr:not(.header):nth-child(even) {
      background: var(--cream);
    }

    #myTable tr:not(.header):hover {
      background: var(--gold-pale) !important;
    }

    #myTable img {
      border-radius: 10px;
      border: 1px solid var(--border);
      display: block;
    }

    #myTable embed {
      border-radius: 10px;
      border: 1px solid var(--border);
    }

    @media only screen and (max-width: 900px) {
      .topbar-actions {
        width: 100%;
        justify-content: space-between;
      }

      .btn {
        width: 48%;
        justify-content: center;
      }

      .login-content {
        padding: 18px;
      }

      .scroll {
        height: 70vh;
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
    <h1 class="brand">Student <span>Details</span></h1>
  </div>

  <form>
    <div class="container">
      <div class="login-content">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by student name..." title="Type in a name">

        <div class="scroll">
          <table id="myTable">
            <tr class="header">
              <th>Name</th>
              <th>Rollno</th>
              <th>Phone Number</th>
              <th>Department</th>
              <th>Year</th>
              <th>Address</th>
              <th>Email</th>
              <th>Class Teacher</th>
              <th>Counsular</th>
              <th>Academic Year</th>
              <th>Photo</th>
            </tr>
            <?php
            include "db_conn.php";
            $name = $_SESSION['name'];
            $query = "SELECT * FROM studentdetails";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['username']; ?></td>
                <td><?php echo $rows['number']; ?></td>
                <td><?php echo $rows['department']; ?></td>
                <td><?php echo $rows['year']; ?></td>
                <td><?php echo $rows['location']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['academic_year']; ?></td>
                <td><?php
                    $ext = pathinfo('images/' . $rows['pic'] . '', PATHINFO_EXTENSION);
                    if ($ext == 'pdf') {
                      echo "
<embed
    src='images/" . $rows['pic'] . "'
    type='application/pdf'
    frameBorder='0'
    scrolling='auto'
    height='100'
    width='200'
></embed>";
                    } else {
                      echo "<a href='images/" . $rows['pic'] . "' target='_blank' rel='noopener'><img src='images/" . $rows['pic'] . "' width='200' height='100'></a>";
                    }
                    ?></td>
              </tr>
            <?php
            } ?>
          </table>
        </div>
      </div>
    </div>
  </form>

  <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>
</body>

</html>