<?php
include "db_conn.php";
session_start();

// table: conferences
// columns: id, academic_year, faculty_name, co_authors_count, author_type,
//          paper_title, conference_proceedings, ugc_scopus, url, doi,
//          proof_link, created_at (auto-filled by MySQL, no need to insert it)

if (isset($_POST['submit'])) {

    $faculty_name = $_SESSION['name'];

    $academic_year          = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $co_authors_count       = mysqli_real_escape_string($conn, $_POST['co_authors_count']);
    $author_type            = mysqli_real_escape_string($conn, $_POST['author_type']);
    $paper_title            = mysqli_real_escape_string($conn, $_POST['paper_title']);
    $conference_proceedings = mysqli_real_escape_string($conn, $_POST['conference_proceedings']);
    $ugc_scopus             = mysqli_real_escape_string($conn, $_POST['ugc_scopus']);
    $url                    = mysqli_real_escape_string($conn, $_POST['url']);
    $doi                    = mysqli_real_escape_string($conn, $_POST['doi']);
    $proof_link             = mysqli_real_escape_string($conn, $_POST['proof_link']);

    $sql = "INSERT INTO conferences (academic_year, faculty_name, co_authors_count, author_type, paper_title, conference_proceedings, ugc_scopus, url, doi, proof_link)
            VALUES ('$academic_year', '$faculty_name', '$co_authors_count', '$author_type', '$paper_title', '$conference_proceedings', '$ugc_scopus', '$url', '$doi', '$proof_link')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }

    echo "<script>alert('Data Uploaded Successfully');window.location='add_record.php';</script>";
}
