<?php
include "db_conn.php";
session_start();

// ===== GUARD: must be logged in =====
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
// =====================================

// table: funding_projects
// columns: id, academic_year, faculty_name, title, agency_name, amount, start_date,
//          end_date, duration, funding_type, faculty_id
//
// NOTE: comment said "no faculty_id column", but fsearch.php filters this
// table with "WHERE faculty_id='$id'". Run `DESCRIBE funding_projects;`
// to confirm. If missing: ALTER TABLE funding_projects ADD faculty_id VARCHAR(100);

if (isset($_POST['submit'])) {
    $faculty_name  = $_SESSION['name'];
    $faculty_id    = $_SESSION['id'];
    $academic_year = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $title         = mysqli_real_escape_string($conn, $_POST['title']);
    $agency_name   = mysqli_real_escape_string($conn, $_POST['agency_name']);
    $amount        = mysqli_real_escape_string($conn, $_POST['amount']);
    $start_date    = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date      = mysqli_real_escape_string($conn, $_POST['end_date']);
    $duration      = mysqli_real_escape_string($conn, $_POST['duration']);
    $funding_type  = mysqli_real_escape_string($conn, $_POST['funding_type']);

    $sql = "INSERT INTO funding_projects (academic_year, faculty_name, title, agency_name, amount, start_date, end_date, duration, funding_type, faculty_id)
            VALUES ('$academic_year', '$faculty_name', '$title', '$agency_name', '$amount', '$start_date', '$end_date', '$duration', '$funding_type', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
