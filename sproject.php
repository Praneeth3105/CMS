<?php
    include "db_conn.php";
    session_start();
    $_SESSION['tname'] = $_POST['tname'];
    $_SESSION['bnum'] = $_POST['bnum'];
    $_SESSION['ac'] = $_POST['ac'];
$_SESSION['accy'] = $_POST['acc'];
    $_SESSION['link'] = $_POST['link']; 
    $name=$_SESSION['name'];
    $rollno=$_SESSION['username'];
    $year=$_SESSION['year'];
$acc=$_SESSION['academic_year'];	
    $branch=$_SESSION['department'];
    $counsular=$_SESSION['counsular'];
    $classteacher=$_SESSION['classteacher'];
    $tname=$_SESSION['tname'];
    $bnum=$_SESSION['bnum'];
    $ac=$_SESSION['ac'];
    $link=$_SESSION['link'];
$accy=$_SESSION['accy'];

if(isset($_POST['submit'])){
    $sql = "INSERT INTO sproject (Team_Number,Roll_Number,Name,Project_title,year,Drive_link,branch,counsular,classteacher,academicyear) VALUES ('$bnum','$rollno','$name','$tname','$year','$link','$branch','$counsular','$classteacher','$accy')";
    // Execute query
    $res=mysqli_query($conn, $sql);
    if($res) {
        echo "<script>alert('Data Uploaded Successfully');window.location='studentadd.php';</script>";
        
    }else{
        echo "<script>alert('Data not Uploaded')</script>";
    }
      
}
?>