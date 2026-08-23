<?php
include "db_conn.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
if (isset($_POST['submit'])) {
    $faculty_name             = $_SESSION['name'];
    $faculty_id               = $_SESSION['id'];
    $academic_year            = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $month                    = mysqli_real_escape_string($conn, $_POST['month']);
    $date_attended            = mysqli_real_escape_string($conn, $_POST['date_attended']);
    $organization             = mysqli_real_escape_string($conn, $_POST['organization']);
    $conference_journal_name  = mysqli_real_escape_string($conn, $_POST['conference_journal_name']);
    $type                     = mysqli_real_escape_string($conn, $_POST['type']);
    $proof_link               = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO reviewer_activities (academic_year, month, faculty_name, date_attended, organization, conference_journal_name, type, proof_link, faculty_id)
            VALUES ('$academic_year', '$month', '$faculty_name', '$date_attended', '$organization', '$conference_journal_name', '$type', '$proof_link', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
