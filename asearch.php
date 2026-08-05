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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

    html,
    body {
      max-width: 100%;
      overflow-x: hidden;
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
      width: 100% !important;
      max-width: 420px;
      margin-bottom: 20px;
    }

    #myInput,
    #myInput1,
    #myInput2,
    #myInput3,
    #myInput4,
    #myInput5 {
      background-color: var(--white);
      background-image: url('/css/searchicon.png');
      background-position: 12px 12px;
      background-repeat: no-repeat;
      width: 100% !important;
      max-width: 480px;
      font-size: 15px;
      padding: 11px 16px 11px 40px;
      border: 1px solid var(--border);
      border-radius: 8px;
      margin: 0 0 16px 0 !important;
    }

    .scroll {
      height: auto;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    #myTable,
    #myTable1,
    #myTable2,
    #myTable3,
    #myTable4,
    #myTable5 {
      border-collapse: collapse;
      width: 100%;
      min-width: 900px;
      background: var(--white);
      font-size: 14px;
      border-radius: 10px;
      overflow: hidden;
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
      padding: 10px 12px;
      border-bottom: 1px solid var(--border);
    }

    #myTable tr.header,
    #myTable1 tr.header,
    #myTable2 tr.header,
    #myTable3 tr.header,
    #myTable4 tr.header,
    #myTable5 tr.header {
      background: var(--bg-dark);
      color: var(--gold-light);
      font-weight: 600;
    }

    #myTable tr:hover,
    #myTable1 tr:hover,
    #myTable2 tr:hover,
    #myTable3 tr:hover,
    #myTable4 tr:hover,
    #myTable5 tr:hover {
      background-color: #faf6ea;
    }

    .n {
      text-decoration: none;
    }

    .container {
      width: 100%;
    }

    .optionDiv {
      display: none;
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
    <a href="admin.php" class="n"><button type="button" class="btn" id="btn1">Back</button></a>
    <a href="logout.php" class="n"><button type="button" class="btn" id="btn1">Logout</button></a>
  </div>

  <div class="panel">
    <select id='mySelect' onchange="myFun()" name='opt' required>
      <option value=''>Select the Option</option>
      <option value='workshop'>Workshops</option>
      <option value='internship'>Internships</option>
      <option value='project'>Projects</option>
      <option value='certificate'>Certificates</option>
      <option value='extracircular'>Extra Circulars</option>
      <option value='cocircular'>Co Circulars</option>
    </select>

    <div id='demo'>

      <!-- ================= WORKSHOP ================= -->
      <div id="workshopDiv" class="optionDiv">
        <h1>Workshop</h1>
        <input type='text' id='myInput' onkeyup='myFunction()' placeholder='search by Workshop Name..' title='Type in a name'>
        <!-- FIX: was <div class='container'>, changed to 'scroll' so it matches every other section -->
        <div class='scroll'>
          <table id='myTable'>
            <tr class='header'>
              <th>Roll No</th>
              <th>Name</th>
              <th>Workshop Name</th>
              <th>Organisation</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>place</th>
              <th>file</th>
              <th>Branch</th>
              <th>Year</th>
              <th>Counsular</th>
              <th>Class Teacher</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM sworkshop";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
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
                  <?php
                  $ext = pathinfo('images/' . $rows['file'], PATHINFO_EXTENSION);
                  if ($ext == 'pdf') {
                    echo "<embed src='images/" . $rows['file'] . "' type='application/pdf' frameBorder='0' scrolling='auto' height='100' width='200'></embed>";
                  } else {
                    echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery'><img src='images/" . $rows['file'] . "' width='200' height='100'></a>";
                  }
                  ?>
                </td>
                <td><?php echo $rows['branch']; ?></td>
                <td><?php echo $rows['year']; ?></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ================= INTERNSHIP ================= -->
      <div id="internshipDiv" class="optionDiv">
        <h1>Internship</h1>
        <input type='text' id='myInput1' onkeyup='myFunction1()' placeholder='search by Internship Name..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable1'>
            <tr class='header'>
              <th style='width:60%;'>Roll No</th>
              <th style='width:60%;'>Name</th>
              <th style='width:30%;'>Company Name</th>
              <th style='width:20%;'>Branch</th>
              <th style='width:20%;'>Year</th>
              <th style='width:20%;'>Start Date</th>
              <th style='width:20%;'>End Date</th>
              <th style='width:20%;'>Duration</th>
              <th style='width:20%;'>Amount</th>
              <th style='width:20%;'>Paid</th>
              <th style='width:20%;'>Tech/Non-Tech</th>
              <th style='width:20%;'>File</th>
              <th style='width:20%;'>Counsular</th>
              <th style='width:20%;'>Class Teacher</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM sinternship";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
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
                <td><?php echo "<a href='images/" . $rows['pic'] . "' data-lightbox='mygallery'><img src='images/" . $rows['pic'] . "' width='200' height='100'></a>"; ?></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><?php echo "<a href='images/" . $rows['pic'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ================= PROJECT ================= -->
      <div id="projectDiv" class="optionDiv">
        <h1>Project</h1>
        <input type='text' id='myInput2' onkeyup='myFunction2()' placeholder='search by Project Name..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable2'>
            <tr class='header'>
              <th style='width:8%;'>Roll Number</th>
              <th style='width:8%;'>Team Number</th>
              <th style='width:12%;'>Name</th>
              <th style='width:32%;'>Project Title</th>
              <th style='width:8%;'>Year</th>
              <th style='width:8%;'>Drive Link</th>
              <th style='width:8%;'>Branch</th>
              <th style='width:8%;'>Counsular</th>
              <th style='width:8%;'>Class Teacher</th>
            </tr>
            <?php
            $query = "SELECT * FROM sproject";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['Roll_Number']; ?></td>
                <td><?php echo $rows['Team_Number']; ?></td>
                <td><?php echo $rows['Name']; ?></td>
                <td><?php echo $rows['Project_title']; ?></td>
                <td><?php echo $rows['academicyear']; ?></td>
                <td><?php echo "<a href='" . $rows['Drive_link'] . "' target='_blank'>Drive link</a>"; ?></td>
                <td><?php echo $rows['branch']; ?></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <div id="certificateDiv" class="optionDiv">
        <h1>Certificates</h1>
        <input type='text' id='myInput3' onkeyup='myFunction3()' placeholder='search for Name of Certificate..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable3'>
            <tr class='header'>
              <th style='width:60%;'>Roll NO</th>
              <th style='width:60%;'>Name</th>
              <th style='width:30%;'>Course Name</th>
              <th style='width:20%;'>Oraganisation</th>
              <th style='width:20%;'>Start Date</th>
              <th style='width:20%;'>End Date</th>
              <th style='width:20%;'>Duration</th>
              <th style='width:20%;'>year</th>
              <th style='width:20%;'>File</th>
              <th style='width:20%;'>Branch</th>
              <th style='width:20%;'>Counsular</th>
              <th style='width:20%;'>Class Teacher</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM course";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['RollNo']; ?></td>
                <td><?php echo $rows['Name']; ?></td>
                <td><?php echo $rows['CourseName']; ?></td>
                <td><?php echo $rows['OrganisationName']; ?></td>
                <td><?php echo $rows['StartDate']; ?></td>
                <td><?php echo $rows['Enddate']; ?></td>
                <td><?php echo $rows['Duration']; ?></td>
                <td><?php echo $rows['academicyear']; ?></td>
                <td><?php echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery'><img src='images/" . $rows['file'] . "' width='200' height='100'></a>"; ?></td>
                <td><?php echo $rows['branch']; ?></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <div id="extracircularDiv" class="optionDiv">
        <h1>Extra Circular</h1>
        <input type='text' id='myInput4' onkeyup='myFunction4()' placeholder='search for Name of Event..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable4'>
            <tr class='header'>
              <th style='width:60%;'>Roll No</th>
              <th style='width:60%;'>Name</th>
              <th style='width:30%;'>Year</th>
              <th style='width:20%;'>Branch</th>
              <th style='width:20%;'>Event Name</th>
              <th style='width:20%;'>Conducting College</th>
              <th style='width:20%;'>Organisation Name</th>
              <th style='width:20%;'>Dates</th>
              <th style='width:20%;'>Internal/External</th>
              <th style='width:20%;'>Academic year</th>
              <th style='width:20%;'>File</th>
              <th style='width:20%;'>Counsular</th>
              <th style='width:20%;'>Class Teacher</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM extracircular";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery'><img src='images/" . $rows['file'] . "' width='200' height='100'></a>"; ?></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <div id="cocircularDiv" class="optionDiv">
        <h1>Co Circular</h1>
        <input type='text' id='myInput5' onkeyup='myFunction5()' placeholder='search for Name of Event..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable5'>
            <tr class='header'>
              <th style='width:60%;'>Roll No</th>
              <th style='width:60%;'>Name</th>
              <th style='width:30%;'>Year</th>
              <th style='width:20%;'>Branch</th>
              <th style='width:20%;'>Event Name</th>
              <th style='width:20%;'>Conducting College</th>
              <th style='width:20%;'>Organisation Name</th>
              <th style='width:20%;'>Dates</th>
              <th style='width:20%;'>Internal/External</th>
              <th style='width:20%;'>Academic year</th>
              <th style='width:20%;'>File</th>
              <th style='width:20%;'>Counsular</th>
              <th style='width:20%;'>Class Teacher</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM cocircular";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery'><img src='images/" . $rows['file'] . "' width='200' height='100'></a>"; ?></td>
                <td><?php echo $rows['counsular']; ?></td>
                <td><?php echo $rows['classteacher']; ?></td>
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

    </div>
  </div>
  <br>

  <script type="text/javascript">
    function myFun() {
      var sections = document.getElementsByClassName('optionDiv');
      for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = 'none';
      }
      var val = document.getElementById("mySelect").value;
      if (val) {
        var target = document.getElementById(val + "Div");
        if (target) {
          target.style.display = 'block';
        }
      }
    }
  </script>

  <script src="mainl.js"></script>
  <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput1");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable1");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

    function myFunction2() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput2");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable2");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
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

    function myFunction3() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput3");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable3");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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

    function myFunction4() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput4");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable4");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4];
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

    function myFunction5() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput5");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable5");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4];
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

    function my() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("year");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[11];
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

    function my1() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("branch");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[10];
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