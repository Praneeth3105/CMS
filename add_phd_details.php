<?php
include "db_conn.php";
session_start();

// ===== GUARD: must be logged in =====
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
// =====================================

// table: phd_details
// columns: id, faculty_name, university_name, status, domain_name,
//          date_of_completion, pursuing_year, proof_link, faculty_id
//
// NOTE: comment said "no faculty_id column", but fsearch.php filters this
// table with "WHERE faculty_id='$id'". Run `DESCRIBE phd_details;` to
// confirm. If missing: ALTER TABLE phd_details ADD faculty_id VARCHAR(100);

if (isset($_POST['submit'])) {
    $faculty_name       = $_SESSION['name'];
    $faculty_id         = $_SESSION['id'];
    $university_name    = mysqli_real_escape_string($conn, $_POST['university_name']);
    $status             = mysqli_real_escape_string($conn, $_POST['status']);
    $domain_name        = mysqli_real_escape_string($conn, $_POST['domain_name']);
    $date_of_completion = mysqli_real_escape_string($conn, $_POST['date_of_completion'] ?? '');
    $pursuing_year      = mysqli_real_escape_string($conn, $_POST['pursuing_year'] ?? '');
    $proof_link         = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO phd_details (faculty_name, university_name, status, domain_name, date_of_completion, pursuing_year, proof_link, faculty_id)
            VALUES ('$faculty_name', '$university_name', '$status', '$domain_name', '$date_of_completion', '$pursuing_year', '$proof_link', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
