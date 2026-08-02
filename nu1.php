<?php 
include "db_conn.php";
    session_start();

    $uname=$_SESSION['username'];
    $name=$_SESSION['name'];
	$location="file/";
	$file1=$_FILES['aadhar']['name'];
	$file_tmp1=$_FILES['aadhar']['tmp_name'];
	$file2=$_FILES['ssc']['name'];
	$file_tmp2=$_FILES['ssc']['tmp_name'];
	$file3=$_FILES['inter']['name'];
	$file_tmp3=$_FILES['inter']['tmp_name'];
	$file4=$_FILES['1-1']['name'];
	$file_tmp4=$_FILES['1-1']['tmp_name'];
$file5=$_FILES['1-2']['name'];
	$file_tmp5=$_FILES['1-2']['tmp_name'];
$file6=$_FILES['2-1']['name'];
	$file_tmp6=$_FILES['2-1']['tmp_name'];
$file7=$_FILES['2-2']['name'];
	$file_tmp7=$_FILES['2-2']['tmp_name'];
$file8=$_FILES['3-1']['name'];
	$file_tmp8=$_FILES['3-1']['tmp_name'];
$file9=$_FILES['3-2']['name'];
	$file_tmp9=$_FILES['3-2']['tmp_name'];
$file10=$_FILES['4-1']['name'];
	$file_tmp10=$_FILES['4-1']['tmp_name'];
$file11=$_FILES['4-2']['name'];
	$file_tmp11=$_FILES['4-2']['tmp_name'];

if(isset($_POST['submit']))
{	
	$query="INSERT INTO academic(aadhar,ssc,inter,semoo,semot,semto,semtt,semtho,semtht,semfo,semft,rollno,name) VALUES('$file1','$file2','$file3','$file4','$file5','$file6','$file7','$file8','$file9','$file10','$file11','$uname','$name')";
	$fire=mysqli_query($conn,$query);
	if($fire)
	{
		move_uploaded_file($file_tmp1, $location.$file1);
		move_uploaded_file($file_tmp2, $location.$file2);
		move_uploaded_file($file_tmp3, $location.$file3);
		move_uploaded_file($file_tmp4, $location.$file4);
move_uploaded_file($file_tmp5, $location.$file5);
		move_uploaded_file($file_tmp6, $location.$file6);
		move_uploaded_file($file_tmp7, $location.$file7);
		move_uploaded_file($file_tmp8, $location.$file8);
move_uploaded_file($file_tmp9, $location.$file9);
		move_uploaded_file($file_tmp10, $location.$file10);
move_uploaded_file($file_tmp11, $location.$file11);
		
		echo "<script>alert('Data Uploaded Successfully');window.location='studentdat.php';</script>";
	}
	else
	{
		 echo "<script>alert('Data not Uploaded');window.location='accer.php';</script>";
	}
}

?>