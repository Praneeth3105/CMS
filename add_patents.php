<?php
include "db_conn.php";
session_start();
// table: patents
// columns: id, academic_year, month, faculty_name, patent_details, area_of_patent,
//          application_number, status, patent_type, filing_agency, proof_link
//          (no faculty_id column in this table)
if (isset($_POST['submit'])) {
    $faculty_name       = $_SESSION['name'];
    $academic_year      = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $month              = mysqli_real_escape_string($conn, $_POST['month']);
    $patent_details     = mysqli_real_escape_string($conn, $_POST['patent_details']);
    $area_of_patent     = mysqli_real_escape_string($conn, $_POST['area_of_patent']);
    $application_number = mysqli_real_escape_string($conn, $_POST['application_number']);
    $status             = mysqli_real_escape_string($conn, $_POST['status']);
    $patent_type        = mysqli_real_escape_string($conn, $_POST['patent_type']);
    $filing_agency      = mysqli_real_escape_string($conn, $_POST['filing_agency']);
    $proof_link         = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO patents (academic_year, month, faculty_name, patent_details, area_of_patent, application_number, status, patent_type, filing_agency, proof_link)
            VALUES ('$academic_year', '$month', '$faculty_name', '$patent_details', '$area_of_patent', '$application_number', '$status', '$patent_type', '$filing_agency', '$proof_link')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='add_record.php';</script>";
}
