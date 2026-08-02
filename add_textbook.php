<?php
include "db_conn.php";
session_start();
// table: textbook
// columns: id, academic_year, month, faculty_name, main_editor, textbook_name,
//          publisher_name, url   (no faculty_id column in this table)
if (isset($_POST['submit'])) {
    $faculty_name   = $_SESSION['name'];
    $academic_year  = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $month          = mysqli_real_escape_string($conn, $_POST['month']);
    $main_editor    = mysqli_real_escape_string($conn, $_POST['main_editor']);
    $textbook_name  = mysqli_real_escape_string($conn, $_POST['textbook_name']);
    $publisher_name = mysqli_real_escape_string($conn, $_POST['publisher_name']);
    $url            = mysqli_real_escape_string($conn, $_POST['url']);

    $sql = "INSERT INTO textbook (academic_year, month, faculty_name, main_editor, textbook_name, publisher_name, url)
            VALUES ('$academic_year', '$month', '$faculty_name', '$main_editor', '$textbook_name', '$publisher_name', '$url')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='add_record.php';</script>";
}
