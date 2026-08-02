<?php
include "db_conn.php";
session_start();

$_SESSION['q1']  = $_POST['q1'];
$_SESSION['n']   = $_POST['n'];
$_SESSION['m']   = $_POST['m'];
$_SESSION['t']   = $_POST['t'];
$_SESSION['f']   = $_POST['f'];
$_SESSION['iss'] = $_POST['iss'];
$_SESSION['d']   = $_POST['d'];
$_SESSION['v']   = $_POST['v'];
$_SESSION['in']  = $_POST['in'];
$_SESSION['u']   = $_POST['u'];

$name       = $_SESSION['name'];
$id         = $_SESSION['id'];       // faculty_id
$department = $_SESSION['department'];

$q1  = $_SESSION['q1'];
$n   = $_SESSION['n'];
$m   = $_SESSION['m'];
$t   = $_SESSION['t'];
$f   = $_SESSION['f'];
$iss = $_SESSION['iss'];
$d   = $_SESSION['d'];
$v   = $_SESSION['v'];
$in  = $_SESSION['in'];
$u   = $_SESSION['u'];

$filename = $_FILES["file"]["name"];
$tempname = $_FILES["file"]["tmp_name"];
$folder   = "images/" . $filename;

if (isset($_POST['submit'])) {
    $sql = "INSERT INTO bookpublish 
            (faculty_id, name, authorship_position, title, journal, type, publication_type, issn, date, volume, issue, url, file)
            VALUES 
            ('$id', '$name', '$q1', '$n', '$m', '$t', '$f', '$iss', '$d', '$v', '$in', '$u', '$filename')";

    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("SQL ERROR: " . mysqli_error($conn));
    }
    if (move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    } else {
        echo "<script>alert('File upload failed')</script>";
    }
}
?>