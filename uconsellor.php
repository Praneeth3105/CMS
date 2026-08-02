<?php

include "db_conn.php";
session_start();
$_SESSION['faculty'] = $_POST['faculty'];
$_SESSION['check'] = $_POST['check'];

$faculty = $_SESSION['faculty'];
$check = $_SESSION['check'];
$un = $_SESSION['un'];

if (isset($_POST['submit'])) {
    if (isset($_POST['check'])) {
        foreach ($check as $update) {
            $r = mysqli_query($conn, "UPDATE studentdetails SET counsular = '$faculty' WHERE username='$update';");
            $r1 = mysqli_query($conn, "UPDATE sworkshop SET counsular = '$faculty' WHERE RollNo='$update';");
            $r2 = mysqli_query($conn, "UPDATE sinternship SET counsular = '$faculty' WHERE rollno='$update';");
            $r3 = mysqli_query($conn, "UPDATE sproject SET counsular = '$faculty' WHERE Roll_Number='$update';");
            $r4 = mysqli_query($conn, "UPDATE extracircular SET counsular = '$faculty' WHERE rollno='$update';");
            $r5 = mysqli_query($conn, "UPDATE cocircular SET counsular = '$faculty' WHERE rollno='$update';");
            $r6 = mysqli_query($conn, "UPDATE course SET counsular = '$faculty' WHERE RollNo='$update';");
            if ($r) {
                echo "<script>alert('Data Uploaded Successfully');window.location='counsellor.php';</script>";
            }
            if ($r1) {
                echo "<script>alert('Data Uploaded Successfully');window.location='counsellor.php';</script>";
            }
            if ($r2) {
                echo "<script>alert('Data Uploaded Successfully');window.location='counsellor.php';</script>";
            }
            if ($r3) {
                echo "<script>alert('Data Uploaded Successfully');window.location='counsellor.php';</script>";
            }
            if ($r4) {
                echo "<script>alert('Data Uploaded Successfully');window.location='counsellor.php';</script>";
            }
            if ($r5) {
                echo "<script>alert('Data Uploaded Successfully');window.location='counsellor.php';</script>";
            }
            if ($r6) {
                echo "<script>alert('Data Uploaded Successfully');window.location='counsellor.php';</script>";
            } else {
                echo "<script>alert('Data not Uploaded');window.location='counsellor.php';</script>";
            }
        }
    }
}
