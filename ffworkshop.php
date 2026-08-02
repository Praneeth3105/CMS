<?php
include "db_conn.php";
session_start();
$_SESSION['wn'] = $_POST['wn'];
$_SESSION['org'] = $_POST['org'];
$_SESSION['sd'] = $_POST['sd'];
$_SESSION['ed'] = $_POST['ed'];
$_SESSION['ed'] = $_POST['ed'];
$_SESSION['q1'] = $_POST['q1'];
$_SESSION['place'] = $_POST['place'];
$_SESSION['title'] = $_POST['title'];
$filename = $_FILES["file"]["name"];
$tempname = $_FILES["file"]["tmp_name"];
$folder = "images/" . $filename;
$name = $_SESSION['name'];
$id = $_SESSION['id'];
$q1 = $_SESSION['q1'];
$title = $_SESSION['title'];
$department = $_SESSION['department'];
$wn = $_SESSION['wn'];
$org = $_SESSION['org'];
$sd = $_SESSION['sd'];
$ed = $_SESSION['ed'];
$place = $_SESSION['place'];
$datetime1 = date_create($sd);
$datetime2 = date_create($ed);
$durt = date_diff($datetime1, $datetime2);
$durt = $durt->format('%m months, %d days');

if (isset($_POST['submit'])) {
    $sql = "INSERT INTO ffworkshop
(name,faculty_id,department,workshopn,title,org,place,duration,type,startdate,enddate,file)
VALUES
('$name','$id','$department','$wn','$title','$org','$place','$durt','$q1','$sd','$ed','$filename')";
    // Execute query
    $res = mysqli_query($conn, $sql);
    if ($res and move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Uploaded Successfully');window.location='facultyadd.php';</script>";
    } else {
        echo "<script>alert('Data not Uploaded')</script>";
    }
}
