<?php
include "db_conn.php";
session_start();

// table: fdporg
// columns: id, academic_year, faculty_name, fdp_name, association, mode,
//          start_date, end_date, dates_raw, duration, certificate_link, faculty_id

if (isset($_POST['submit'])) {

    $faculty_id   = $_SESSION['id'];
    $faculty_name = $_SESSION['name'];

    $academic_year    = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $fdp_name         = mysqli_real_escape_string($conn, $_POST['fdp_name']);
    $association      = mysqli_real_escape_string($conn, $_POST['association']);
    $mode             = mysqli_real_escape_string($conn, $_POST['mode']);
    $start_date       = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date         = mysqli_real_escape_string($conn, $_POST['end_date']);
    $dates_raw        = mysqli_real_escape_string($conn, $_POST['dates_raw']);
    $certificate_link = mysqli_real_escape_string($conn, $_POST['certificate_link']);

    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $datetime1 = date_create($start_date);
    $datetime2 = date_create($end_date);
    if ($datetime1 && $datetime2) {
        $diff = date_diff($datetime1, $datetime2);
        $duration = $diff->format('%m months, %d days');
    }

    $sql = "INSERT INTO fdporg (faculty_id, academic_year, faculty_name, fdp_name, association, mode, start_date, end_date, dates_raw, duration, certificate_link)
            VALUES ('$faculty_id', '$academic_year', '$faculty_name', '$fdp_name', '$association', '$mode', '$start_date', '$end_date', '$dates_raw', '$duration', '$certificate_link')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }

    echo "<script>alert('Data Uploaded Successfully');window.location='add_record.php';</script>";
}
