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

$tname = $_POST['tname'] ?? '';
$bnum = $_POST['bnum'] ?? '';
$accy = $_POST['acc'] ?? '';
$link = $_POST['link'] ?? '';

/* -----------------------------------------
   INSERT
----------------------------------------- */

if (isset($_POST['submit'])) {

    $sql = "
        INSERT INTO sproject
        (
            Team_Number,
            Roll_Number,
            Name,
            Project_title,
            year,
            Drive_link,
            branch,
            counsular,
            counsular_id,
            classteacher,
            classteacher_id,
            academicyear
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Database prepare error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssssssss",
        $bnum,
        $rollno,
        $name,
        $tname,
        $year,
        $link,
        $branch,
        $counsular,
        $counsular_id,
        $classteacher,
        $classteacher_id,
        $accy
    );

    $res = mysqli_stmt_execute($stmt);

    if ($res) {

        echo "
        <script>
            alert('Data Uploaded Successfully');
            window.location='studentadd.php';
        </script>
        ";
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
