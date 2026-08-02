<?php
include "db_conn.php";
session_start();
// table: working_models
// columns: id, academic_year, model_name, duration, students_count, domain_name, proof_link
//          (no faculty_name / faculty_id column in this table)
if (isset($_POST['submit'])) {
    $academic_year  = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $model_name     = mysqli_real_escape_string($conn, $_POST['model_name']);
    $duration       = mysqli_real_escape_string($conn, $_POST['duration']);
    $students_count = mysqli_real_escape_string($conn, $_POST['students_count']);
    $domain_name    = mysqli_real_escape_string($conn, $_POST['domain_name']);
    $proof_link     = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO working_models (academic_year, model_name, duration, students_count, domain_name, proof_link)
            VALUES ('$academic_year', '$model_name', '$duration', '$students_count', '$domain_name', '$proof_link')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='add_record.php';</script>";
}
