<?php
    include "db_conn.php";
    session_start();
    $_SESSION['nevent'] = $_POST['nevent'];
    $_SESSION['condclg'] = $_POST['condclg'];
    $_SESSION['conorg'] = $_POST['conorg'];
    $_SESSION['dates'] = $_POST['dates'];
    $_SESSION['ie'] = $_POST['ie'];
    $_SESSION['ay'] = $_POST['ay'];
$_SESSION['acc'] = $_POST['acc'];

    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "images/".$filename;  
    $name=$_SESSION['name'];
    $rollno=$_SESSION['username'];
    $year=$_SESSION['year'];
$acc=$_SESSION['acc'];
    $branch=$_SESSION['department'];
    $counsular=$_SESSION['counsular'];
    $classteacher=$_SESSION['classteacher'];	
    $nevent=$_SESSION['nevent'];
    $condclg=$_SESSION['condclg'];
    $conorg=$_SESSION['conorg'];
    $dates=$_SESSION['dates'];
    $ie=$_SESSION['ie'];
    $ay=$_SESSION['ay'];

if(isset($_POST['submit'])){
    $sql = "INSERT INTO extracircular (name,rollno,year,branch,eventname,conductingclg,orgname,dates,ie,academic_year,file,counsular,classteacher) VALUES ('$name','$rollno','$year','$branch','$nevent','$condclg','$conorg','$dates','$ie','$acc','$filename','$counsular','$classteacher')";
    // Execute query
    $res=mysqli_query($conn, $sql);
    if($res and move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Uploaded Successfully');window.location='studentadd.php';</script>";
        
    }else{
        echo "<script>alert('Data not Uploaded')</script>";
    }
      
}
?>