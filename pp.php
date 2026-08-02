<?php
include "db_conn.php";
session_start();
$_SESSION['q1'] = $_POST['q1'];
$_SESSION['n'] = $_POST['n'];
$_SESSION['m'] = $_POST['m'];
$_SESSION['t'] = $_POST['t'];
$_SESSION['f'] = $_POST['f'];
$_SESSION['iss'] = $_POST['iss'];
$_SESSION['d'] = $_POST['d'];
$_SESSION['v'] = $_POST['v'];
$_SESSION['in'] = $_POST['in'];
$_SESSION['u'] = $_POST['u'];
$_SESSION['i'] = $_POST['i'];


$name = $_SESSION['name'];
$rollno = $_SESSION['rollno'];
$department = $_SESSION['department'];
$id = $_SESSION['id'];
$q1 = $_SESSION['q1'];
$n = $_SESSION['n'];
$m = $_SESSION['m'];
$t = $_SESSION['t'];
$f = $_SESSION['f'];
$i = $_SESSION['i'];
$v = $_SESSION['v'];
$in = $_SESSION['in'];
$u = $_SESSION['u'];
$iss = $_SESSION['iss'];
$d = $_SESSION['d'];
$filename = $_FILES["file"]["name"];
$tempname = $_FILES["file"]["tmp_name"];
$folder = "images/" . $filename;

if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $sql = "INSERT INTO paperpublications
(authorship_position,title,journal,type,publication_type,issn,date,volume,issue,url,file,name,faculty_id)
VALUES
('$q1','$n','$m','$t','$f','$iss','$d','$v','$in','$u','$filename','$name','$id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) { die("SQL ERROR: " . mysqli_error($conn) . "<br>QUERY WAS: " . $sql); }
    if ($res and move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    } else {
        echo "<script>alert('Data not Uploaded')</script>";
    }
}
