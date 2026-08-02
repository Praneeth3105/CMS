<?php
include "db_conn.php";
session_start();
// table: professional_membership
// columns: id, faculty_name, membership_name, membership_id, membership_type,
//          start_date, end_date, proof_link   (no faculty_id, no academic_year column)
if (isset($_POST['submit'])) {
    $faculty_name    = $_SESSION['name'];
    $membership_name = mysqli_real_escape_string($conn, $_POST['membership_name']);
    $membership_id   = mysqli_real_escape_string($conn, $_POST['membership_id'] ?? '');
    $membership_type = mysqli_real_escape_string($conn, $_POST['membership_type']);
    $start_date      = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date        = mysqli_real_escape_string($conn, $_POST['end_date'] ?? '');
    $proof_link      = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO professional_membership (faculty_name, membership_name, membership_id, membership_type, start_date, end_date, proof_link)
            VALUES ('$faculty_name', '$membership_name', '$membership_id', '$membership_type', '$start_date', '$end_date', '$proof_link')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='add_record.php';</script>";
}
