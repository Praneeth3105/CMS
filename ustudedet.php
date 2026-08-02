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
            max-width: 900px;
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

        input[type=text],
        input[type=password],
        input[type=email],
        input[type=file],
        select {
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
        }

        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        select:focus {
            border-color: var(--gold);
        }

        select {
            appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, var(--text-muted) 50%),
                linear-gradient(135deg, var(--text-muted) 50%, transparent 50%);
            background-position: calc(100% - 18px) calc(1em + 4px), calc(100% - 13px) calc(1em + 4px);
            background-size: 5px 5px, 5px 5px;
            background-repeat: no-repeat;
        }

        input[type=file] {
            padding: 10px 12px;
            cursor: pointer;
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

    <div class="topbar">
        <h1>Certificate <span>Management</span> System</h1>
        <a href="studentdat.php" class="n"><button type="button" class="btn btn-dark">&larr; Back</button></a>
    </div>

    <div class="page-heading">
        <div class="eyebrow">Digital Records, Verified</div>
        <h2>Update <span>Details</span></h2>
    </div>

    <div class="form-container">
        <div class="form-card">
            <form method='POST' action='' enctype='multipart/form-data'>
                <?php

                $uname = $_SESSION['username'];
                $query = "select * from studentdetails where username='$uname'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <div class="parent">
                        <div class="child">
                            <label for="name">Name</label>
                            <input type="text" placeholder="Enter Your Name" value='<?php echo $row['name']; ?>' name="name" id="name" required>

                            <label for="number">Phone Number</label>
                            <input type="text" placeholder="Enter Phone Number" name="number" value='<?php echo $row['number']; ?>' id="number" required>

                            <label for="department">Department</label>
                            <select name="department" id="department" required>
                                <option value="">Branch</option>
                                <option value="CSM">CSM</option>
                                <option value="CSE">CSE</option>
                                <option value="CIC">CIC</option>
                                <option value="CSO">CSO</option>
                                <option value="EEE">EEE</option>
                                <option value="ECE">ECE</option>
                                <option value="MECH">MECH</option>
                                <option value="CIVIL">CIVIL</option>
                                <option value="CSD">CSD</option>
                            </select>

                            <label for="year">Year</label>
                            <select id='year' onclick='my()' name='year' required>
                                <option value="year">Year</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>

                        <div class="child">
                            <label for="address">Address</label>
                            <input type="text" placeholder="Enter Your Address" value='<?php echo $row['location']; ?>' name="address" id="address" required>

                            <label for="email">Email</label>
                            <input type="email" placeholder="Enter Email" name="email" value='<?php echo $row['email']; ?>' id="email" required>

                            <label for="academic">Academic Year</label>
                            <select id='academic' onclick='my()' name='acc' required>
                                <option value="">Academic Year</option>
                                <option value='2019-2023'>2019-2023</option>
                                <option value='2020-2024'>2020-2024</option>
                                <option value='2021-2025'>2021-2025</option>
                                <option value='2022-2026'>2022-2026</option>
                                <option value='2023-2027'>2023-2027</option>
                            </select>

                            <label for="classteacher">Upload your photo</label>
                            <input type="file" name="file" id="classteacher" required>
                            <input type='hidden' name='oldimage' value='<?php echo $row['pic']; ?>'>
                        </div>
                    </div>

                    <div class="submit-row">
                        <input type='submit' value='Update' name='submit'>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>

</body>

</html>
<?php
include "db_conn.php";

if (isset($_POST['submit'])) {

    session_start();

    $uname = $_SESSION['username'];

    $name       = $_POST['name'];
    $num        = $_POST['number'];
    $year       = $_POST['year'];
    $department = $_POST['department'];
    $add        = $_POST['address'];
    $email      = $_POST['email'];
    $acc        = $_POST['acc'];
    $oldimage   = $_POST['oldimage'];

    $filename = $_FILES['file']['name'];
    $tempname = $_FILES['file']['tmp_name'];

    $folder = "images/" . $filename;

    $sql = "UPDATE studentdetails SET
            name='$name',
            number='$num',
            location='$add',
            email='$email',
            department='$department',
            year='$year',
            pic='$filename',
            academic_year='$acc'
            WHERE username='$uname'";

    $res = mysqli_query($conn, $sql);

    if ($res) {

        if (!empty($filename)) {

            move_uploaded_file($tempname, $folder);

            if (!empty($oldimage) && file_exists("images/" . $oldimage)) {
                unlink("images/" . $oldimage);
            }
        }

        echo "<script>
                alert('Data Updated Successfully');
                window.location='studentdat.php';
              </script>";
    } else {

        echo "<script>
                alert('Data Not Updated');
              </script>";

        echo mysqli_error($conn);
    }
}
?>