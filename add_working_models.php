<?php
include "db_conn.php";
session_start();

// ===== GUARD: must be logged in =====
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $faculty_id     = $_SESSION['id'];
    $faculty_name   = $_SESSION['name'];
    $academic_year  = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $model_name     = mysqli_real_escape_string($conn, $_POST['model_name']);
    $duration       = mysqli_real_escape_string($conn, $_POST['duration']);
    $students_count = mysqli_real_escape_string($conn, $_POST['students_count']);
    $domain_name    = mysqli_real_escape_string($conn, $_POST['domain_name']);
    $proof_link     = mysqli_real_escape_string($conn, $_POST['proof_link']);

    // NOTE: this INSERT assumes faculty_id (and optionally faculty_name)
    // columns exist. Remove them from both the column list and VALUES
    // list below if DESCRIBE shows they don't exist yet.
    $sql = "INSERT INTO working_models (academic_year, model_name, duration, students_count, domain_name, proof_link, faculty_id)
            VALUES ('$academic_year', '$model_name', '$duration', '$students_count', '$domain_name', '$proof_link', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
