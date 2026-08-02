<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="icon2.png">
    <title>CSV Data Uploads | Certificate Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
            --border: #e6ddc8;
            --radius: 20px;
            --radius-sm: 14px;
            --shadow: 0 10px 30px rgba(26, 18, 11, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--cream);
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            margin: 0;
            padding-bottom: 60px;
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
            box-shadow: var(--shadow);
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--cream);
            letter-spacing: 0.3px;
            margin: 0;
        }

        .brand span {
            color: var(--gold);
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
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 13.5px;
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

        /* ---------- Panels ---------- */
        .panel {
            background: var(--cream-card);
            margin: 28px 32px;
            padding: 45px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .panel h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin: 0 0 34px;
            color: var(--dark);
        }

        .panel h3 .accent {
            color: var(--gold-soft);
        }

        /* ---------- CSV card grid ---------- */
        .group {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }

        .student-group {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .csv-card {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            background: linear-gradient(135deg, var(--dark) 0%, #2b2219 100%);
            border: 1px solid var(--gold);
            border-radius: var(--radius-sm);
            padding: 14px 20px;
            min-height: 70px;
            transition: 0.35s;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .student-group .csv-card {
            width: 380px;
        }

        .csv-icon {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: rgba(212, 175, 55, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .csv-icon i {
            color: var(--gold-pale);
            font-size: 20px;
        }

        .csv-text {
            color: #cfc4b4;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.35;
        }

        .csv-card:hover {
            transform: translateY(-6px);
            background: linear-gradient(135deg, var(--gold-pale) 0%, var(--gold-soft) 100%);
        }

        .csv-card:hover .csv-text {
            color: var(--dark);
        }

        .csv-card:hover .csv-icon {
            background: rgba(23, 18, 14, 0.15);
        }

        .csv-card:hover .csv-icon i {
            color: var(--dark);
        }

        @media only screen and (max-width: 900px) {
            .panel {
                margin: 16px;
                padding: 22px;
            }

            .group {
                grid-template-columns: 1fr;
            }

            .student-group .csv-card {
                width: 100%;
            }

            .btn {
                width: 100%;
                margin: 6px 0;
                justify-content: center;
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
        <h3>Faculty <span class="accent">CSV Uploads</span></h3>
        <div class="group">

            <a href="csvfdp.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-folder"></i></div>
                <div class="csv-text">FDP Attended CSV Upload</div>
            </a>
            <a href="csvfdporg.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-microphone"></i></div>
                <div class="csv-text">FDP Organized CSV Upload</div>
            </a>


            <a href="csvfw.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="csv-text">Faculty Workshop CSV</div>
            </a>

            <a href="csvfpp.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-file-alt"></i></div>
                <div class="csv-text">Paper Publications CSV</div>
            </a>

            <a href="csvconferences.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-user-tie"></i></div>
                <div class="csv-text">Conferences CSV</div>
            </a>

            <a href="csvfc.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-award"></i></div>
                <div class="csv-text">Faculty Certificates CSV</div>
            </a>

            <a href="csvfbp.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-book"></i></div>
                <div class="csv-text">Books Published CSV</div>
            </a>

            <a href="csvfbe.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-book-open"></i></div>
                <div class="csv-text">Books Edited CSV</div>
            </a>

            <a href="csvtextbook.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-book-open-reader"></i></div>
                <div class="csv-text">Text Book CSV</div>
            </a>
            <a href="csvpatents.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-fingerprint"></i></div>
                <div class="csv-text">Patents CSV</div>
            </a>
            <a href="csvnptel.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-stamp"></i></div>
                <div class="csv-text">NPTEL CSV</div>
            </a>
            <a href="csvach.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-trophy"></i></div>
                <div class="csv-text">Achievements CSV</div>
            </a>
            <a href="csvop.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-ranking-star"></i></div>
                <div class="csv-text">Outside Participation CSV</div>
            </a>
            <a href="csvrew.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <div class="csv-text">Reviewer CSV</div>
            </a>

            <a href="csvpmemb.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-user-shield"></i></div>
                <div class="csv-text">Professional Memberships CSV</div>
            </a>

            <a href="csvphd.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-user-tie"></i></div>
                <div class="csv-text">PHD CSV</div>
            </a>

            <a href="csvcw.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-building"></i></div>
                <div class="csv-text">Consultancy Works CSV</div>
            </a>
            <a href="csvwm.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-hexagon-nodes-bolt"></i></div>
                <div class="csv-text">Working Model CSV</div>
            </a>

            <a href="csvfunprj.php" class="csv-card">
                <div class="csv-icon"><i class="fa-solid fa-person-circle-plus"></i></div>
                <div class="csv-text">Funding Projects CSV</div>
            </a>



        </div>
    </div>

    <div class="panel">
        <h3>Student <span class="accent">CSV Uploads</span></h3>
        <div class="student-group">

            <a href="csvsd.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-user-graduate"></i></div>
                <div class="csv-text">Student Details CSV</div>
            </a>

            <a href="csvsw.php" class="csv-card">
                <div class="csv-icon"><i class="fas fa-tools"></i></div>
                <div class="csv-text">Student Workshops CSV</div>
            </a>

        </div>
    </div>

</body>

</html>