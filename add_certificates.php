<?php
include "db_conn.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $name             = $_SESSION['name'];
    $faculty_id       = $_SESSION['id'];
    $academic_year    = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $certificate      = mysqli_real_escape_string($conn, $_POST['certificate']);
    $org              = mysqli_real_escape_string($conn, $_POST['org']);
    $start_date       = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date         = mysqli_real_escape_string($conn, $_POST['end_date']);
    $duration         = mysqli_real_escape_string($conn, $_POST['duration']);
    $mode             = mysqli_real_escape_string($conn, $_POST['mode']);
    $certificate_link = mysqli_real_escape_string($conn, $_POST['certificate_link']);

    $sql = "INSERT INTO certificates (academic_year, name, certificate, org, start_date, end_date, duration, mode, certificate_link, faculty_id)
            VALUES ('$academic_year', '$name', '$certificate', '$org', '$start_date', '$end_date', '$duration', '$mode', '$certificate_link', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
