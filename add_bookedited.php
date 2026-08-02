<?php
include "db_conn.php";
session_start();
// table: bookedited
// columns: id, faculty_name, no_of_authors, book_name, publisher_name, isbn_number,
//          url, academic_year, month, proof_link, faculty_id
if (isset($_POST['submit'])) {
    $faculty_name   = $_SESSION['name'];
    $faculty_id     = $_SESSION['id'];
    $no_of_authors  = mysqli_real_escape_string($conn, $_POST['no_of_authors']);
    $book_name      = mysqli_real_escape_string($conn, $_POST['book_name']);
    $publisher_name = mysqli_real_escape_string($conn, $_POST['publisher_name']);
    $isbn_number    = mysqli_real_escape_string($conn, $_POST['isbn_number']);
    $url            = mysqli_real_escape_string($conn, $_POST['url']);
    $academic_year  = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $month          = mysqli_real_escape_string($conn, $_POST['month']);
    $proof_link     = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO bookedited (faculty_name, no_of_authors, book_name, publisher_name, isbn_number, url, academic_year, month, proof_link, faculty_id)
            VALUES ('$faculty_name', '$no_of_authors', '$book_name', '$publisher_name', '$isbn_number', '$url', '$academic_year', '$month', '$proof_link', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
}
