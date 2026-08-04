<?php
include "db_conn.php";
session_start();

// ===== GUARD: must be logged in =====
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
// =====================================

// table: patents
// columns: id, academic_year, month, faculty_name, patent_details, area_of_patent,
//          application_number, status, patent_type, filing_agency, proof_link, faculty_id
//
// NOTE: the original comment said "no faculty_id column in this table",
// but fsearch.php filters this table with "WHERE faculty_id='$id'". Run
// `DESCRIBE patents;` to confirm before deploying. If the column really
// doesn't exist:
//   ALTER TABLE patents ADD faculty_id VARCHAR(100);

if (isset($_POST['submit'])) {
    $faculty_name       = $_SESSION['name'];
    $faculty_id         = $_SESSION['id'];
    $academic_year      = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $month              = mysqli_real_escape_string($conn, $_POST['month']);
    $patent_details     = mysqli_real_escape_string($conn, $_POST['patent_details']);
    $area_of_patent     = mysqli_real_escape_string($conn, $_POST['area_of_patent']);
    $application_number = mysqli_real_escape_string($conn, $_POST['application_number']);
    $status             = mysqli_real_escape_string($conn, $_POST['status']);
    $patent_type        = mysqli_real_escape_string($conn, $_POST['patent_type']);
    $filing_agency      = mysqli_real_escape_string($conn, $_POST['filing_agency']);
    $proof_link         = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO patents (academic_year, month, faculty_name, patent_details, area_of_patent, application_number, status, patent_type, filing_agency, proof_link, faculty_id)
            VALUES ('$academic_year', '$month', '$faculty_name', '$patent_details', '$area_of_patent', '$application_number', '$status', '$patent_type', '$filing_agency', '$proof_link', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
