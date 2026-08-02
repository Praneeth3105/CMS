<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/x-icon" href="icon2.png">
	<title>CERTIFICATE MAINTANCE SYSTEM</title>
	<link rel="stylesheet" href="style2.css">
	<link rel="stylesheet" href="style1.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
.n{
    text-decoration: none;
}
#btn1{
	float: right;
 
}
#btn1{
    width: 10%;
}
#btn2{
    width: 10%;
    float: left;
}
h3{
    display: inline-block;
    margin-top: 1%;
}
.info{
    margin-left: 30%;
}
body{
    overflow-y: scroll;
  
}
.note {
  width: 100%;
}
#note1 {
 margin-left:40%;
text-align: center;
}
select{
	background-color: #2AC48F;
	color: black;
}
@media only screen and (max-width: 900px) {
   #btn1, #btn2{
    width: 30%;
   } 
   .info{
    margin-left: 20%;
}

}
	</style>
</head>
<body>
    <a href="logout.php" class="n" ><button type="button" class="btn" id="btn1" >Logout</button></a>
    <a href="ssearch.php" class="n" ><button type="button" class="btn" id="btn2" >Back</button></a>
<?php
		 include "db_conn.php";
         session_start();
         $uname=$_SESSION['username'];
         $wnn=$_GET['editwn'];
         $query="select * from sworkshop where RollNo='$uname' and  WorkshopName='$wnn'";
         $result=mysqli_query($conn,$query);
         while($row=mysqli_fetch_array($result)){
		?>
  <form method='post' action='' id='note1' class='w3-container' enctype='multipart/form-data'><h4><p><label>Workshop Name: </label><input class='w3-input' type='text' value='<?php echo $row['WorkshopName'];?>' name='wn' required></p><br><p><label>Name of the oraganization: </label><input class='w3-input' type='text' value='<?php echo $row['OrgName'];?>' name='org' required></p><br><label>Place:</label><input class='w3-input' type='text' name='place' value='<?php echo $row['Place'];?>' required></p><br><p><label>Start Date: </label><input class='w3-input' type='date' value='<?php echo $row['StartDate'];?>' name='sd' required></p><br><p><label>End Date: </label><input class='w3-input' type='date' value='<?php echo $row['EndDate'];?>' name='ed' required></p><br><label for='academic'>Academic Year</label><br><select class='btn' style='width:60%;' id='academic' onclick='my()' name='accy' required><option value=''>Academic Year</option><option value='2019-2020'>2019-2020</option><option value='2020-2021'>2020-2021</option><option value='2021-2022'>2021-2022</option><option value='2022-2023'>2022-2023</option><option value='2023-2024'>2023-2024</option><option value='2024-2025'>2024-2025</option><option value='2025-2026'>2025-2026</option><option value='2026-2027'>2026-2027</option><option value='2027-2028'>2027-2028</option><option value='2028-2029'>2028-2029</option><option value='2029-2030'>2029-2030</option></select><br><input type='file' name='file' required><br><input type='hidden' name='oldimage' value='<?php echo $row['file'];?>'><br><input type='submit' class='btn' value='submit' name='submit'></h4></form>
<?php } ?>
</body>
</html>

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
 $oldimage=$_POST['oldimage'];
    $ay=$_SESSION['ay'];
   $accy=$_SESSION['accy'];
    $datetime1 = date_create($sd);
$datetime2 = date_create($ed);
$durt = date_diff($datetime1, $datetime2);
$durt=$durt->format('%m months, %d days');
if(isset($_POST['submit'])){
    $sql = "UPDATE sworkshop SET WorkshopName='$wn', OrgName='$org', Place='$place', StartDate='$sd', EndDate='$ed', Duration='$durt', file='$filename' WHERE RollNo='$uname' and  WorkshopName='$wnn'";
    // Execute query
    $res=mysqli_query($conn, $sql);
    if($res and move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Updated Successfully');window.location='ssearch.php';</script>";
        unlink("images/".$oldimage);
    }else{
        echo "<script>alert('Data not Updated')</script>";
    }
      
}
?>