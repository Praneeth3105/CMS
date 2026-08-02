<?php
include_once('db_conn.php');
// session_start();
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
      --muted: #7a7166;
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
      color: var(--ink);
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
    #myInputs,
    #myInputc,
    #myInput6,
    #myInputso,
    #myInputco,
    #myInputo,
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

    #myTable,
    #myTable1,
    #myTable2,
    #myTable3,
    #myTable6,
    #myTables,
    #myTablec,
    #myTableo,
    #myTableso,
    #myTableco,
    #myTable4,
    #myTable5 {
      border-collapse: collapse;
      width: 100%;
      background: var(--white);
      font-size: 14.5px;
      border-radius: 10px;
      overflow: hidden;
      margin: 0 !important;
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
    #myTable5 td,
    #myTable6 th,
    #myTable6 td,
    #myTables th,
    #myTables td,
    #myTablec th,
    #myTablec td,
    #myTableo th,
    #myTableo td,
    #myTableso th,
    #myTableso td,
    #myTableco th,
    #myTableco td {
      text-align: left;
      padding: 12px 14px;
      border-bottom: 1px solid var(--border);
    }

    #myTable tr.header,
    #myTable1 tr.header,
    #myTable2 tr.header,
    #myTable3 tr.header,
    #myTable4 tr.header,
    #myTable5 tr.header,
    #myTable6 tr.header,
    #myTables tr.header,
    #myTablec tr.header,
    #myTableo tr.header,
    #myTableso tr.header,
    #myTableco tr.header {
      background: var(--bg-dark);
      color: var(--gold-light);
      font-weight: 600;
    }

    #myTable tr:hover,
    #myTable1 tr:hover,
    #myTable2 tr:hover,
    #myTable3 tr:hover,
    #myTable4 tr:hover,
    #myTable5 tr:hover,
    #myTable6 tr:hover,
    #myTables tr:hover,
    #myTablec tr:hover,
    #myTableo tr:hover,
    #myTableso tr:hover,
    #myTableco tr:hover {
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

    .optionDiv {
      display: none;
    }

    @media only screen and (max-width: 900px) {
      .wave {
        display: none;
      }

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
    <a href="admin.php" class="n"><button type="button" class="btn">Back</button></a>
    <a href="logout.php" class="n"><button type="button" class="btn">Logout</button></a>
  </div>

  <div class="panel">
    <select class='btn' id="mySelect" onchange="myFun()" name='opt' required>
      <option value=''>Select the Option</option>
      <option value='workshopattended'>Workshops Attended</option>
      <option value='seminarattended'>Seminars Attended</option>
      <option value='conferenceattended'>Conference Attended</option>
      <option value='workshoporganized'>Workshops Organized</option>
      <option value='seminarorganized'>Seminars Organized</option>
      <option value='conferenceorganized'>Conference Organized</option>
      <option value='certificate'>Certificates</option>
      <option value='fdp'>FDP</option>
      <option value='paperpublication'>Paper Publication</option>
      <option value='bookpublished'>Book Published</option>
      <option value='bookedited'>Book Edited</option>
      <option value='others'>Others</option>
    </select>

    <div id="demo">

      <!-- ============ WORKSHOPS ATTENDED -> ffworkshop ============ -->
      <div id="workshopattendedDiv" class="optionDiv">
        <h1>Workshops Attended</h1>
        <input type='text' id='myInput' onkeyup='myFunction()' placeholder='search by Workshop Name..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable'>
            <tr class='header'>
              <th>Name</th>
              <th>Department</th>
              <th>Title</th>
              <th>Workshop Name</th>
              <th>Organisation</th>
              <th>Place</th>
              <th>Type</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>File</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM ffworkshop where type='Workshop'";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['department']; ?></td>
                <td><?php echo $rows['title']; ?></td>
                <td><?php echo $rows['workshopn']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['place']; ?></td>
                <td><?php echo $rows['type']; ?></td>
                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ============ SEMINARS ATTENDED -> no table yet ============ -->
      <div id="seminarattendedDiv" class="optionDiv">
        <h1>Seminars Attended</h1>

        <input type='text' id='myInput5'
          onkeyup='myFunction5()'
          placeholder='search by Seminar Name..'>

        <div class='scroll'>
          <table id='myTable5'>
            <tr class='header'>
              <th>Name</th>
              <th>Department</th>

              <th>Seminar Name</th>
              <th>Organisation</th>
              <th>Place</th>

              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>File</th>
              <th>Download</th>
            </tr>

            <?php
            $query = "SELECT * FROM fworkshop where type='Seminar'";
            $result = mysqli_query($conn, $query);

            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['department']; ?></td>

                <td><?php echo $rows['workshopn']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['place']; ?></td>

                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>

                <td>
                  <?php
                  $ext = pathinfo('images/' . $rows['file'], PATHINFO_EXTENSION);

                  if ($ext == 'pdf') {
                    echo "<embed src='images/" . $rows['file'] . "' height='100' width='200'>";
                  } else {
                    echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery'>
<img src='images/" . $rows['file'] . "' width='200' height='100'>
</a>";
                  }
                  ?>
                </td>

                <td>
                  <a href='images/<?php echo $rows["file"]; ?>' download>
                    <button class='btn'>
                      <i class='fa'>&#xf019;</i>
                    </button>
                  </a>
                </td>
              </tr>

            <?php } ?>

          </table>
        </div>
      </div>

      <!-- ============ CONFERENCE ATTENDED -> no table yet ============ -->
      <div id="conferenceattendedDiv" class="optionDiv">
        <h1>Conference Attended</h1>
        <input type='text' id='myInput1' onkeyup='myFunction1()' placeholder='search by Workshop Name..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable1'>
            <tr class='header'>
              <th>Name</th>
              <th>Department</th>
              <th>Workshop Name</th>
              <th>Organisation</th>
              <th>Place</th>
              <th>Type</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>File</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM fworkshop where type='Conference'";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['department']; ?></td>
                <td><?php echo $rows['workshopn']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['place']; ?></td>
                <td><?php echo $rows['type']; ?></td>
                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ============ WORKSHOPS ORGANIZED -> fworkshop ============ -->
      <div id="workshoporganizedDiv" class="optionDiv">
        <h1>Workshops Organized</h1>
        <input type='text' id='myInput1' onkeyup='myFunction1()' placeholder='search by Workshop Name..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable1'>
            <tr class='header'>
              <th>Name</th>
              <th>Department</th>
              <th>Workshop Name</th>
              <th>Organisation</th>
              <th>Place</th>
              <th>Type</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>File</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM fworkshop where type='Workshop'";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['department']; ?></td>
                <td><?php echo $rows['workshopn']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['place']; ?></td>
                <td><?php echo $rows['type']; ?></td>
                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ============ SEMINARS ORGANIZED -> no table yet ============ -->
      <div id="seminarorganizedDiv" class="optionDiv">
        <h1>Seminars Organized</h1>

        <input type='text' id='myInput5'
          onkeyup='myFunction5()'
          placeholder='search by Seminar Name..'>

        <div class='scroll'>
          <table id='myTable5'>
            <tr class='header'>
              <th>Name</th>
              <th>Department</th>

              <th>Seminar Name</th>
              <th>Organisation</th>
              <th>Place</th>

              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>File</th>
              <th>Download</th>
            </tr>

            <?php
            $query = "SELECT * FROM ffworkshop where type='Seminar'";
            $result = mysqli_query($conn, $query);

            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['department']; ?></td>

                <td><?php echo $rows['workshopn']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['place']; ?></td>

                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>

                <td>
                  <?php
                  $ext = pathinfo('images/' . $rows['file'], PATHINFO_EXTENSION);

                  if ($ext == 'pdf') {
                    echo "<embed src='images/" . $rows['file'] . "' height='100' width='200'>";
                  } else {
                    echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery'>
<img src='images/" . $rows['file'] . "' width='200' height='100'>
</a>";
                  }
                  ?>
                </td>

                <td>
                  <a href='images/<?php echo $rows["file"]; ?>' download>
                    <button class='btn'>
                      <i class='fa'>&#xf019;</i>
                    </button>
                  </a>
                </td>
              </tr>

            <?php } ?>

          </table>
        </div>
      </div>

      <!-- ============ CONFERENCE ORGANIZED -> no table yet ============ -->
      <div id="conferenceorganizedDiv" class="optionDiv">
        <h1>Conference Organized</h1>
        <input type='text' id='myInput1' onkeyup='myFunction1()' placeholder='search by Workshop Name..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable1'>
            <tr class='header'>
              <th>Name</th>
              <th>Department</th>
              <th>Workshop Name</th>
              <th>Organisation</th>
              <th>Place</th>
              <th>Type</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>File</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM ffworkshop WHERE type='Conference'";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['department']; ?></td>
                <td><?php echo $rows['workshopn']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['place']; ?></td>
                <td><?php echo $rows['type']; ?></td>
                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ============ CERTIFICATES -> certificates ============ -->
      <div id="certificateDiv" class="optionDiv">
        <h1>Certificates</h1>
        <input type='text' id='myInput2' onkeyup='myFunction2()' placeholder='search by Name..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable2'>
            <tr class='header'>
              <th>Name</th>
              <th>Department</th>
              <th>Event</th>
              <th>Organisation</th>
              <th>Place</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>File</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM certificates";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['department']; ?></td>
                <td><?php echo $rows['event']; ?></td>
                <td><?php echo $rows['org']; ?></td>
                <td><?php echo $rows['place']; ?></td>
                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ============ FDP -> fdp ============ -->
      <div id="fdpDiv" class="optionDiv">

        <h1>FDP Details</h1>

        <input type="text" id="myInput3"
          onkeyup="myFunction3()"
          placeholder="Search by FDP Name..."
          title="Type in FDP Name">

        <div class="scroll">

          <table id="myTable3">

            <tr class="header">
              <th>Name</th>
              <th>Department</th>
              <th>FDP Name</th>
              <th>Organisation</th>
              <th>Mode</th>
              <th>Duration</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>View</th>

            </tr>

            <?php

            $query = "SELECT * FROM fdp ORDER BY startdate DESC";

            $result = mysqli_query($conn, $query);

            while ($rows = mysqli_fetch_assoc($result)) {

            ?>

              <tr>

                <td><?php echo htmlspecialchars($rows['name']); ?></td>

                <td><?php echo htmlspecialchars($rows['department']); ?></td>

                <td><?php echo htmlspecialchars($rows['fdpname']); ?></td>

                <td><?php echo htmlspecialchars($rows['org']); ?></td>

                <td><?php echo htmlspecialchars($rows['mode']); ?></td>

                <td><?php echo htmlspecialchars($rows['duration']); ?></td>

                <td><?php echo $rows['startdate']; ?></td>

                <td>
                  <?php
                  if ($rows['enddate'] == "0000-00-00" || empty($rows['enddate']))
                    echo "-";
                  else
                    echo $rows['enddate'];
                  ?>
                </td>

                <!-- View Button -->
                <td align="center">

                  <?php
                  if (!empty($rows['certificate_link'])) {
                  ?>

                    <a href="<?php echo $rows['certificate_link']; ?>" target="_blank">
                      <button class="btn">View</button>
                    </a>

                  <?php
                  } else {
                    echo "No Certificate";
                  }
                  ?>

                </td>

                </td>

              </tr>

            <?php

            }

            ?>

          </table>

        </div>

      </div>
      <!-- ============ PAPER PUBLICATION -> paperpublications ============ -->
      <div id="paperpublicationDiv" class="optionDiv">
        <h1>Paper Publication</h1>
        <input type='text' id='myInputs' onkeyup='myFunctions()' placeholder='search by Title..' title='Type in a title'>
        <div class='scroll'>
          <table id='myTables'>
            <tr class='header'>
              <th>Name</th>
              <th>Title</th>
              <th>Journal</th>
              <th>Authorship Position</th>
              <th>Type</th>
              <th>Date</th>
              <th>URL</th>
              <th>ISSN</th>
              <th>Issue</th>
              <th>Volume</th>
              <th>File</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM paperpublications";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['title']; ?></td>
                <td><?php echo $rows['journal']; ?></td>
                <td><?php echo $rows['authorship_position']; ?></td>
                <td><?php echo $rows['type']; ?></td>
                <td><?php echo $rows['date']; ?></td>
                <td><?php echo "<a href='" . $rows['url'] . "' target='_blank'>Link</a>"; ?></td>
                <td><?php echo $rows['issn']; ?></td>
                <td><?php echo $rows['issue']; ?></td>
                <td><?php echo $rows['volume']; ?></td>
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ============ BOOK PUBLISHED -> bookpublish ============ -->
      <div id="bookpublishedDiv" class="optionDiv">
        <h1>Book Published</h1>
        <input type='text' id='myInputc' onkeyup='myFunctionc()' placeholder='search by Title..' title='Type in a title'>
        <div class='scroll'>
          <table id='myTablec'>
            <tr class='header'>
              <th>Name</th>
              <th>Title</th>
              <th>Journal</th>
              <th>Publication Type</th>
              <th>Authorship Position</th>
              <th>Type</th>
              <th>Date</th>
              <th>URL</th>
              <th>ISSN</th>
              <th>Issue</th>
              <th>Volume</th>
              <th>File</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM bookpublish";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['title']; ?></td>
                <td><?php echo $rows['journal']; ?></td>
                <td><?php echo $rows['publication_type']; ?></td>
                <td><?php echo $rows['authorship_position']; ?></td>
                <td><?php echo $rows['type']; ?></td>
                <td><?php echo $rows['date']; ?></td>
                <td><?php echo "<a href='" . $rows['url'] . "' target='_blank'>Link</a>"; ?></td>
                <td><?php echo $rows['issn']; ?></td>
                <td><?php echo $rows['issue']; ?></td>
                <td><?php echo $rows['volume']; ?></td>
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ============ BOOK EDITED -> bookedited ============ -->
      <div id="bookeditedDiv" class="optionDiv">
        <h1>Book Edited</h1>
        <input type='text' id='myInputo' onkeyup='myFunctiono()' placeholder='search by Title..' title='Type in a title'>
        <div class='scroll'>
          <table id='myTableo'>
            <tr class='header'>
              <th>Name</th>
              <th>Title</th>
              <th>Journal</th>
              <th>Publication Type</th>
              <th>Authorship Position</th>
              <th>Type</th>
              <th>Date</th>
              <th>URL</th>
              <th>ISSN</th>
              <th>Issue</th>
              <th>Volume</th>
              <th>File</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM bookedited";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['title']; ?></td>
                <td><?php echo $rows['journal']; ?></td>
                <td><?php echo $rows['publication_type']; ?></td>
                <td><?php echo $rows['authorship_position']; ?></td>
                <td><?php echo $rows['type']; ?></td>
                <td><?php echo $rows['date']; ?></td>
                <td><?php echo "<a href='" . $rows['url'] . "' target='_blank'>Link</a>"; ?></td>
                <td><?php echo $rows['issn']; ?></td>
                <td><?php echo $rows['issue']; ?></td>
                <td><?php echo $rows['volume']; ?></td>
                <td>
                  <?php
                  // NOTE: this table's file column is named 'fiie' (likely a typo for 'file' in the DB itself)
                  $ext = pathinfo('images/' . $rows['file'], PATHINFO_EXTENSION);
                  if ($ext == 'pdf') {
                    echo "<embed src='images/" . $rows['file'] . "' type='application/pdf' frameBorder='0' scrolling='auto' height='100' width='200'></embed>";
                  } else {
                    echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery'><img src='images/" . $rows['file'] . "' width='200' height='100'></a>";
                  }
                  ?>
                </td>
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

      <!-- ============ OTHERS -> others ============ -->
      <div id="othersDiv" class="optionDiv">
        <h1>Others</h1>
        <input type='text' id='myInput4' onkeyup='myFunction4()' placeholder='search by Course Name..' title='Type in a name'>
        <div class='scroll'>
          <table id='myTable4'>
            <tr class='header'>
              <th>Roll No</th>
              <th>Name</th>
              <th>Course Name</th>
              <th>Offered By</th>
              <th>Place</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Duration</th>
              <th>File</th>
              <th>Download</th>
            </tr>
            <?php
            $query = "SELECT * FROM others";
            $result = mysqli_query($conn, $query);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $rows['rollno']; ?></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['cname']; ?></td>
                <td><?php echo $rows['ooffered']; ?></td>
                <td><?php echo $rows['place']; ?></td>
                <td><?php echo $rows['startdate']; ?></td>
                <td><?php echo $rows['enddate']; ?></td>
                <td><?php echo $rows['duration']; ?></td>
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
                <td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:24px' class='fa'>&#xf019;</i></button></a>"; ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>

    </div>
  </div>
  <br>

  <script>
    // Shows only the section matching the dropdown's value (e.g. "fdp" -> "fdpDiv")
    function myFun() {
      var sections = document.getElementsByClassName('optionDiv');
      for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = 'none';
      }
      var inputElement = document.getElementById("mySelect");
      var outputElement = document.getElementById("demo");
      var val = inputElement.value;

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

    function myFunctions() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputs");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTables");
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

    function myFunctionc() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputc");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTablec");
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

    function myFunctiono() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputo");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTableo");
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

    function myFunctionso() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputso");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTableso");
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

    function myFunctionco() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInputco");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTableco");
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

    function myFunction4() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput4");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable4");
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

    function myFunction5() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput5");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable5");
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

    function myFunction6() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput6");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable6");
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
  </script>
</body>

</html>