<?php
include "db_conn.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
if (isset($_POST['submit'])) {

    $faculty_id = $_SESSION['id'];
    $name       = $_SESSION['name'];

    $academic_year    = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $workshop         = mysqli_real_escape_string($conn, $_POST['workshop']);
    $org              = mysqli_real_escape_string($conn, $_POST['org']);
    $start_date       = mysqli_real_escape_string($conn, $_POST['start_date']);
    $start_date_raw   = mysqli_real_escape_string($conn, $_POST['start_date_raw']);
    $end_date         = mysqli_real_escape_string($conn, $_POST['end_date']);
    $end_date_raw     = mysqli_real_escape_string($conn, $_POST['end_date_raw']);
    $mode             = mysqli_real_escape_string($conn, $_POST['mode']);
    $certificate_link = mysqli_real_escape_string($conn, $_POST['certificate_link']);

    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $datetime1 = date_create($start_date);
    $datetime2 = date_create($end_date);
    if ($datetime1 && $datetime2) {
        $diff = date_diff($datetime1, $datetime2);
        $duration = $diff->format('%m months, %d days');
    }

    $sql = "INSERT INTO ffworkshop (faculty_id, academic_year, name, workshop, org, start_date, start_date_raw, end_date, end_date_raw, duration, mode, certificate_link)
            VALUES ('$faculty_id', '$academic_year', '$name', '$workshop', '$org', '$start_date', '$start_date_raw', '$end_date', '$end_date_raw', '$duration', '$mode', '$certificate_link')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }

    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
