<?php
include "db_conn.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $faculty_name   = $_SESSION['name'];
    $faculty_id     = $_SESSION['id'];
    $academic_year  = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $month          = mysqli_real_escape_string($conn, $_POST['month']);
    $main_editor    = mysqli_real_escape_string($conn, $_POST['main_editor']);
    $textbook_name  = mysqli_real_escape_string($conn, $_POST['textbook_name']);
    $publisher_name = mysqli_real_escape_string($conn, $_POST['publisher_name']);
    $url            = mysqli_real_escape_string($conn, $_POST['url']);

    $sql = "INSERT INTO textbook (academic_year, month, faculty_name, main_editor, textbook_name, publisher_name, url, faculty_id)
            VALUES ('$academic_year', '$month', '$faculty_name', '$main_editor', '$textbook_name', '$publisher_name', '$url', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
