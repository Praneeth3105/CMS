<?php
include "db_conn.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

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
