<?php
    include "db_conn.php";
    session_start();
    $_SESSION['ni'] = $_POST['ni'];
    $_SESSION['nc'] = $_POST['nc'];
    $_SESSION['sd'] = $_POST['sd'];
    $_SESSION['ed'] = $_POST['ed'];
    $_SESSION['ay'] = $_POST['ay'];
$_SESSION['acc'] = $_POST['acc'];
    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "images/".$filename;  
    $name=$_SESSION['name'];
    $rollno=$_SESSION['username'];
    $year=$_SESSION['year'];	
    $branch=$_SESSION['department'];
    $counsular=$_SESSION['counsular'];
    $classteacher=$_SESSION['classteacher'];
    $ni=$_SESSION['ni'];
    $nc=$_SESSION['nc'];
    $sd=$_SESSION['sd'];
    $ed=$_SESSION['ed'];
    $ay=$_SESSION['ay'];
$acc=$_SESSION['acc'];
$acc=$_SESSION['acc'];
    $datetime1 = date_create($sd);
$datetime2 = date_create($ed);
$durt = date_diff($datetime1, $datetime2);
$durt=$durt->format('%m months, %d days');
if(isset($_POST['submit'])){
    $sql = "INSERT INTO course (RollNo,Name,CourseName,OrganisationName,StartDate,Enddate,Duration,year,file,branch,counsular,classteacher,academicyear) VALUES ('$rollno','$name','$nc','$ni','$sd','$ed','$durt','$year','$filename','$branch','$counsular','$classteacher','$acc')";
    // Execute query
    $res=mysqli_query($conn, $sql);
    if($res and move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Uploaded Successfully');window.location='studentadd.php';</script>";
       
    }else{
        echo "<script>alert('Data not Uploaded')</script>";
    }
      
}
?>