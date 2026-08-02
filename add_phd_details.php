<?php
include "db_conn.php";
session_start();
// table: phd_details
// columns: id, faculty_name, university_name, status, domain_name,
//          date_of_completion, pursuing_year, proof_link   (no faculty_id, no academic_year)
if (isset($_POST['submit'])) {
    $faculty_name       = $_SESSION['name'];
    $university_name    = mysqli_real_escape_string($conn, $_POST['university_name']);
    $status             = mysqli_real_escape_string($conn, $_POST['status']);
    $domain_name        = mysqli_real_escape_string($conn, $_POST['domain_name']);
    $date_of_completion = mysqli_real_escape_string($conn, $_POST['date_of_completion'] ?? '');
    $pursuing_year      = mysqli_real_escape_string($conn, $_POST['pursuing_year'] ?? '');
    $proof_link         = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO phd_details (faculty_name, university_name, status, domain_name, date_of_completion, pursuing_year, proof_link)
            VALUES ('$faculty_name', '$university_name', '$status', '$domain_name', '$date_of_completion', '$pursuing_year', '$proof_link')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
}
