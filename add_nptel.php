<?php
include "db_conn.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $faculty_name     = $_SESSION['name'];
    $faculty_id       = $_SESSION['id'];
    $academic_year    = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $course_name      = mysqli_real_escape_string($conn, $_POST['course_name']);
    $duration         = mysqli_real_escape_string($conn, $_POST['duration']);
    $start_date       = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date         = mysqli_real_escape_string($conn, $_POST['end_date']);
    $percentage       = mysqli_real_escape_string($conn, $_POST['percentage']);
    $top_percentage   = mysqli_real_escape_string($conn, $_POST['top_percentage'] ?? '');
    $remarks          = mysqli_real_escape_string($conn, $_POST['remarks'] ?? '');
    $certificate_link = mysqli_real_escape_string($conn, $_POST['certificate_link']);

    $sql = "INSERT INTO nptel (academic_year, faculty_name, course_name, duration, start_date, end_date, percentage, top_percentage, remarks, certificate_link, faculty_id)
            VALUES ('$academic_year', '$faculty_name', '$course_name', '$duration', '$start_date', '$end_date', '$percentage', '$top_percentage', '$remarks', '$certificate_link', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
