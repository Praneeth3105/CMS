<?php

include "db_conn.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login1.php");
    exit();
}

$rollno = $_SESSION['username'];

/* -----------------------------------------
   GET CURRENT STUDENT DETAILS
----------------------------------------- */

$stmtStudent = mysqli_prepare(
    $conn,
    "SELECT
        username,
        name,
        year,
        department,
        counsular,
        counsular_id,
        classteacher,
        classteacher_id
     FROM studentdetails
     WHERE username = ?
     LIMIT 1"
);

mysqli_stmt_bind_param(
    $stmtStudent,
    "s",
    $rollno
);

mysqli_stmt_execute($stmtStudent);

$resultStudent = mysqli_stmt_get_result($stmtStudent);

$student = mysqli_fetch_assoc($resultStudent);

if (!$student) {
    die("Student details not found.");
}

/* -----------------------------------------
   STUDENT INFORMATION
----------------------------------------- */

$name = $student['name'];
$year = $student['year'];
$branch = $student['department'];

$counsular = $student['counsular'];
$counsular_id = $student['counsular_id'];

$classteacher = $student['classteacher'];
$classteacher_id = $student['classteacher_id'];

/* -----------------------------------------
   FORM DATA
----------------------------------------- */

$wn = $_POST['wn'] ?? '';
$org = $_POST['org'] ?? '';
$sd = $_POST['sd'] ?? '';
$ed = $_POST['ed'] ?? '';
$place = $_POST['place'] ?? '';
$accy = $_POST['accy'] ?? '';

/* -----------------------------------------
   FILE
----------------------------------------- */

$filename = "";
$tempname = "";
$folder = "";

if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {

    $filename = basename($_FILES["file"]["name"]);
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "images/" . $filename;
}

/* -----------------------------------------
   DURATION
----------------------------------------- */

$durt = "";

if (!empty($sd) && !empty($ed)) {

    $datetime1 = date_create($sd);
    $datetime2 = date_create($ed);

    $duration = date_diff($datetime1, $datetime2);

    $durt = $duration->format('%m months, %d days');
}

/* -----------------------------------------
   INSERT
----------------------------------------- */

if (isset($_POST['submit'])) {

    $sql = "
        INSERT INTO sworkshop
        (
            RollNo,
            Name,
            WorkShopName,
            OrgName,
            StartDate,
            EndDate,
            Duration,
            Place,
            file,
            branch,
            year,
            counsular,
            counsular_id,
            classteacher,
            classteacher_id,
            academic_year
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Database prepare error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssssssssss",
        $rollno,
        $name,
        $wn,
        $org,
        $sd,
        $ed,
        $durt,
        $place,
        $filename,
        $branch,
        $year,
        $counsular,
        $counsular_id,
        $classteacher,
        $classteacher_id,
        $accy
    );

    $res = mysqli_stmt_execute($stmt);

    if ($res) {

        $uploadSuccess = true;

        if ($filename !== "") {

            $uploadSuccess = move_uploaded_file(
                $tempname,
                $folder
            );
        }

        if ($uploadSuccess) {

            echo "
            <script>
                alert('Data Uploaded Successfully');
                window.location='studentadd.php';
            </script>
            ";
        } else {

            echo "
            <script>
                alert('Data saved, but file upload failed.');
                window.location='studentadd.php';
            </script>
            ";
        }
    } else {

        echo "
        <script>
            alert('Data not Uploaded');
            history.back();
        </script>
        ";
    }

    mysqli_stmt_close($stmt);
}

mysqli_stmt_close($stmtStudent);
