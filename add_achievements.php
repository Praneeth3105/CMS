<?php
include "db_conn.php";
session_start();

// ===== GUARD: must be logged in =====
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
// =====================================

// table: achievements
// columns: id, academic_year, faculty_name, award_name, description, achievement_date,
//          organization, achievement_link, faculty_id
//
// NOTE: the original comment here said "no faculty_id column in this table",
// but fsearch.php filters this table with "WHERE faculty_id='$id'" — if that
// column truly didn't exist, that query would error out. Run
// `DESCRIBE achievements;` to confirm the column name/type before deploying
// this. If it turns out the column really doesn't exist yet, run:
//   ALTER TABLE achievements ADD faculty_id VARCHAR(100);

if (isset($_POST['submit'])) {
    $faculty_name      = $_SESSION['name'];
    $faculty_id        = $_SESSION['id'];
    $academic_year     = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $award_name        = mysqli_real_escape_string($conn, $_POST['award_name']);
    $description       = mysqli_real_escape_string($conn, $_POST['description']);
    $achievement_date  = mysqli_real_escape_string($conn, $_POST['achievement_date']);
    $organization      = mysqli_real_escape_string($conn, $_POST['organization']);
    $achievement_link  = mysqli_real_escape_string($conn, $_POST['achievement_link']);

    $sql = "INSERT INTO achievements (academic_year, faculty_name, award_name, description, achievement_date, organization, achievement_link, faculty_id)
            VALUES ('$academic_year', '$faculty_name', '$award_name', '$description', '$achievement_date', '$organization', '$achievement_link', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
