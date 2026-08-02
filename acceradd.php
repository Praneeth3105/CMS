<?php
include "db_conn.php";
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CERTIFICATE MAINTENANCE SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --dark: #1c1510;
            --dark-2: #241b14;
            --gold: #c9a227;
            --gold-light: #d9b84a;
            --cream: #f5efe4;
            --card-bg: #ffffff;
            --text-dark: #2b2318;
            --text-muted: #6b6155;
            --border: #e6ddc9;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            background: var(--cream);
            color: var(--text-dark);
        }

        .topbar {
            background: linear-gradient(180deg, var(--dark) 0%, var(--dark-2) 100%);
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }

        .topbar h1 {
            color: #f2ead8;
            font-size: 22px;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .topbar h1 span {
            color: var(--gold-light);
        }

        .btn {
            font-family: Georgia, serif;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.4px;
            padding: 10px 22px;
            border-radius: 999px;
            border: 1px solid var(--gold);
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-dark {
            background: var(--dark);
            color: var(--gold-light);
        }

        .btn-dark:hover {
            background: #000;
        }

        .btn-gold {
            background: var(--gold);
            color: var(--dark);
            border-color: var(--gold);
        }

        .btn-gold:hover {
            background: var(--gold-light);
        }

        .n {
            text-decoration: none;
        }

        .page-heading {
            text-align: center;
            margin: 34px 0 22px;
        }

        .page-heading .eyebrow {
            color: var(--text-muted);
            letter-spacing: 3px;
            font-size: 12px;
            text-transform: uppercase;
            font-family: Arial, sans-serif;
            margin-bottom: 6px;
        }

        .page-heading h2 {
            font-size: 30px;
            margin: 0;
            color: var(--text-dark);
        }

        .page-heading h2 span {
            color: #a0522d;
        }

        .form-container {
            max-width: 950px;
            margin: 0 auto 60px;
            padding: 0 24px;
        }

        .form-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(28, 21, 16, 0.08);
            padding: 40px;
        }

        .parent {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .child {
            flex: 1;
            min-width: 260px;
        }

        label {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: var(--text-muted);
            letter-spacing: 0.3px;
            display: block;
            margin-top: 16px;
            margin-bottom: 6px;
        }

        input[type=file] {
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #faf7f0;
            color: var(--text-dark);
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s ease;
        }

        input[type=file]:focus {
            border-color: var(--gold);
        }

        .submit-row {
            text-align: center;
            margin-top: 32px;
        }

        .submit-row input[type=submit] {
            width: 30%;
            min-width: 180px;
            font-family: Georgia, serif;
            font-weight: 600;
            font-size: 15px;
            padding: 12px 22px;
            border-radius: 999px;
            border: 1px solid var(--gold);
            background: var(--gold);
            color: var(--dark);
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .submit-row input[type=submit]:hover {
            background: var(--gold-light);
        }
    </style>
</head>

<body>
    <?php

    $uname = $_SESSION['username'];
    $name  = $_SESSION['name'];
    ?>

    <div class="topbar">
        <h1>Certificate <span>Management</span> System</h1>
        <a href="accer.php" class="n"><button type="button" class="btn btn-dark">&larr; Back</button></a>
    </div>

    <div class="page-heading">
        <div class="eyebrow">Digital Records, Verified</div>
        <h2>Academic <span>Certificates</span></h2>
    </div>

    <div class="form-container">
        <div class="form-card">
            <form method='POST' action='nu1.php' enctype='multipart/form-data'>
                <div class="parent">
                    <div class="child">
                        <label>Upload Aadhar Card</label>
                        <input type="file" name="aadhar" required>

                        <label>10th Memo</label>
                        <input type="file" name="ssc" required>

                        <label>Inter Memo</label>
                        <input type="file" name="inter" required>

                        <label>1-1 Semester</label>
                        <input type="file" name="1-1">

                        <label>1-2 Semester</label>
                        <input type="file" name="1-2">
                    </div>

                    <div class="child">
                        <label>2-1 Semester</label>
                        <input type="file" name="2-1">

                        <label>2-2 Semester</label>
                        <input type="file" name="2-2">

                        <label>3-1 Semester</label>
                        <input type="file" name="3-1">

                        <label>3-2 Semester</label>
                        <input type="file" name="3-2">

                        <label>4-1 Semester</label>
                        <input type="file" name="4-1">

                        <label>4-2 Semester</label>
                        <input type="file" name="4-2">
                    </div>
                </div>

                <div class="submit-row">
                    <input type='submit' value='Submit' name='submit'>
                </div>
            </form>
        </div>
    </div>

</body>

</html>