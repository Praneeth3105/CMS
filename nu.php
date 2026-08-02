<?php
include "db_conn.php";
session_start();

if (isset($_POST['submit'])) {

    $_SESSION['uname'] = $_POST['uname'];
    $_SESSION['psw'] = $_POST['psw'];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['number'] = $_POST['number'];
    $_SESSION['year'] = $_POST['year'];
    $_SESSION['department'] = $_POST['department'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['acc'] = $_POST['acc'];

    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "images/" . $filename;

    $name = $_SESSION['name'];
    $psw = $_SESSION['psw'];
    $department = $_SESSION['department'];
    $un = $_SESSION['uname'];
    $add = $_SESSION['address'];
    $acc = $_SESSION['acc'];
    $year = $_SESSION['year'];
    $num = $_SESSION['number'];
    $email = $_SESSION['email'];

    $check = mysqli_query($conn, "SELECT * FROM studentdetails WHERE username='$un'");

    if (mysqli_num_rows($check) > 0) {
        echo "<script>
        alert('Username already exists.');
        window.location='newuser.php';
        </script>";
        exit();
    }

    $sql = "INSERT INTO studentdetails
    (username,password,name,number,location,email,department,year,classteacher,counsular,pic,academic_year)
    VALUES
    ('$un','$psw','$name','$num','$add','$email','$department','$year',NULL,NULL,'$filename','$acc')";

    $reso = mysqli_query($conn, $sql);

    if ($reso && move_uploaded_file($tempname, $folder)) {
        echo "<script>
        alert('Data Uploaded Successfully');
        window.location='newuser.php';
        </script>";
    } else {
        echo "<script>
        alert('Data not Uploaded');
        window.location='newuser.php';
        </script>";
    }
}
