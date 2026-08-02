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
         $query="select * from sproject where Roll_Number='$uname' and  Project_title='$wnn'";
         $result=mysqli_query($conn,$query);
         while($row=mysqli_fetch_array($result)){
		?>
 <form method='post' action='' id='note1' class='w3-container'><h4><p><br><p><label>Title of the Project:</label><input class='w3-input' type='text' name='tname' value='<?php echo $row['Project_title'];?>' requried></p><br><p><label>Team Number:</label><input class='w3-input' type='text' value='<?php echo $row['Team_Number'];?>' name='bnum' required></p><br><label for='academic'>Academic Year</label><br><select class='btn' style='width:60%;' id='academic' onclick='my()' name='acc' required><option value=''>Academic Year</option><option value='2019-2020'>2019-2020</option><option value='2020-2021'>2020-2021</option><option value='2021-2022'>2021-2022</option><option value='2022-2023'>2022-2023</option><option value='2023-2024'>2023-2024</option><option value='2024-2025'>2024-2025</option><option value='2025-2026'>2025-2026</option><option value='2026-2027'>2026-2027</option><option value='2027-2028'>2027-2028</option><option value='2028-2029'>2028-2029</option><option value='2029-2030'>2029-2030</option></select><br><p><label>Upload Your Project Drive link: </label><input class='w3-input' type='text' name='link' value='<?php echo $row['Drive_link'];?>' required></p><br><input type='submit' class='btn' value='submit' name='submit'></h4></form>
<?php } ?>
</body>
</html>

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
 $oldimage=$_POST['oldimage'];
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
    $sql = "UPDATE sproject SET Team_Number='$bnum', Project_title='$tname', Drive_link='$link', academicyear='$accy' WHERE Roll_Number='$uname' and  Project_title='$wnn'";
    // Execute query
    $res=mysqli_query($conn, $sql);
    if($res) {
        echo "<script>alert('Data Updated Successfully');window.location='studentadd.php';</script>";
        unlink("images/".$oldimage);
    }else{
        echo "<script>alert('Data not Updated')</script>";
    }
      
}
?>