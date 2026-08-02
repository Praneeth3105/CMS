<?php
include "db_conn.php";
session_start();

// table: paperpublications
// columns: id, faculty_name, title, journal, indexing_type, volume, number,
//          url_doi, academic_year, month, proof_link, faculty_id
// (no real date columns here, so there is nothing to compute)

if (isset($_POST['submit'])) {

    $faculty_id   = $_SESSION['id'];
    $faculty_name = $_SESSION['name'];

    $title          = mysqli_real_escape_string($conn, $_POST['title']);
    $journal        = mysqli_real_escape_string($conn, $_POST['journal']);
    $indexing_type  = mysqli_real_escape_string($conn, $_POST['indexing_type']);
    $volume         = mysqli_real_escape_string($conn, $_POST['volume']);
    $number         = mysqli_real_escape_string($conn, $_POST['number']);
    $url_doi        = mysqli_real_escape_string($conn, $_POST['url_doi']);
    $academic_year  = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $month          = mysqli_real_escape_string($conn, $_POST['month']);
    $proof_link     = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO paperpublications (faculty_id, faculty_name, title, journal, indexing_type, volume, number, url_doi, academic_year, month, proof_link)
            VALUES ('$faculty_id', '$faculty_name', '$title', '$journal', '$indexing_type', '$volume', '$number', '$url_doi', '$academic_year', '$month', '$proof_link')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }

    echo "<script>alert('Data Uploaded Successfully');window.location='add_record.php';</script>";
}
