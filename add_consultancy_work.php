<?php
include "db_conn.php";
session_start();

// ===== GUARD: must be logged in =====
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
// =====================================

// table: consultancy_work
//
// IMPORTANT: this is the table your fsearch.php page already explicitly
// flagged with a warning: "this table has NO faculty_id / faculty_name
// column at all in your schema... showing ALL faculty". This is the one
// case where that warning is NOT contradicted elsewhere, so it should be
// taken at face value. Run this first:
//
//   ALTER TABLE consultancy_work ADD faculty_id VARCHAR(100);
//
// (optionally also ADD faculty_name VARCHAR(100) if you want the name
// displayed directly instead of joined from the faculty table). After
// that, the INSERT below will start correctly scoping new records. Old
// rows already in the table will still have faculty_id = NULL and will
// need manual backfill or will need to stay globally visible.

if (isset($_POST['submit'])) {
    $faculty_id        = $_SESSION['id'];
    $faculty_name       = $_SESSION['name'];
    $academic_year     = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $description       = mysqli_real_escape_string($conn, $_POST['description']);
    $organization      = mysqli_real_escape_string($conn, $_POST['organization']);
    $amount            = mysqli_real_escape_string($conn, $_POST['amount']);
    $start_date        = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date          = mysqli_real_escape_string($conn, $_POST['end_date']);
    $duration          = mysqli_real_escape_string($conn, $_POST['duration']);
    $students_involved = mysqli_real_escape_string($conn, $_POST['students_involved'] ?? '');
    $proof_link        = mysqli_real_escape_string($conn, $_POST['proof_link']);

    // NOTE: this assumes faculty_id (and faculty_name) columns now exist
    // after running the ALTER TABLE above. If you haven't run it yet,
    // remove faculty_id/faculty_name from both the column list and the
    // VALUES list below or this INSERT will fail with an SQL error.
    $sql = "INSERT INTO consultancy_work (academic_year, description, organization, amount, start_date, end_date, duration, students_involved, proof_link, faculty_id, faculty_name)
            VALUES ('$academic_year', '$description', '$organization', '$amount', '$start_date', '$end_date', '$duration', '$students_involved', '$proof_link', '$faculty_id', '$faculty_name')";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    exit;
}
