<?php
include "db_conn.php";
session_start();

// table: fdp
// columns: id, name, department, fdpname, org, mode, duration, startdate, enddate, certificate_link, faculty_id
// (name, department, faculty_id come from the session — NOT from the form)

if (isset($_POST['submit'])) {

    $id         = $_SESSION['id'];
    $name       = $_SESSION['name'];
    $department = $_SESSION['department'];

    $fdpname          = mysqli_real_escape_string($conn, $_POST['fdpname']);
    $org              = mysqli_real_escape_string($conn, $_POST['org']);
    $mode             = mysqli_real_escape_string($conn, $_POST['mode']);
    $startdate        = mysqli_real_escape_string($conn, $_POST['startdate']);
    $enddate          = mysqli_real_escape_string($conn, $_POST['enddate']);
    $certificate_link = mysqli_real_escape_string($conn, $_POST['certificate_link']);

    // duration is stored in the table, but we can also recompute it from the dates
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $datetime1 = date_create($startdate);
    $datetime2 = date_create($enddate);
    if ($datetime1 && $datetime2) {
        $diff = date_diff($datetime1, $datetime2);
        $duration = $diff->format('%m months, %d days');
    }

    $sql = "INSERT INTO fdp (faculty_id, name, department, fdpname, org, mode, duration, startdate, enddate, certificate_link)
            VALUES ('$id', '$name', '$department', '$fdpname', '$org', '$mode', '$duration', '$startdate', '$enddate', '$certificate_link')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }

    echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
}
