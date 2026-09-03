<?php
include "db_conn.php";
session_start();

$tables = [
    'fdp'                     => ['label' => 'FDP Attended',                 'icon' => 'fa-chalkboard-teacher'],
    'fdporg'                  => ['label' => 'FDP Organized',                'icon' => 'fa-chalkboard'],
    'ffworkshop'               => ['label' => 'Workshops / Seminars',         'icon' => 'fa-users'],
    'paperpublications'       => ['label' => 'Paper Publications',           'icon' => 'fa-file-alt'],
    'conferences'             => ['label' => 'Conference Papers',            'icon' => 'fa-microphone'],
    'certificates'            => ['label' => 'Certificates',                 'icon' => 'fa-certificate'],
    'bookpublish'             => ['label' => 'Book Chapters Published',      'icon' => 'fa-book-open'],
    'bookedited'              => ['label' => 'Book Chapters Edited',         'icon' => 'fa-book'],
    'textbook'                => ['label' => 'Textbooks Published',         'icon' => 'fa-book-reader'],
    'patents'                 => ['label' => 'Patents',                     'icon' => 'fa-lightbulb'],
    'nptel'                   => ['label' => 'NPTEL Courses',                'icon' => 'fa-graduation-cap'],
    'achievements'            => ['label' => 'Achievements',                 'icon' => 'fa-trophy'],
    'outside_participations'  => ['label' => 'Outside Participations',       'icon' => 'fa-handshake'],
    'reviewer_activities'     => ['label' => 'Reviewer Activities',          'icon' => 'fa-clipboard-check'],
    'professional_membership' => ['label' => 'Professional Memberships',     'icon' => 'fa-id-badge'],
    'phd_details'             => ['label' => 'PhD Details',                  'icon' => 'fa-user-graduate'],
    'consultancy_work'        => ['label' => 'Consultancy Work',             'icon' => 'fa-briefcase'],
    'working_models'          => ['label' => 'Working Models / Projects',    'icon' => 'fa-cogs'],
    'funding_projects'        => ['label' => 'Funding Projects',             'icon' => 'fa-hand-holding-usd'],
];

$counts = [];
$grandTotal = 0;

foreach ($tables as $tableName => $cfg) {
    // $tableName only ever comes from the array above — never from user input.
    $q = "SELECT COUNT(*) AS cnt FROM `$tableName`";
    $res = mysqli_query($conn, $q);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $counts[$tableName] = (int) $row['cnt'];
    } else {
        $counts[$tableName] = null; // table missing / query failed
    }
    if ($counts[$tableName] !== null) {
        $grandTotal += $counts[$tableName];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="icon2.png">
    <title>Consolidated Faculty Report | CERTIFICATE MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700|Playfair+Display:700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --dark: #191310;
            --dark2: #241a14;
            --gold: #d4af6a;
            --gold-deep: #c9982f;
            --cream: #f7f1e6;
            --cream-soft: #f2e9d8;
            --rust: #b5502e;
            --text-light: #f3ece0;
            --text-muted: #cfc4b4;
            --radius: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: #2b2420;
            overflow-x: hidden;
            padding-bottom: 60px;
        }

        a.n {
            text-decoration: none;
        }

        /* ===== Top bar ===== */
        .topbar {
            background: linear-gradient(180deg, var(--dark) 0%, var(--dark2) 100%);
            padding: 22px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            border-bottom: 1px solid rgba(212, 175, 106, 0.25);
        }

        .brand h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--text-light);
            letter-spacing: 0.5px;
        }

        .brand h1 span {
            color: var(--gold);
        }

        .topbar-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .pill-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: 30px;
            border: 1px solid var(--gold);
            background: transparent;
            color: var(--gold);
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
            cursor: pointer;
            transition: all .35s ease;
            white-space: nowrap;
        }

        .pill-btn:hover {
            background: var(--gold);
            color: var(--dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(212, 175, 106, 0.35);
        }

        .pill-btn.solid {
            background: var(--gold);
            color: var(--dark);
            border: 1px solid var(--gold);
        }

        .pill-btn.solid:hover {
            background: var(--gold-deep);
            border-color: var(--gold-deep);
        }

        /* ===== Hero strip ===== */
        .hero-strip {
            background: linear-gradient(180deg, var(--dark2) 0%, var(--dark) 100%);
            padding: 30px 5% 70px;
            text-align: center;
            position: relative;
        }

        .hero-strip .tag {
            color: var(--text-muted);
            letter-spacing: 3px;
            font-size: 0.8rem;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .hero-strip h2 {
            font-family: 'Playfair Display', serif;
            color: var(--text-light);
            font-size: 2.1rem;
            font-weight: 700;
        }

        .hero-strip h2 span {
            color: var(--gold);
        }

        /* ===== Grand total card ===== */
        .total-wrapper {
            display: flex;
            justify-content: center;
            margin-top: -55px;
            padding: 0 5%;
            position: relative;
            z-index: 2;
        }

        .total-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 26px 46px;
            text-align: center;
            box-shadow: 0 18px 34px rgba(25, 19, 16, 0.18);
        }

        .total-card .icon-circle {
            width: 66px;
            height: 66px;
            border-radius: 50%;
            background: var(--cream-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 26px;
            color: var(--rust);
        }

        .total-card h3 {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #7a6f62;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .total-card .count {
            font-family: 'Playfair Display', serif;
            font-size: 2.3rem;
            color: var(--dark);
            font-weight: 700;
        }

        /* ===== Report grid ===== */
        .report-section {
            padding: 60px 6% 0;
        }

        .report-section .section-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-bottom: 30px;
            color: var(--dark);
        }

        .report-section .section-title span {
            color: var(--rust);
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
            max-width: 1300px;
            margin: 0 auto;
        }

        .report-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 24px 26px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 12px 26px rgba(25, 19, 16, 0.10);
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .report-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 34px rgba(25, 19, 16, 0.16);
        }

        .report-card .icon-badge {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: var(--cream-soft);
            color: var(--rust);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .report-card .info h4 {
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #7a6f62;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .report-card .info .count {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark);
        }

        .report-card .info .count.na {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--rust);
        }

        @media only screen and (max-width: 560px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .total-card {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="topbar">
        <div class="brand">
            <h1>Certificate <span>Management</span> System</h1>
        </div>
        <div class="topbar-actions">
            <a href="admin.php" class="n">
                <button type="button" class="pill-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</button>
            </a>
            <a href="logout.php" class="n">
                <button type="button" class="pill-btn solid"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </a>
        </div>
    </div>

    <div class="hero-strip">
        <div class="tag">Admin Dashboard</div>
        <h2>Consolidated <span>Faculty Report</span></h2>
    </div>

    <div class="total-wrapper">
        <div class="total-card">
            <div class="icon-circle"><i class="fas fa-layer-group"></i></div>
            <h3>Total Records Across All Types</h3>
            <div class="count"><?php echo $grandTotal; ?></div>
        </div>
    </div>

    <div class="report-section">
        <div class="section-title">Records by <span>Category</span></div>
        <div class="report-grid">
            <?php foreach ($tables as $tableName => $cfg): ?>
                <div class="report-card">
                    <div class="icon-badge"><i class="fas <?php echo htmlspecialchars($cfg['icon']); ?>"></i></div>
                    <div class="info">
                        <h4><?php echo htmlspecialchars($cfg['label']); ?></h4>
                        <?php if ($counts[$tableName] === null): ?>
                            <div class="count na">Table not found</div>
                        <?php else: ?>
                            <div class="count"><?php echo $counts[$tableName]; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>