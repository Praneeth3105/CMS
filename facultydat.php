<?php
session_start();
include "db_conn.php";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="icon2.png">
    <title>CERTIFICATE MAINTANCE SYSTEM</title>
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
            --muted: #8a7d6b;
            --radius: 22px;
            --radius-sm: 16px;
            --shadow: 0 10px 30px rgba(26, 18, 11, 0.12);
            --shadow-lg: 0 20px 45px rgba(26, 18, 11, 0.16);
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
            position: relative;
        }

        .topbar::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold) 50%, transparent);
            opacity: 0.6;
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

        /* ---------- Buttons (unified, smoother hover) ---------- */
        .btn,
        button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--gold-pale);
            border: 1.5px solid var(--gold-soft);
            border-radius: 999px;
            padding: 10px 22px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.25s ease, color 0.25s ease, border-color 0.25s ease,
                transform 0.2s ease, box-shadow 0.25s ease;
        }

        /* Buttons that sit on the dark topbar */
        .topbar .btn {
            background: rgba(255, 255, 255, 0.04);
        }

        .topbar .btn:hover {
            background: var(--gold);
            color: var(--dark);
            border-color: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(212, 175, 55, 0.35);
        }

        .btn.solid {
            background: var(--gold);
            color: var(--dark);
            border-color: var(--gold);
        }

        .btn.solid:hover {
            background: var(--gold-soft);
            border-color: var(--gold-soft);
            color: var(--dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(212, 175, 55, 0.35);
        }

        /* Buttons that sit on the light cream panel (e.g. inside #button, .add-row) */
        .panel .btn {
            background: var(--dark);
            color: var(--gold-pale);
            border-color: var(--gold);
        }

        .panel .btn:hover {
            background: var(--gold);
            color: var(--dark);
            border-color: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(212, 175, 55, 0.3);
        }

        .panel .add-row .btn {
            background: var(--gold);
            color: var(--dark);
        }

        .panel .add-row .btn:hover {
            background: var(--gold-soft);
            border-color: var(--gold-soft);
            box-shadow: 0 10px 22px rgba(212, 175, 55, 0.4);
        }

        /* ---------- Page wrap / panel ---------- */
        .page-wrap {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .panel {
            background: var(--cream-card);
            margin: 36px auto;
            padding: 50px 55px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .panel h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin: 0 0 8px;
            color: var(--dark);
        }

        .panel h3 .accent {
            color: var(--gold-soft);
        }

        /* ---------- Faculty info card ---------- */
        .profile-block {
            padding-bottom: 36px;
            margin-bottom: 36px;
            border-bottom: 1px dashed var(--border);
        }

        .profile-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 22px;
            margin-bottom: 28px;
        }

        .icon-circle {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            background: linear-gradient(145deg, var(--gold-pale), #fff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 0 0 5px #fff, 0 0 0 6px var(--gold-soft), var(--shadow);
        }

        .icon-circle svg {
            width: 38px;
            height: 38px;
        }

        .profile-header .headline {
            text-align: left;
        }

        .profile-header .headline .eyebrow {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--gold-soft);
            margin: 0 0 4px;
        }

        .profile-header .headline .faculty-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }

        .info-badges {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .info-badge {
            display: flex;
            flex-direction: column;
            gap: 6px;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 14px 18px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.25s ease, transform 0.2s ease, box-shadow 0.25s ease;
        }

        .info-badge::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--gold), var(--rust));
            opacity: 0.85;
        }

        .info-badge:hover {
            border-color: var(--gold-soft);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .info-badge .label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: var(--muted);
        }

        .info-badge b {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            color: var(--dark);
            font-weight: 700;
        }

        @media only screen and (max-width: 700px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-header .headline {
                text-align: center;
            }

            .info-badges {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* ---------- Search section ---------- */
        .section-head {
            text-align: center;
            margin-bottom: 28px;
        }

        .section-sub {
            color: var(--muted);
            font-size: 14px;
            margin-top: 4px;
        }

        #quick-book {
            margin-bottom: 8px;
        }

        .option-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .option-card {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            text-align: center;
            background: var(--cream);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 24px 16px;
            cursor: pointer;
            transition: background 0.25s ease, border-color 0.25s ease,
                transform 0.2s ease, box-shadow 0.25s ease;
        }

        .option-card svg {
            width: 30px;
            height: 30px;
            color: var(--rust);
            transition: color 0.25s ease;
        }

        .option-card span {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
            transition: color 0.25s ease;
        }

        .option-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        /* Gentle gold highlight on hover, not black */
        .option-card:hover {
            border-color: var(--gold-soft);
            background: var(--gold-pale);
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        /* Selected state stays warm gold, not stark black */
        .option-card:has(input:checked) {
            background: linear-gradient(145deg, var(--gold-pale) 0%, var(--gold) 100%);
            border-color: var(--gold);
            box-shadow: 0 10px 24px rgba(212, 175, 55, 0.35);
        }

        .option-card:has(input:checked) span {
            color: var(--dark);
        }

        .option-card:has(input:checked) svg {
            color: var(--rust);
        }

        #button {
            margin-top: 20px;
            text-align: center;
        }

        /* ---------- Add certificate ---------- */
        .add-row {
            text-align: center;
            margin-top: 40px;
            padding-top: 32px;
            border-top: 1px dashed var(--border);
        }

        .add-row p {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 18px;
        }

        @media only screen and (max-width: 900px) {
            .panel {
                margin: 18px;
                padding: 30px 22px;
            }

            .btn {
                width: 100%;
                margin: 6px 0;
                justify-content: center;
            }

            .topbar-actions {
                width: 100%;
                justify-content: space-between;
            }

            .option-grid {
                grid-template-columns: 1fr;
            }

            .info-badges {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>

    <div class="topbar">
        <h1 class="brand">

            Certificate <span>Management</span> System
        </h1>
        <div class="topbar-actions">
            <a href="studentdetails.php" class="n"><button type="button" class="btn">Student Details</button></a>
            <a href="updatepsw.php" class="n"><button type="button" class="btn">Update Password</button></a>
            <a href="logout.php" class="n"><button type="button" class="btn solid">Logout</button></a>
        </div>
    </div>

    <div class="page-wrap">
        <div class="panel">
            <?php
            $uname = $_SESSION['username'];

            $query = "select * from faculty where id='$uname'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="login-content">

                    <div class="profile-block">
                        <div class="profile-header">
                            <div class="icon-circle" style="position:relative;">
                                <?php if (!empty($row['profile_pic'])): ?>
                                    <img src="images/profile/<?php echo htmlspecialchars($row['profile_pic']); ?>"
                                        alt="Profile photo"
                                        style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                <?php else: ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="#b5502e" stroke-width="1.6">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M4 20c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke-linecap="round" />
                                    </svg>
                                <?php endif; ?>

                                <a href="profile_pic.php" class="n"
                                    title="Change profile picture"
                                    style="
                                     position:absolute;
                                     bottom:-2px;
                                     right:-2px;
                                     width:30px;
                                     height:30px;
                                     border-radius:50%;
                                     background: var(--gold);
                                     border: 2px solid #fff;
                                     display:flex;
                                     align-items:center;
                                     justify-content:center;
                                     box-shadow: 0 3px 8px rgba(26,18,11,.25);
                                     transition: background .2s ease, transform .2s ease;
                                   "
                                    onmouseover="this.style.background='#b5502e';this.style.transform='scale(1.08)';"
                                    onmouseout="this.style.background='var(--gold)';this.style.transform='scale(1)';">
                                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="var(--dark)" stroke-width="2">
                                        <path d="M4 8h3l2-2h6l2 2h3v11H4z" stroke-linejoin="round" />
                                        <circle cx="12" cy="13.5" r="3.2" />
                                    </svg>
                                </a>
                            </div>
                            <div class="headline">
                                <p class="eyebrow">Faculty Profile</p>
                                <p class="faculty-name"><?php echo $_SESSION['name'] = $row['name']; ?></p>
                            </div>
                        </div>

                        <div class="info-badges">
                            <div class="info-badge">
                                <span class="label">Id. No</span>
                                <b><?php echo $_SESSION['id'] = $row['id']; ?></b>
                            </div>
                            <div class="info-badge">
                                <span class="label">Branch</span>
                                <b><?php echo $row['department']; ?></b>
                            </div>
                            <div class="info-badge">
                                <span class="label">Year of Joining</span>
                                <b><?php echo $row['year']; ?></b>
                            </div>
                            <div class="info-badge">
                                <span class="label">Role</span>
                                <b>Faculty</b>
                            </div>
                        </div>
                    </div>

                    <div class="section-head">
                        <h3>Search <span class="accent">Certificate</span></h3>
                        <div class="section-sub">Choose which set of certificates you'd like to look up</div>
                    </div>

                    <div id="quick-book">
                        <form onchange="myFunction()" name="frmRadio" id="radio-buttons" action="">
                            <div class="option-grid">
                                <label class="option-card">
                                    <input type="radio" id="fsearch" name="option" onclick="document.getElementById('radio-buttons').action='';">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                        <path d="M6 3h9l3 3v15H6z" stroke-linejoin="round" />
                                        <path d="M9 11h6M9 15h6M9 7h3" stroke-linecap="round" />
                                    </svg>
                                    <span>Your Certificates</span>
                                </label>
                                <label class="option-card">
                                    <input type="radio" id="clssearch" name="option" onclick="document.getElementById('radio-buttons').action='';">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                        <circle cx="9" cy="8" r="3" />
                                        <circle cx="17" cy="9" r="2.4" />
                                        <path d="M3.5 19c0-3.3 2.7-5.5 5.5-5.5s5.5 2.2 5.5 5.5" stroke-linecap="round" />
                                        <path d="M15.2 14.6c2.2.3 3.8 2 3.8 4.4" stroke-linecap="round" />
                                    </svg>
                                    <span>Your Class Certificates</span>
                                </label>
                                <label class="option-card">
                                    <input type="radio" id="cosearch" name="option" onclick="document.getElementById('radio-buttons').action='';">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                        <path d="M4 18v-1a5 5 0 0 1 5-5h1a5 5 0 0 1 5 5v1" stroke-linecap="round" />
                                        <circle cx="9.5" cy="7" r="3" />
                                        <path d="M16 4.2c1.5.5 2.6 2 2.6 3.6 0 1.7-1.1 3.1-2.6 3.6" stroke-linecap="round" />
                                    </svg>
                                    <span>Your Counseling Certificates</span>
                                </label>
                            </div>
                        </form>
                        <div id="button"></div>
                    </div>

                    <div class="add-row">
                        <p>To add your certificate to your collection, click Add</p>
                        <a href="facultyadd.php" class="n"><button type="button" class="btn">Add</button></a>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>

    <script>
        function myFunction() {
            if (document.getElementById("fsearch").checked) {
                document.getElementById("button").innerHTML = "<a href='fsearch.php' class='n' ><button type='button' class='btn' >search your certificates</button></a><br>";
            }
            if (document.getElementById("clssearch").checked) {
                document.getElementById("button").innerHTML = "<a href='clssearch.php' class='n' ><button type='button' class='btn' >search your class students certificates</button></a><br>";
            }
            if (document.getElementById("cosearch").checked) {
                document.getElementById("button").innerHTML = "<a href='cosearch.php' class='n' ><button type='button' class='btn' >search your counsiling students certificates</button></a><br>";
            }
        }
    </script>
</body>

</html>