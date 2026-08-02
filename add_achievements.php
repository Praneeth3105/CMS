<?php
include "db_conn.php";
session_start();
// table: achievements
// columns: id, academic_year, faculty_name, award_name, description, achievement_date,
//          organization, achievement_link   (no faculty_id column in this table)
if (isset($_POST['submit'])) {
    $faculty_name      = $_SESSION['name'];
    $academic_year     = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $award_name        = mysqli_real_escape_string($conn, $_POST['award_name']);
    $description       = mysqli_real_escape_string($conn, $_POST['description']);
    $achievement_date  = mysqli_real_escape_string($conn, $_POST['achievement_date']);
    $organization      = mysqli_real_escape_string($conn, $_POST['organization']);
    $achievement_link  = mysqli_real_escape_string($conn, $_POST['achievement_link']);

    $sql = "INSERT INTO achievements (academic_year, faculty_name, award_name, description, achievement_date, organization, achievement_link)
            VALUES ('$academic_year', '$faculty_name', '$award_name', '$description', '$achievement_date', '$organization', '$achievement_link')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
}
