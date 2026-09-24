<?php

include "db_conn.php";
session_start();


/* ------------------------------------------------
   CHECK STUDENT LOGIN
------------------------------------------------ */

if (!isset($_SESSION['username'])) {
    header("Location: login1.php");
    exit();
}


/* ------------------------------------------------
   GET STUDENT ROLL NUMBER
------------------------------------------------ */

$rollno = $_SESSION['username'];


/* ------------------------------------------------
   GET CURRENT STUDENT DETAILS
   INCLUDING COUNSELLOR + CLASS INCHARGE IDs
------------------------------------------------ */

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


/* ------------------------------------------------
   CHECK STUDENT EXISTS
------------------------------------------------ */

if (!$student) {
    die("Student details not found.");
}


/* ------------------------------------------------
   STUDENT DETAILS
------------------------------------------------ */

$name = $student['name'];

$year = $student['year'];

$branch = $student['department'];


/* ------------------------------------------------
   COUNSELLOR DETAILS
------------------------------------------------ */

$counsular = $student['counsular'];

$counsular_id = $student['counsular_id'];


/* ------------------------------------------------
   CLASS INCHARGE DETAILS
------------------------------------------------ */

$classteacher = $student['classteacher'];

$classteacher_id = $student['classteacher_id'];


/* ------------------------------------------------
   GET FORM DATA
------------------------------------------------ */

$_SESSION['ni'] = $_POST['ni'] ?? '';
$_SESSION['nc'] = $_POST['nc'] ?? '';
$_SESSION['sd'] = $_POST['sd'] ?? '';
$_SESSION['ed'] = $_POST['ed'] ?? '';
$_SESSION['ay'] = $_POST['ay'] ?? '';
$_SESSION['acc'] = $_POST['acc'] ?? '';


$ni = $_SESSION['ni'];

$nc = $_SESSION['nc'];

$sd = $_SESSION['sd'];

$ed = $_SESSION['ed'];

$ay = $_SESSION['ay'];

$acc = $_SESSION['acc'];


/* ------------------------------------------------
   FILE UPLOAD
------------------------------------------------ */

$filename = "";

$tempname = "";

$folder = "";


if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {

    $filename = basename($_FILES["file"]["name"]);

    $tempname = $_FILES["file"]["tmp_name"];

    $folder = "images/" . $filename;
}


/* ------------------------------------------------
   CALCULATE DURATION
------------------------------------------------ */

$datetime1 = date_create($sd);

$datetime2 = date_create($ed);

$durt = date_diff($datetime1, $datetime2);

$durt = $durt->format('%m months, %d days');


/* ------------------------------------------------
   INSERT COURSE
------------------------------------------------ */

if (isset($_POST['submit'])) {

    $sql = "
        INSERT INTO course
        (
            RollNo,
            Name,
            CourseName,
            OrganisationName,
            StartDate,
            Enddate,
            Duration,
            year,
            file,
            branch,
            counsular,
            counsular_id,
            classteacher,
            classteacher_id,
            academicyear
        )
        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
        )
    ";


    $stmt = mysqli_prepare($conn, $sql);


    if (!$stmt) {

        die("Database prepare error: " . mysqli_error($conn));
    }


    mysqli_stmt_bind_param(
        $stmt,
        "sssssssssssssss",
        $rollno,
        $name,
        $nc,
        $ni,
        $sd,
        $ed,
        $durt,
        $year,
        $filename,
        $branch,
        $counsular,
        $counsular_id,
        $classteacher,
        $classteacher_id,
        $acc
    );


    /* ------------------------------------------------
       EXECUTE INSERT
    ------------------------------------------------ */

    $res = mysqli_stmt_execute($stmt);


    /* ------------------------------------------------
       UPLOAD FILE
    ------------------------------------------------ */

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
