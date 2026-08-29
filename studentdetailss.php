<?php
        include "db_conn.php";
        session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <title>Student Details | Certificate Management System</title>
  <link rel="stylesheet" href="lightbox.min.css">
  <script src="lightbox-plus-jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap');

    :root {
      --dark: #1a120b;
      --dark-2: #2b1d13;
      --gold: #d4af37;
      --gold-soft: #c9a227;
      --gold-pale: #f0e2b8;
      --cream: #f5efe6;
      --cream-card: #fffdf8;
      --rust: #b5502e;
      --radius: 18px;
      --radius-sm: 10px;
      --shadow: 0 10px 30px rgba(26, 18, 11, 0.15);
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--cream);
      color: var(--dark);
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }

    .n {
      text-decoration: none;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 18px 32px;
      background: linear-gradient(120deg, var(--dark) 0%, var(--dark-2) 100%);
    }

    .brand {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem;
      font-weight: 700;
      color: var(--cream);
      letter-spacing: 0.3px;
      margin: 0;
    }

    .brand span {
      color: var(--gold);
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 26px;
      background: var(--dark-2);
      color: var(--gold-pale) !important;
      border: 1px solid var(--gold-soft);
      border-radius: 999px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 0.85rem;
      letter-spacing: 0.4px;
      cursor: pointer;
      transition: all 0.25s ease;
      text-transform: uppercase;
      float: none !important;
      width: auto !important;
    }

    .btn:hover {
      background: var(--gold);
      color: var(--dark) !important;
      border-color: var(--gold);
      transform: translateY(-1px);
    }

    /* ---------- Page hero ---------- */
    .page-hero {
      text-align: center;
      padding: 40px 24px 10px;
    }

    .page-hero .eyebrow {
      text-transform: uppercase;
      letter-spacing: 3px;
      font-size: 0.75rem;
      color: var(--rust);
      font-weight: 600;
      margin-bottom: 10px;
    }

    .page-hero h2 {
      font-family: 'Playfair Display', serif;
      font-size: 2.1rem;
      font-weight: 700;
      color: var(--dark);
      margin: 0 0 8px;
    }

    .page-hero h2 .accent {
      color: var(--gold-soft);
    }

    /* ---------- Search + table wrap ---------- */
    .data-wrap {
      max-width: 1300px;
      margin: 0 auto 60px;
      padding: 0 32px;
    }

    #myInput {
      width: 100%;
      font-size: 15px;
      padding: 13px 20px 13px 44px;
      border: 1px solid var(--gold-soft);
      border-radius: 999px;
      background: var(--cream-card) url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%23c9a227" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>') no-repeat 16px center;
      background-size: 16px 16px;
      color: var(--dark);
      font-family: 'Poppins', sans-serif;
      margin-bottom: 20px;
      box-shadow: var(--shadow);
      outline: none;
    }

    #myInput:focus {
      border-color: var(--gold);
    }

    .scroll {
      overflow-x: auto;
      border-radius: var(--radius-sm);
      box-shadow: var(--shadow);
    }

    table {
      border-collapse: collapse;
      width: 100%;
      min-width: 1100px;
      background: var(--cream-card);
    }

    th {
      background: var(--dark);
      color: var(--gold-pale);
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
      padding: 14px 12px;
      text-align: left;
      border: none;
      white-space: nowrap;
    }

    td {
      padding: 11px 12px;
      border-bottom: 1px solid #ece3d1;
      font-size: 0.9rem;
      color: #4a4030;
    }

    tr:nth-child(even) td {
      background: #faf6ec;
    }

    tr:hover td {
      background: var(--gold-pale);
    }

    td img {
      border-radius: 8px;
      border: 1px solid var(--gold-soft);
      object-fit: cover;
    }
  </style>
</head>

<body>

  <div class="topbar">
    <p class="brand">Certificate <span>Management</span> System</p>
    <div style="display:flex; gap:12px;">
      <a href="admin.php" class="n">
        <button type="button" class="btn"><i class="fa fa-arrow-left"></i> Back</button>
      </a>
      <a href="logout.php" class="n">
        <button type="button" class="btn"><i class="fa fa-sign-out-alt"></i> Logout</button>
      </a>
    </div>
  </div>

  <div class="page-hero">
    <div class="eyebrow">Student Records</div>
    <h2>Student <span class="accent">Details</span></h2>
  </div>

  <div class="data-wrap">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by student name...">

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
          <th>Photo</th>
        </tr>
        <?php
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
            <td><?php echo "<a href='images/" . $rows['pic'] . "' data-lightbox='mygallery'><img src='images/" . $rows['pic'] . "' width='120' height='80'></a>"; ?></td>
          </tr>
        <?php
        }
        ?>
      </table>
    </div>
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
  </script>
</body>

</html>