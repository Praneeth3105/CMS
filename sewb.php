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
         $query="select * from sinternship where rollno='$uname' and  companyname='$wnn'";
         $result=mysqli_query($conn,$query);
         while($row=mysqli_fetch_array($result)){
		?>
 <form method='post' action='' id='note1' class='w3-container' enctype='multipart/form-data'><h4><p><label>Company Name:</label><input class='w3-input' type='text' value='<?php echo $row['companyname'];?>' name='cn' required></p><br><p><label>Technical/Non Technical:</label><input class='w3-input' type='text' value='<?php echo $row['tech'];?>' name='tech' required></p><br><label>Domain </label><input class='w3-input' type='text' value='<?php echo $row['domain'];?>' name='dd' required><br><p><label>Starting Date: </label><input class='w3-input'type='date' name='sd' value='<?php echo $row['startdate'];?>' required></p><br><p><label>Ending Date:</label><input class='w3-input' type='date' value='<?php echo $row['enddate'];?>' name='ed' required></p><br><p><br><p><label>Paid/Not Paid:</label><input class='w3-input' type='text' value='<?php echo $row['paid'];?>' name='paid' required></p><br><p><label>Total Amount:</p><br><p><input class='w3-input' type='text' value='<?php echo $row['amount'];?>' name='tamount' required></p><br><label for='academic'>Academic Year</label><br><select class='btn' style='width:60%;' id='academic' onclick='my()' name='acc' required><option value=''>Academic Year</option><option value='2019-2020'>2019-2020</option><option value='2020-2021'>2020-2021</option><option value='2021-2022'>2021-2022</option><option value='2022-2023'>2022-2023</option><option value='2023-2024'>2023-2024</option><option value='2024-2025'>2024-2025</option><option value='2025-2026'>2025-2026</option><option value='2026-2027'>2026-2027</option><option value='2027-2028'>2027-2028</option><option value='2028-2029'>2028-2029</option><option value='2029-2030'>2029-2030</option></select><br><input type='file' name='file' required><br><input type='hidden' name='oldimage' value='<?php echo $row['pic'];?>'><br><input type='submit' class='btn' value='submit' name='submit'></h4></form>
<?php } ?>
</body>
</html>

 <?php
    include "db_conn.php";
if(isset($_POST['submit'])){
      #  session_start();
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
      $folder = "images/".$filename;  
      $name=$_SESSION['name'];
      $rollno=$_SESSION['username'];
      $year=$_SESSION['year'];
  $oldimage=$_POST['oldimage'];
  $accy=$_SESSION['accy'];	
      $branch=$_SESSION['department'];
      $counsular=$_SESSION['counsular'];
      $classteacher=$_SESSION['classteacher'];	
      $cn=$_SESSION['cn'];
      $dd=$_SESSION['dd'];
      $tech=$_SESSION['tech'];
      $sd=$_SESSION['sd'];
      $ed=$_SESSION['ed'];
      $paid=$_SESSION['paid'];
      $amount=$_SESSION['tamount'];
      $datetime1 = date_create($sd);
  $datetime2 = date_create($ed);
  $durt = date_diff($datetime1, $datetime2);
  $durt=$durt->format('%m months, %d days');
  
    $sql = "UPDATE sinternship SET companyname='$cn', domain='$dd', paid='$paid', tech='$tech', pic='$filename', amount='$amount', duration='$durt', startdate='$sd', enddate='$ed'  WHERE rollno='$uname' and  companyname='$wnn'";
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