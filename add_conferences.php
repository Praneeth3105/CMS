<?php
include "db_conn.php";
session_start();

// ===== GUARD: must be logged in =====
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
// =====================================

// table: conferences
// columns: id, academic_year, faculty_name, co_authors_count, author_type,
//          paper_title, conference_proceedings, ugc_scopus, url, doi,
//          proof_link, faculty_id, created_at (auto-filled by MySQL, no need to insert it)
//
// FIXED: this file never captured or inserted faculty_id at all, even
// though it has a faculty_id column and your fsearch.php page filters
// this table with "WHERE faculty_id='$id'". Every conference record
// submitted through the old version of this file would have an empty
// faculty_id and silently never appear for ANY faculty in the listing
// page. That is now fixed below.

if (isset($_POST['submit'])) {

    $faculty_id   = $_SESSION['id'];
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

    $sql = "INSERT INTO conferences (faculty_id, academic_year, faculty_name, co_authors_count, author_type, paper_title, conference_proceedings, ugc_scopus, url, doi, proof_link)
            VALUES ('$faculty_id', '$academic_year', '$faculty_name', '$co_authors_count', '$author_type', '$paper_title', '$conference_proceedings', '$ugc_scopus', '$url', '$doi', '$proof_link')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }

    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
