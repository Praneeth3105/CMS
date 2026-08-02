<?php
include "db_conn.php";
session_start();
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
    button {
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
    button:hover {
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

    #myInput {
      background-color: var(--white);
      background-image: url('/css/searchicon.png');
      background-position: 12px 12px;
      background-repeat: no-repeat;
      width: 100%;
      max-width: 480px;
      font-size: 15px;
      padding: 11px 16px 11px 40px;
      border: 1px solid var(--border);
      border-radius: 8px;
      margin-bottom: 18px;
    }

    #myTable {
      border-collapse: collapse;
      width: 100%;
      background: var(--white);
      font-size: 14px;
      border-radius: 10px;
      overflow: hidden;
    }

    #myTable th,
    #myTable td {
      text-align: left;
      padding: 10px 12px;
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
    }
  </style>
</head>

<body>
  <div class="topbar">
    <a href="admin.php" class="n"><button type="button" class="btn" id="btn2">Back</button></a>
    <a href="logout.php" class="n"><button type="button" class="btn" id="btn1">Logout</button></a>
  </div>

  <div class="panel">
    <h1>Student Academic Certificates</h1>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="search by Student Rollno.." title="Type in a name">

    <div class="container">

      <div class="login-content">
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
            $query = "SELECT * FROM academic";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['rollno']; ?></td>
                <td><?php echo "<a href='file/" . $rows['aadhar'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['aadhar'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['ssc'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['ssc'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['inter'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['inter'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['semoo'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semoo'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['semot'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semot'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['semto'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semto'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['semtt'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semtt'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['semtho'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semtho'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['semtht'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semtht'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['semfo'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semfo'] . "' width='200' height='100' ></a>"; ?></td>
                <td><?php echo "<a href='file/" . $rows['semft'] . "' data-lightbox='mygallery' ><img src='file/" . $rows['semft'] . "' width='200' height='100' ></a>"; ?></td>

              </tr>
            <?php
            }
            ?>
          </table>
        </div>

      </div>
    </div>
  </div>

  <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
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