<?php
include_once('db_conn.php');
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
    <form method="post" action="uconsellor.php">

      <div class="filters">
        <select name='faculty' required>
          <option selected disabled value="">Faculties</option>
          <?php
          include "db_conn.php";
          session_start();
          $query = "SELECT * FROM faculty";
          $result = mysqli_query($conn, $query);
          while ($rows = mysqli_fetch_assoc($result)) {
          ?>

            <option value="<?php echo $rows['name']; ?>"><?php echo $rows['name']; ?></option>
          <?php
          }
          ?>
        </select>
        <select id='year' onclick='my()'>
          <option value="">Year</option>
          <option value="1">1st</option>
          <option value="2">2nd</option>
          <option value="3">3rd</option>
          <option value="4">4th</option>
        </select>
        <select id='year1' onclick='my()'>
          <option value="">Branch</option>
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
                <th>Check Box</th>
                <th>Rollno</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Department</th>
                <th>Year</th>
                <th>Address</th>
                <th>Email</th>
                <th>Class Teacher</th>
                <th>Counsular</th>
                <th>Photo</th>
              </tr>
              <?php

              $query = "SELECT * FROM studentdetails";
              $result = mysqli_query($conn, $query);
              while ($rows = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><input type='checkbox' name='check[]' value='<?php echo $rows['username']; ?>' style='width:90%;height:90%;'></td>
                  <td><?php echo $_SESSION['un'] = $rows['username']; ?></td>
                  <td><?php echo $rows['name']; ?></td>
                  <td><?php echo $rows['number']; ?></td>
                  <td><?php echo $rows['department']; ?></td>
                  <td><?php echo $rows['year']; ?></td>
                  <td><?php echo $rows['location']; ?></td>
                  <td><?php echo $rows['email']; ?></td>
                  <td><?php echo $rows['classteacher']; ?></td>
                  <td><?php echo $rows['counsular']; ?></td>
                  <td><?php echo "<a href='images/" . $rows['pic'] . "' data-lightbox='mygallery' ><img src='images/" . $rows['pic'] . "' width='200' height='100' ></a>"; ?></td>

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

    function myFunction1() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.btn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }

    function my() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("year");
      inp = document.getElementById("year1");
      filter = input.value.toUpperCase();
      filter1 = inp.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[5];
        td1 = tr[i].getElementsByTagName("td")[4];
        if (td && td1) {
          txtValue = td.textContent || td.innerText;
          txtValue1 = td1.textContent || td1.innerText;
          if ((txtValue.toUpperCase().indexOf(filter) > -1) && (txtValue1.toUpperCase().indexOf(filter1) > -1)) {
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