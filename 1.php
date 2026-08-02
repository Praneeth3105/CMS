<?php
include "db_conn.php";
if (isset($_POST['submit'])) {
    session_start();
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $uname = $_SESSION['username'];
    $pass = $_SESSION['password'];
    $query = "select * from studentdetails where username='$uname' and password='$pass'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        echo "<script>window.location='studentdat.php';</script>";
    } else {
        echo "<script>alert('Invalid username or password');window.location='login1.php';</script>";
    }
}
