<?php
include "db_conn.php";
session_start();

$error = "";

if (isset($_POST['submit'])) {

    $facid = mysqli_real_escape_string($conn, $_POST['facid']);
    $newpass = mysqli_real_escape_string($conn, $_POST['psw']);

    // Check if the Faculty ID exists in the faculty table
    $checkQuery = "SELECT * FROM faculty WHERE id='$facid'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) == 1) {

        // Faculty ID exists -> update the password
        $updateQuery = "UPDATE faculty SET password='$newpass' WHERE id='$facid'";

        if (mysqli_query($conn, $updateQuery)) {
            // Redirect to faculty login page with a success message
            header("Location: login2.php?success=" . urlencode("Password updated successfully. Please login."));
            exit();
        } else {
            $error = "Something went wrong while updating the password. Please try again.";
        }
    } else {
        $error = "Faculty ID not found. Please check and try again.";
    }
}
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
            min-height: 100vh;
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
            max-width: 460px;
            margin: 0 auto 60px;
            padding: 0 24px;
        }

        .form-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(28, 21, 16, 0.08);
            padding: 40px;
            text-align: center;
        }

        label {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: var(--text-muted);
            letter-spacing: 0.3px;
            display: block;
            margin-bottom: 6px;
            text-align: left;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 15px;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #faf7f0;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s ease;
            margin-bottom: 28px;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            border-color: var(--gold);
        }

        input[type=submit] {
            width: 60%;
            min-width: 160px;
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

        input[type=submit]:hover {
            background: var(--gold-light);
        }

        .error {
            background: #fde8e8;
            color: #c0392b;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="topbar">
        <h1>Certificate <span>Management</span> System</h1>
        <a href="login2.php" class="n"><button type="button" class="btn btn-dark">&larr; Back</button></a>
    </div>

    <div class="page-heading">
        <div class="eyebrow">Digital Records, Verified</div>
        <h2>Forgot <span>Password</span></h2>
    </div>

    <div class="form-container">
        <div class="form-card">

            <?php if ($error) { ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php } ?>

            <form method='POST' action=''>
                <label for="facid">Enter Your Faculty ID</label>
                <input type="text" placeholder="Enter Your Faculty ID" name="facid" id="facid" required>
                <label for="psw">Enter New Password</label>
                <input type="password" placeholder="Enter New Password" name="psw" id="psw" required>
                <input type='submit' value='Update' name='submit'>
            </form>
        </div>
    </div>

</body>

</html>