<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <title>Faculty Analytics | Certificate Management System</title>
  <link rel="stylesheet" href="lightbox.min.css">
  <script src="lightbox-plus-jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript">
    google.charts.load('current', {
      packages: ['corechart']
    });
  </script>

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
      padding: 0 0 60px;
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

    .chart-grid {
      max-width: 1300px;
      margin: 30px auto 0;
      padding: 0 32px;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 26px;
    }

    .chart-card {
      background: var(--cream-card);
      border: 1px solid rgba(212, 175, 55, 0.25);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 22px;
    }

    .chart-card canvas {
      width: 100% !important;
      max-width: 100%;
    }

    @media only screen and (max-width: 900px) {
      .chart-grid {
        grid-template-columns: 1fr;
        padding: 0 18px;
      }
    }
  </style>
</head>

<body>
  <div class="topbar">
    <a href="admin.php" class="n"><button type="button" class="btn" id="btn2">Back</button></a>
    <a href="logout.php" class="n"><button type="button" class="btn" id="btn1">Logout</button></a>
  </div>


  <div class="page-hero">
    <div class="eyebrow">Faculty Records</div>
    <h2>Faculty <span class="accent">Analytics</span></h2>
  </div>

  <div class="chart-grid">
    <div class="chart-card"><canvas id="myChart"></canvas></div>
    <div class="chart-card"><canvas id="myChart1"></canvas></div>
    <div class="chart-card"><canvas id="myChart2"></canvas></div>
    <div class="chart-card"><canvas id="myChart3"></canvas></div>
    <div class="chart-card"><canvas id="myChart4"></canvas></div>
    <div class="chart-card"><canvas id="myChart5"></canvas></div>
    <div class="chart-card"><canvas id="myChart6"></canvas></div>
    <div class="chart-card"><canvas id="myChart7"></canvas></div>
    <div class="chart-card"><canvas id="myChart8"></canvas></div>
    <div class="chart-card"><canvas id="myChart9"></canvas></div>
    <div class="chart-card"><canvas id="myChart10"></canvas></div>
    <div class="chart-card"><canvas id="myChart11"></canvas></div>
  </div>

  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];
    console.log('xvalues:', xValues);
    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM fworkshop WHERE name='$value' and type='workshop'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    console.log("yvalues:", yValues);
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];
    new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Workshops Attended"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query1 = "SELECT * FROM faculty";
    $res1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
    $na1 = array();
    while ($data1 = mysqli_fetch_array($res1)) {
      $na1[] = $data1["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na1) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM fworkshop WHERE name='$value' and type='seminar'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart1", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Seminars Attended"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM fworkshop WHERE name='$value' and type='conference'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart2", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Conference Attended"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM ffworkshop WHERE name='$value' and type='workshop'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart3", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Workshops Organized"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM ffworkshop WHERE name='$value' and type='seminar'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart4", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Seminars Organized"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM ffworkshop WHERE name='$value' and type='conference'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart5", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Conference Organized"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM paperpublications WHERE name='$value'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart6", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Paper Publications"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM certificates WHERE name='$value'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart7", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Certificates"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM bookpublish WHERE name='$value'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart8", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Books Published"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM bookedited WHERE name='$value'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart9", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Books Edited"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM fdp WHERE name='$value'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart10", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "FDP"
        }
      }
    });
  </script>
  <script>
    <?php
    include('db_conn.php');
    $query = "SELECT * FROM faculty";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $na = array();
    while ($data = mysqli_fetch_array($res)) {
      $na[] = $data["name"];
    }
    ?>
    var xValues = [<?php echo '"' . implode('","', $na) . '"' ?>];

    <?php
    include('db_conn.php');
    $num = array();
    foreach ($na as $value) {

      $query = "SELECT * FROM others WHERE name='$value'";

      if ($results = mysqli_query($conn, $query)) {
        $rowcount = mysqli_num_rows($results);
        $num[] = $rowcount;
      }
    }
    ?>
    var yValues = [<?php echo '"' . implode('","', $num) . '"' ?>];
    var barColors = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b"];

    new Chart("myChart11", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          text: "Others"
        }
      }
    });
  </script>
</body>

</html>