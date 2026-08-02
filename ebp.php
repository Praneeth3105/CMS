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
         $query="select * from bookpublish where id='$uname' and  title='$wnn'";
         $result=mysqli_query($conn,$query);
         while($row=mysqli_fetch_array($result)){
		?>
   <form method='post' action='' enctype='multipart/form-data' id='note1' class='w3-container'><h4><p><label>Authorship Position:</label><br><input type='radio' name='q1' value='1' />1 &nbsp;&nbsp;<input type='radio' name='q1' value='2' />2 &nbsp;&nbsp;<input type='radio' name='q1' value='3' />3 &nbsp;&nbsp;<input type='radio' name='q1' value='4' />4 &nbsp;&nbsp;<input type='radio' name='q1' value='5' />5 &nbsp;&nbsp;<input type='radio' name='q1' value='6' />6 &nbsp;&nbsp;</p><br><p><label>Title of the Paper:</label><input class='w3-input' type='text' name='n' value='<?php echo $row['title'];?>' required></p><br><p><label>book chapter name:</label><input class='w3-input' type='text' name='m' value='<?php echo $row['journal'];?>' required></p><br><p><label>Type of Journal: </label><br><input type='radio' name='t' value='ugc' />ugc &nbsp;&nbsp;<input type='radio' name='t' value='ugc care' />ugc care &nbsp;&nbsp;<input type='radio' name='t' value='scopus' />scopus &nbsp;&nbsp;<input type='radio' name='t' value='wos' />wos &nbsp;&nbsp;<input type='radio' name='t' value='scopus&wos' />scopus & wos &nbsp;&nbsp;<input type='radio' name='t' value='sci' />sci &nbsp;&nbsp;<input type='radio' name='t' value='others' />others</p><br><p><label>Publication Type:</label><br><input type='radio' name='f' value='free' />Free &nbsp;&nbsp;<input type='radio' name='f' value='Paid' />Paid</p><br><p><label>ISBN Number:</label><input class='w3-input' type='text' name='iss' value='<?php echo $row['issn'];?>' required></p><br><p><label>Publication Date:</label><input class='w3-input' type='date' name='d' value='<?php echo $row['date'];?>' required></p><br><p><label>Volume:</label><input class='w3-input' type='text' name='v' value='<?php echo $row['volume'];?>' required></p><br><p><label>Issue:</label><input class='w3-input' type='text' name='in' value='<?php echo $row['issue'];?>' required></p><br><p><label>URL:</label><input class='w3-input' type='text' name='u' value='<?php echo $row['url'];?>' required></p><br><p><label>Upload First Page of Paper (only pdf format is acceptable):</label><input class='w3-input' type='file' name='file' required></p><input type='hidden' name='oldimage' value='<?php echo $row['file'];?>'><br><input type='submit' class='btn' value='submit' name='submit'></h4></form>
<?php } ?>
</body>
</html>

<?php
    include "db_conn.php";
    session_start();
    $_SESSION['q1'] = $_POST['q1'];
    $_SESSION['n'] = $_POST['n'];
    $_SESSION['m'] = $_POST['m'];
    $_SESSION['t'] = $_POST['t'];
    $_SESSION['f'] = $_POST['f'];
    $_SESSION['iss'] = $_POST['iss']; 
    $_SESSION['d'] = $_POST['d'];
    $_SESSION['v'] = $_POST['v'];
    $_SESSION['in'] = $_POST['in'];
    $_SESSION['u'] = $_POST['u'];
    $_SESSION['i'] = $_POST['i'];


    $name=$_SESSION['name'];
    $rollno=$_SESSION['rollno'];
    $department=$_SESSION['department'];
    $id=$_SESSION['id'];	
    $q1=$_SESSION['q1'];
    $n=$_SESSION['n'];
    $m=$_SESSION['m'];
    $t=$_SESSION['t'];
    $f=$_SESSION['f'];
    $i=$_SESSION['i'];
    $v=$_SESSION['v'];
    $in=$_SESSION['in'];
    $u=$_SESSION['u'];
    $iss=$_SESSION['iss'];
    $d=$_SESSION['d'];
$oldimage=$_POST['oldimage'];
 $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "images/".$filename;  

if(isset($_POST['submit'])){
    $sql = "UPDATE bookpublish SET authorship_position='$q1',title='$n',journal='$m',type='$t',publication_type='$f',issn='$iss',date='$d',volume='$v',issue='$in',url='$u',file='$filename'  WHERE id='$uname' and  title='$wnn'";
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