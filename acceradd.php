<?php
session_start();

if (!isset($_SESSION['id']) || empty($_SESSION['username'])) {
    header("Location: login1.php");
    exit();
}

include "db_conn.php";
$uname = $_SESSION['username'];
$name = $_SESSION['name'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link
        rel="icon"
        type="image/x-icon"
        href="icon2.png">
    <title>CERTIFICATE MANAGEMENT SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --dark: #1c1510;
            --dark2: #241b14;
            --gold: #c9a227;
            --gold-light: #d9b84a;
            --cream: #f5efe4;
            --text: #2b2318;
            --muted: #6b6155;
            --border: #e6ddc9
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            background: var(--cream);
            color: var(--text)
        }

        .topbar {
            background: linear-gradient(180deg, var(--dark), var(--dark2));
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold)
        }

        .topbar h1 {
            color: #f2ead8;
            font-size: 22px;
            margin: 0
        }

        .topbar h1 span {
            color: var(--gold-light)
        }

        .btn {
            font-family: Georgia, serif;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 22px;
            border-radius: 999px;
            border: 1px solid var(--gold);
            cursor: pointer;
            text-decoration: none;
            display: inline-block
        }

        .btn-dark {
            background: var(--dark);
            color: var(--gold-light)
        }

        .page-heading {
            text-align: center;
            margin: 34px 0 22px
        }

        .page-heading .eyebrow {
            color: var(--muted);
            letter-spacing: 3px;
            font: 12px Arial, sans-serif;
            text-transform: uppercase;
            margin-bottom: 6px
        }

        .page-heading h2 {
            font-size: 30px;
            margin: 0
        }

        .page-heading h2 span {
            color: #a0522d
        }

        .form-container {
            max-width: 950px;
            margin: 0 auto 60px;
            padding: 0 24px
        }

        .form-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(28, 21, 16, .08);
            padding: 40px
        }

        .parent {
            display: flex;
            gap: 40px;
            flex-wrap: wrap
        }

        .child {
            flex: 1;
            min-width: 260px
        }

        label {
            font: 13px Arial, sans-serif;
            color: var(--muted);
            display: block;
            margin: 16px 0 6px
        }

        input[type=file] {
            width: 100%;
            font: 14px Arial, sans-serif;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #faf7f0;
            color: var(--text)
        }

        .submit-row {
            text-align: center;
            margin-top: 32px
        }

        .submit-row input[type=submit] {
            width: 30%;
            min-width: 180px;
            font: 600 15px Georgia, serif;
            padding: 12px 22px;
            border-radius: 999px;
            border: 1px solid var(--gold);
            background: var(--gold);
            color: var(--dark);
            cursor: pointer
        }

        @media(max-width:600px) {
            .topbar {
                padding: 16px;
                gap: 12px;
                flex-wrap: wrap
            }

            .form-card {
                padding: 24px
            }

            .submit-row input[type=submit] {
                width: 100%
            }
        }
    </style>
</head>

<body>
    <div class="topbar">
        <h1>Certificate <span>Management</span> System</h1><a href="accer.php" class="btn btn-dark">&larr; Back</a>
    </div>
    <div class="page-heading">
        <div class="eyebrow">Digital Records, Verified</div>
        <h2>Academic <span>Certificates</span></h2>
    </div>
    <div class="form-container">
        <div class="form-card">
            <form method="POST" action="nu1.php" enctype="multipart/form-data">
                <div class="parent">
                    <div class="child">
                        <label>Upload Aadhar Card</label><input type="file" name="aadhar" required>
                        <label>10th Memo</label><input type="file" name="ssc" required>
                        <label>Inter Memo</label><input type="file" name="inter" required>
                        <label>1-1 Semester</label><input type="file" name="1-1">
                        <label>1-2 Semester</label><input type="file" name="1-2">
                    </div>
                    <div class="child">
                        <label>2-1 Semester</label><input type="file" name="2-1">
                        <label>2-2 Semester</label><input type="file" name="2-2">
                        <label>3-1 Semester</label><input type="file" name="3-1">
                        <label>3-2 Semester</label><input type="file" name="3-2">
                        <label>4-1 Semester</label><input type="file" name="4-1">
                        <label>4-2 Semester</label><input type="file" name="4-2">
                    </div>
                </div>
                <div class="submit-row"><input type="submit" value="Submit" name="submit"></div>
            </form>
        </div>
    </div>
</body>

</html>