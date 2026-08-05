<?php
include('db_conn.php');

/*
 * Same 19 categories used on analysis.php, keyed by faculty_id (not name).
 * One grouped COUNT query per category instead of one query per faculty
 * per category — this is O(19) queries total instead of O(19 * faculty_count).
 */
$categories = array(
  'fdp'                      => 'FDP Attended',
  'fdporg'                   => 'FDP Organized',
  'ffworkshop'               => 'Workshops Attended',
  'paperpublications'        => 'Paper Publications',
  'conferences'              => 'Conferences',
  'certificates'             => 'Certificates',
  'bookpublish'              => 'Books Published',
  'bookedited'               => 'Books Edited',
  'textbook'                 => 'Text Books',
  'patents'                  => 'Patents',
  'nptel'                    => 'NPTEL',
  'achievements'             => 'Achievements',
  'outside_participations'   => 'Outside Participation',
  'reviewer_activities'      => 'Reviewer Activities',
  'professional_membership'  => 'Professional Membership',
  'phd_details'              => 'PHD',
  'consultancy_work'         => 'Consultancy Work',
  'working_models'           => 'Working Models',
  'funding_projects'         => 'Funding Projects',
);

// Faculty list, kept in a fixed order so every chart uses the same x-axis labels.
$facultyOrder = array();
$facultyNames = array();
$fres = mysqli_query($conn, "SELECT id, name FROM faculty ORDER BY name") or die(mysqli_error($conn));
while ($frow = mysqli_fetch_assoc($fres)) {
  $facultyOrder[] = $frow['id'];
  $facultyNames[$frow['id']] = $frow['name'];
}

$chartData = array();
foreach ($categories as $table => $label) {
  $counts = array_fill_keys($facultyOrder, 0);
  $cres = mysqli_query($conn, "SELECT faculty_id, COUNT(*) AS c FROM `$table` GROUP BY faculty_id");
  if ($cres) {
    while ($crow = mysqli_fetch_assoc($cres)) {
      $fid = $crow['faculty_id'];
      if (array_key_exists($fid, $counts)) {
        $counts[$fid] = (int) $crow['c'];
      }
    }
  }
  $chartData[] = array(
    'label'  => $label,
    'values' => array_values($counts),
  );
}

$labels = array();
foreach ($facultyOrder as $fid) {
  $labels[] = $facultyNames[$fid];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <title>Faculty Analytics | Certificate Management System</title>
  <link rel="stylesheet" href="lightbox.min.css">
  <script src="lightbox-plus-jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
      position: relative;
      overflow: hidden;
    }

    .chart-card .chart-inner {
      position: relative;
      width: 100%;
    }

    .chart-card canvas {
      width: 100% !important;
      height: 100% !important;
    }

    .empty-note {
      text-align: center;
      color: var(--rust);
      font-weight: 600;
      padding: 40px;
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
    <a href="analysis.php" class="n"><button type="button" class="btn" id="btn2">Back</button></a>
    <a href="logout.php" class="n"><button type="button" class="btn" id="btn1">Logout</button></a>
  </div>

  <div class="page-hero">
    <div class="eyebrow">Faculty Records</div>
    <h2>Faculty <span class="accent">Analytics</span></h2>
  </div>

  <?php if (empty($facultyOrder)): ?>
    <p class="empty-note">No faculty records found.</p>
  <?php else: ?>
    <div class="chart-grid" id="chartGrid"></div>
  <?php endif; ?>

  <script>
    const facultyLabels = <?php echo json_encode($labels, JSON_UNESCAPED_UNICODE); ?>;
    const chartData = <?php echo json_encode($chartData, JSON_UNESCAPED_UNICODE); ?>;

    const palette = ["#d4af37", "#b5502e", "#2b1d13", "#c9a227", "#8a6d3b", "#7c9070", "#5b7c99", "#9c5b8f"];
    const barColors = facultyLabels.map((_, i) => palette[i % palette.length]);

    const grid = document.getElementById('chartGrid');

    const rowHeight = 30; 
    const chartPadding = 70;
    const cardHeight = Math.max(320, facultyLabels.length * rowHeight + chartPadding);

    chartData.forEach(function(cat, idx) {
      const card = document.createElement('div');
      card.className = 'chart-card';
      card.style.height = cardHeight + 'px';

      const inner = document.createElement('div');
      inner.className = 'chart-inner';
      inner.style.height = cardHeight - 44 + 'px';

      const canvas = document.createElement('canvas');
      canvas.id = 'chart_' + idx;
      inner.appendChild(canvas);
      card.appendChild(inner);
      grid.appendChild(card);

      new Chart(canvas.getContext('2d'), {
        type: 'horizontalBar',
        data: {
          labels: facultyLabels,
          datasets: [{
            backgroundColor: barColors,
            data: cat.values
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          title: {
            display: true,
            text: cat.label
          },
          scales: {
            xAxes: [{
              ticks: {
                beginAtZero: true,
                stepSize: 1,
                precision: 0
              }
            }],
            yAxes: [{
              ticks: {
                autoSkip: false
              }
            }]
          }
        }
      });
    });
  </script>
</body>

</html>