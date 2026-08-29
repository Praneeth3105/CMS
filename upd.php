
<?php 

include "db_conn.php";
    session_start();

    $uname=$_SESSION['username'];
    $name=$_SESSION['name'];
$i=$_POST['sem'];
	$location="file/";
	$file1=$_FILES['file']['name'];
	$file_tmp1=$_FILES['file']['tmp_name'];

if(isset($_POST['submit']))
{	if($i=='semoo'){
	$query="UPDATE academic SET semoo='$file1' WHERE rollno='$uname'";
	$fire=mysqli_query($conn,$query);
	if($fire)
	{
		move_uploaded_file($file_tmp1, $location.$file1);
		
		
		echo "<script>alert('Data Uploaded Successfully');window.location='accer.php';</script>";
	}
	else
	{
		 echo "<script>alert('Data not Uploaded 1');window.location='accer.php';</script>";
	}

}elseif($i=='semot'){

$query1="UPDATE academic SET semot='$file1' WHERE rollno='$uname'";
	$fire1=mysqli_query($conn,$query1);
	if($fire1)
	{
		move_uploaded_file($file_tmp1, $location.$file1);
		
		
		echo "<script>alert('Data Uploaded Successfully');window.location='accer.php';</script>";
	}
	else
	{
		 echo "<script>alert('Data not Uploaded 2');window.location='accer.php';</script>";
	}


}
elseif($i=='semto'){

$query2="UPDATE academic SET semto='$file1' WHERE rollno='$uname'";
	$fire2=mysqli_query($conn,$query2);
	if($fire2)
	{
		move_uploaded_file($file_tmp1, $location.$file1);
		
		
		echo "<script>alert('Data Uploaded Successfully');window.location='accer.php';</script>";
	}
	else
	{
		 echo "<script>alert('Data not Uploaded 3');window.location='accer.php';</script>";
	}
}
elseif($i=='semtt'){

$query3="UPDATE academic SET semtt='$file1' WHERE rollno='$uname'";
	$fire3=mysqli_query($conn,$query3);
	if($fire3)
	{
		move_uploaded_file($file_tmp1, $location.$file1);
		
		
		echo "<script>alert('Data Uploaded Successfully');window.location='accer.php';</script>";
	}
	else
	{
		 echo "<script>alert('Data not Uploaded 4');window.location='accer.php';</script>";
	}


}
elseif($i=='semtho'){

$query4="UPDATE academic SET semtho='$file1' WHERE rollno='$uname'";
	$fire4=mysqli_query($conn,$query4);
	if($fire4)
	{
		move_uploaded_file($file_tmp1, $location.$file1);
		
		
		echo "<script>alert('Data Uploaded Successfully');window.location='accer.php';</script>";
	}
	else
	{
		 echo "<script>alert('Data not Uploaded 5');window.location='accer.php';</script>";
	}


}
elseif($i=='semtht'){

$query5="UPDATE academic SET semtht='$file1' WHERE rollno='$uname'";
	$fire5=mysqli_query($conn,$query5);
	if($fire5)
	{
		move_uploaded_file($file_tmp1, $location.$file1);
		
		
		echo "<script>alert('Data Uploaded Successfully');window.location='accer.php';</script>";
	}
	else
	{
		 echo "<script>alert('Data not Uploaded 6');window.location='accer.php';</script>";
	}


}
elseif($i=='semfo'){

$query6="UPDATE academic SET semfo='$file1' WHERE rollno='$uname'";
	$fire6=mysqli_query($conn,$query6);
	if($fire6)
	{
		move_uploaded_file($file_tmp1, $location.$file1);
		
		
		echo "<script>alert('Data Uploaded Successfully');window.location='accer.php';</script>";
	}
	else
	{
		 echo "<script>alert('Data not Uploaded 7');window.location='accer.php';</script>";
	}
}
elseif($i=='semft'){

$query7="UPDATE academic SET semft='$file1' WHERE rollno='$uname'";
	$fire7=mysqli_query($conn,$query7);
	if($fire7)
	{
		move_uploaded_file($file_tmp1, $location.$file1);
		
		
		echo "<script>alert('Data Uploaded Successfully');window.location='accer.php';</script>";
	}
	else
	{
		 echo "<script>alert('Data not Uploaded 8');window.location='accer.php';</script>";
	}
}
}
?>