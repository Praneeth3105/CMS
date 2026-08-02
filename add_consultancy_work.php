<?php
include "db_conn.php";
session_start();
// table: consultancy_work
// columns: id, academic_year, description, organization, amount, start_date, end_date,
//          duration, students_involved, proof_link
//          (no faculty_name / faculty_id column in this table)
if (isset($_POST['submit'])) {
    $academic_year     = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $description       = mysqli_real_escape_string($conn, $_POST['description']);
    $organization      = mysqli_real_escape_string($conn, $_POST['organization']);
    $amount            = mysqli_real_escape_string($conn, $_POST['amount']);
    $start_date        = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date          = mysqli_real_escape_string($conn, $_POST['end_date']);
    $duration          = mysqli_real_escape_string($conn, $_POST['duration']);
    $students_involved = mysqli_real_escape_string($conn, $_POST['students_involved'] ?? '');
    $proof_link        = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO consultancy_work (academic_year, description, organization, amount, start_date, end_date, duration, students_involved, proof_link)
            VALUES ('$academic_year', '$description', '$organization', '$amount', '$start_date', '$end_date', '$duration', '$students_involved', '$proof_link')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
}
