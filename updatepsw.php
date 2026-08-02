<?php
include "db_conn.php" ;
    session_start();
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="icon" type="image/x-icon" href="icon2.png">
        <title>CERTIFICATE MAINTANCE SYSTEM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/a81368914c.js"></script>

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
                --shadow: 0 8px 22px rgba(120, 100, 60, 0.10);
                --shadow-lg: 0 12px 32px rgba(120, 100, 60, 0.12), 0 2px 8px rgba(26, 18, 11, 0.06);
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

            /* ---------- Buttons ---------- */
            .btn,
            button,
            input[type="submit"] {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                background: rgba(255, 255, 255, 0.04);
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

            .topbar .btn {
                margin: 0;
            }

            .topbar .btn:hover {
                background: var(--gold);
                color: var(--dark);
                border-color: var(--gold);
                transform: translateY(-2px);
                box-shadow: 0 8px 18px rgba(212, 175, 55, 0.35);
            }

            .panel input[type="submit"] {
                background: var(--gold);
                color: var(--dark);
                border-color: var(--gold);
            }

            .panel input[type="submit"]:hover {
                background: var(--gold-soft);
                border-color: var(--gold-soft);
                transform: translateY(-2px);
                box-shadow: 0 10px 22px rgba(212, 175, 55, 0.4);
            }

            /* ---------- Page wrap / panel ---------- */
            .page-wrap {
                max-width: 560px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .panel {
                background: var(--cream-card);
                margin: 48px auto;
                padding: 46px 44px;
                border-radius: var(--radius);
                box-shadow: var(--shadow-lg);
                border: 1px solid var(--border);
                position: relative;
                overflow: hidden;
            }

            .panel-icon {
                width: 78px;
                height: 78px;
                border-radius: 50%;
                background: linear-gradient(145deg, var(--gold-pale), #fff);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                box-shadow: 0 0 0 5px #fff, 0 0 0 6px var(--gold-soft), var(--shadow);
            }

            .panel-icon svg {
                width: 34px;
                height: 34px;
            }

            .panel h2 {
                font-family: 'Playfair Display', serif;
                font-size: 1.9rem;
                font-weight: 700;
                text-align: center;
                margin: 0 0 6px;
                color: var(--dark);
            }

            .panel .subtitle {
                text-align: center;
                font-size: 14px;
                color: var(--muted);
                margin: 0 0 34px;
            }

            /* ---------- Form ---------- */
            form {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            label {
                font-size: 12.5px;
                font-weight: 600;
                letter-spacing: 0.6px;
                text-transform: uppercase;
                color: var(--muted);
            }

            input[type=text],
            input[type=password],
            input[type=email] {
                width: 100%;
                padding: 13px 16px;
                margin: 6px 0 22px;
                box-sizing: border-box;
                border: 1.5px solid var(--border);
                border-radius: var(--radius-sm);
                background: var(--cream);
                font-family: 'Poppins', sans-serif;
                font-size: 14.5px;
                color: var(--dark);
                transition: border-color 0.25s ease, box-shadow 0.25s ease;
            }

            input[type=text]:focus,
            input[type=password]:focus,
            input[type=email]:focus {
                outline: none;
                border-color: var(--gold);
                box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.15);
            }

            select {
                background-color: var(--cream);
                color: var(--dark);
                border: 1.5px solid var(--border);
                border-radius: var(--radius-sm);
                padding: 12px 16px;
            }

            .form-actions {
                text-align: center;
                margin-top: 8px;
            }

            .form-actions input[type="submit"] {
                width: 60%;
                padding: 13px 26px;
            }

            @media only screen and (max-width: 600px) {
                .panel {
                    margin: 20px;
                    padding: 32px 24px;
                }

                .form-actions input[type="submit"] {
                    width: 100%;
                }
            }
        </style>
    </head>

    <body>

        <div class="topbar">
            <h1 class="brand">
                Certificate <span>Management</span> System
            </h1>
            <a href="facultydat.php" class="n"><button type="button" class="btn" id="btn1">Back</button></a>
        </div>

        <div class="page-wrap">
            <div class="panel">
                <div class="panel-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#b5502e" stroke-width="1.6">
                        <rect x="5" y="11" width="14" height="9" rx="2" />
                        <path d="M8 11V7a4 4 0 0 1 8 0v4" stroke-linecap="round" />
                        <circle cx="12" cy="15" r="1.4" fill="#b5502e" stroke="none" />
                    </svg>
                </div>

                <h2>Update Password</h2>
                <p class="subtitle">Set a new password to secure your account</p>

                <form method="POST" action="" enctype="multipart/form-data">
                    <label for="psw">New Password</label>
                    <input type="password" placeholder="Enter New Password" name="psw" id="psw" required>

                    <div class="form-actions">
                        <input type="submit" value="Update" name="submit">
                    </div>
                </form>
            </div>
        </div>

    </body>

    </html>

    <?php
    $uname = $_SESSION['username'];

    if (isset($_POST['submit'])) {
        $npsw = $_POST['psw'];
        $sql = "UPDATE faculty SET password='$npsw' WHERE id='$uname'";
        // Execute query
        $reso = mysqli_query($conn, $sql);
        if ($reso) {
            echo "<script>alert('Data Updated Successfully');window.location='facultydat.php';</script>";
        } else {
            echo "<script>alert('Data not Uploaded');window.location='facultydat.php';</script>";
        }
    }
    ?>