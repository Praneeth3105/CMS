<?php
include("db_conn.php");
session_start();
    $_SESSION['year'] = $_POST['yearr'];
    $_SESSION['branch'] = $_POST['branchh'];
    $_SESSION['std'] = $_POST['stdd'];
    $_SESSION['end'] = $_POST['endd'];
if(isset($_POST['submit'])){
$year=$_SESSION['year'];
$branch=$_SESSION['branch'];
$std=$_SESSION['std'];
$end=$_SESSION['end'];
header("location:asearch.php");
}
?>



