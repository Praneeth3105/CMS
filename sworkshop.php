 <?php
    include "db_conn.php";
    session_start();
    $_SESSION['wn'] = $_POST['wn'];
    $_SESSION['org'] = $_POST['org'];
    $_SESSION['sd'] = $_POST['sd'];
    $_SESSION['ed'] = $_POST['ed'];
    $_SESSION['place'] = $_POST['place'];
    $_SESSION['ay'] = $_POST['ay'];
    $_SESSION['accy'] = $_POST['accy'];
    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "images/".$filename;  
    $name=$_SESSION['name'];
    $rollno=$_SESSION['username'];
    $year=$_SESSION['year'];
$accy=$_SESSION['academic_year'];
    $branch=$_SESSION['department'];
    $counsular=$_SESSION['counsular'];
    $classteacher=$_SESSION['classteacher'];	
    $wn=$_SESSION['wn'];
    $org=$_SESSION['org'];
    $sd=$_SESSION['sd'];
    $ed=$_SESSION['ed'];
    $place=$_SESSION['place'];
    $ay=$_SESSION['ay'];
   $accy=$_SESSION['accy'];
    $datetime1 = date_create($sd);
$datetime2 = date_create($ed);
$durt = date_diff($datetime1, $datetime2);
$durt=$durt->format('%m months, %d days');
if(isset($_POST['submit'])){
    $sql = "INSERT INTO sworkshop (RollNo,Name,WorkShopName,OrgName,StartDate,EndDate,Duration,Place,file,branch,year,counsular,classteacher,academic_year) VALUES ('$rollno','$name','$wn','$org','$sd','$ed','$durt','$place','$filename','$branch','$year','$counsular','$classteacher','$accy')";
    // Execute query
    $res=mysqli_query($conn, $sql);
    if($res and move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Uploaded Successfully');window.location='studentadd.php';</script>";
        
    }else{
        echo "<script>alert('Data not Uploaded')</script>";
    }
      
}
?>