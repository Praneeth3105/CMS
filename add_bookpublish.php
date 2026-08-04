<?php
include "db_conn.php";
session_start();

// ===== GUARD: must be logged in =====
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
// =====================================

// table: bookpublish
// columns: id, academic_year, month, faculty_name, no_of_authors, author_position,
//          title, publisher, scopus_sci, url, isbn, doi, proof_link, faculty_id

if (isset($_POST['submit'])) {
    $faculty_name    = $_SESSION['name'];
    $faculty_id      = $_SESSION['id'];
    $academic_year   = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $month           = mysqli_real_escape_string($conn, $_POST['month']);
    $no_of_authors   = mysqli_real_escape_string($conn, $_POST['no_of_authors']);
    $author_position = mysqli_real_escape_string($conn, $_POST['author_position']);
    $title           = mysqli_real_escape_string($conn, $_POST['title']);
    $publisher       = mysqli_real_escape_string($conn, $_POST['publisher']);
    $scopus_sci      = mysqli_real_escape_string($conn, $_POST['scopus_sci']);
    $url             = mysqli_real_escape_string($conn, $_POST['url']);
    $isbn            = mysqli_real_escape_string($conn, $_POST['isbn']);
    $doi             = mysqli_real_escape_string($conn, $_POST['doi']);
    $proof_link      = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO bookpublish (academic_year, month, faculty_name, no_of_authors, author_position, title, publisher, scopus_sci, url, isbn, doi, proof_link, faculty_id)
            VALUES ('$academic_year', '$month', '$faculty_name', '$no_of_authors', '$author_position', '$title', '$publisher', '$scopus_sci', '$url', '$isbn', '$doi', '$proof_link', '$faculty_id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
