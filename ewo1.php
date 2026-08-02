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
    <a href="fsearch.php" class="n" ><button type="button" class="btn" id="btn2" >Back</button></a>
<?php
		 include "db_conn.php";
         session_start();
         $uname=$_SESSION['username'];
         $wnn=$_GET['editwn'];
         $query="select * from ffworkshop where id='$uname' and  workshopn='$wnn'";
         $result=mysqli_query($conn,$query);
         while($row=mysqli_fetch_array($result)){
		?>
   <form method='post' action='' id='note1' class='w3-container' enctype='multipart/form-data'><h5>workshop/ conference/ seminar name<input class='w3-input' type='text' name='wn' value='<?php echo $row['workshopn'];?>' required><br><input type='radio' name='q1' value='workshop' />workshop &nbsp;&nbsp;<input type='radio' name='q1' value='seminar' checked />seminar &nbsp;&nbsp;<input type='radio' name='q1' value='conference' />conference</p><br>Organized At<input class='w3-input' type='text' name='org' value='<?php echo $row['org'];?>' required><br>Topic<input class='w3-input' type='text' name='title' value='<?php echo $row['title'];?>' required><br><label>Place:</label><input class='w3-input' type='text' name='place' value='<?php echo $row['place'];?>' required></p><br><p><label>Start Date: </label><input class='w3-input' type='date' name='sd' value='<?php echo $row['startdate'];?>' required></p><br><p><label>End Date: </label><input class='w3-input' type='date' name='ed' value='<?php echo $row['enddate'];?>' required></p><br><input type='file' name='file' required><input type='hidden' name='oldimage' value='<?php echo $row['file'];?>'><br><input type='submit' class='btn' value='submit' name='submit'></h5></form>
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
    $_SESSION['ed'] = $_POST['ed'];
    $_SESSION['q1'] = $_POST['q1'];
    $_SESSION['place']=$_POST['place'];
    $_SESSION['title'] = $_POST['title'];
    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "images/".$filename;  
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
  $oldimage=$_POST['oldimage'];
    $q1=$_SESSION['q1'];
    $title=$_SESSION['title'];
    $department=$_SESSION['department'];	
    $wn=$_SESSION['wn'];
    $org=$_SESSION['org'];
    $sd=$_SESSION['sd'];
    $ed=$_SESSION['ed'];
    $place=$_SESSION['place'];
    $datetime1 = date_create($sd);
    $datetime2 = date_create($ed);
    $durt = date_diff($datetime1, $datetime2);
    $durt=$durt->format('%m months, %d days');

if(isset($_POST['submit'])){
    $sql = "UPDATE ffworkshop SET workshopn='$wn', org='$org', place='$place', startdate='$sd', enddate='$ed', duration='$durt', file='$filename', type='$q1'  WHERE id='$uname' and  workshopn='$wnn'";
    // Execute query
    $res=mysqli_query($conn, $sql);
    if($res and move_uploaded_file($tempname, $folder)) {
        
        echo "<script>alert('Data Uploaded Successfully');window.location='fsearch.php';</script>";
             unlink("images/".$oldimage);
    }else{
        echo "<script>alert('Data not Uploaded')</script>";
    }
      
}
?>


