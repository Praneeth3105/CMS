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
         $query="select * from others where rollno='$uname' and  cname='$wnn'";
         $result=mysqli_query($conn,$query);
         while($row=mysqli_fetch_array($result)){
		?>
   <form method='post' action='' enctype='multipart/form-data' id='note1' class='w3-container'><h4><p><label>Name of Certificate/Achievement: </label><input class='w3-input' type='text' name='ah' value='<?php echo $row['cname'];?>' required></p><br><p><label>Organization offered:</label><input class='w3-input' type='text' name='oo' value='<?php echo $row['ooffered'];?>' required></p><br><p><label>Place:</label><input class='w3-input' type='text' name='pl' value='<?php echo $row['place'];?>' required> </p><br><p><label>Start Date:</label><input class='w3-input' type='date' name='sd' value='<?php echo $row['startdate'];?>' required><br><p><label>End Date:</label><input class='w3-input' type='date' name='ed' value='<?php echo $row['enddate'];?>' required><br><input type='file' name='file' required><input type='hidden' name='oldimage' value='<?php echo $row['file'];?>'><br><input type='submit' class='btn' value='submit' name='submit'></h4></form>
<?php } ?>
</body>
</html>

<?php
    include "db_conn.php";
    session_start();
    $_SESSION['ah'] = $_POST['ah'];
    $_SESSION['oo'] = $_POST['oo'];
    $_SESSION['sd'] = $_POST['sd'];
    $_SESSION['ed'] = $_POST['ed'];
    $_SESSION['pl'] = $_POST['pl'];
     $oldimage=$_POST['oldimage'];
    $name=$_SESSION['name'];
    $id=$_SESSION['id'];
    $year=$_SESSION['year'];	
    $department=$_SESSION['department'];
    $ah=$_SESSION['ah'];
    $oo=$_SESSION['oo'];
    $sd=$_SESSION['sd'];
    $ed=$_SESSION['ed'];
    $pl=$_SESSION['pl'];
  $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "images/".$filename; 

    $datetime1 = date_create($sd);
$datetime2 = date_create($ed);
$durt = date_diff($datetime1, $datetime2);
$durt=$durt->format('%m months, %d days');
if(isset($_POST['submit'])){
    $sql = "UPDATE others SET cname='$ah',ooffered='$oo',place='$pl',startdate='$sd',enddate='$ed',file='$filename' WHERE rollno='$uname' and  cname='$wnn'";
    // Execute query
    $res=mysqli_query($conn, $sql);
    if($res and move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Data Uploaded Successfully');window.location='fsearch.php';</script>";
        unlink("images/".$oldimage);
    }else{
        echo "<script>alert('Data not Uploaded');window.location='fsearch.php';</script>";
    }
      
}
?>




