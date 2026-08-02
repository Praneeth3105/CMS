<?php
include "db_conn.php";
session_start();
$_SESSION['ah'] = $_POST['ah'];
$_SESSION['oo'] = $_POST['oo'];
$_SESSION['sd'] = $_POST['sd'];
$_SESSION['ed'] = $_POST['ed'];
$_SESSION['pl'] = $_POST['pl'];

$name = $_SESSION['name'];
$id = $_SESSION['id'];
$year = $_SESSION['year'];
$department = $_SESSION['department'];
$ah = $_SESSION['ah'];
$oo = $_SESSION['oo'];
$sd = $_SESSION['sd'];
$ed = $_SESSION['ed'];
$pl = $_SESSION['pl'];
$filename = $_FILES["file"]["name"];
$tempname = $_FILES["file"]["tmp_name"];
$folder = "images/" . $filename;

$datetime1 = date_create($sd);
$datetime2 = date_create($ed);
$durt = date_diff($datetime1, $datetime2);
$durt = $durt->format('%m months, %d days');
if (isset($_POST['submit'])) {
    $sql = "INSERT INTO others (rollno,name,cname,ooffered,place,startdate,enddate,file,duration,faculty_id) VALUES ('$id','$name','$ah','$oo','$pl','$sd','$ed','$filename','$durt','$id')";
    $res = mysqli_query($conn, $sql);
    if (!$res) { die("SQL ERROR: " . mysqli_error($conn) . "<br>QUERY WAS: " . $sql); }
    if ($res and move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    } else {
        echo "<script>alert('Data not Uploaded');window.location='facultyadd.php';</script>";
    }
}
