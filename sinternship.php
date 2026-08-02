<?php
include "db_conn.php";
session_start();
$_SESSION['cn'] = $_POST['cn'];
$_SESSION['tech'] = $_POST['tech'];
$_SESSION['sd'] = $_POST['sd'];
$_SESSION['ed'] = $_POST['ed'];
$_SESSION['dd'] = $_POST['dd'];
$_SESSION['accy'] = $_POST['acc'];
$_SESSION['paid'] = $_POST['paid'];
$_SESSION['tamount'] = $_POST['tamount'];
$filename = $_FILES["file"]["name"];
$tempname = $_FILES["file"]["tmp_name"];
$folder = "images/" . $filename;
$name = $_SESSION['name'];
$rollno = $_SESSION['username'];
$year = $_SESSION['year'];
$accy = $_SESSION['accy'];
$branch = $_SESSION['department'];
$counsular = $_SESSION['counsular'];
$classteacher = $_SESSION['classteacher'];
$cn = $_SESSION['cn'];
$dd = $_SESSION['dd'];
$tech = $_SESSION['tech'];
$sd = $_SESSION['sd'];
$ed = $_SESSION['ed'];
$paid = $_SESSION['paid'];
$amount = $_SESSION['tamount'];
$datetime1 = date_create($sd);
$datetime2 = date_create($ed);
$durt = date_diff($datetime1, $datetime2);
$durt = $durt->format('%m months, %d days');
if (isset($_POST['submit'])) {
    $sql = "INSERT INTO sinternship (name,rollno,companyname,branch,year,startdate,enddate,duration,amount,paid,tech,pic,counsular,classteacher,domain,academic_year) VALUES ('$name','$rollno','$cn','$branch','$year','$sd','$ed','$durt','$amount','$paid','$tech','$filename','$counsular','$classteacher','$dd','$accy')";
    // Execute query
    $res = mysqli_query($conn, $sql);
    if ($res and move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Uploaded Successfully');window.location='studentadd.php';</script>";
    } else {
        echo "<script>alert('Data not Uploaded')</script>";
    }
}
