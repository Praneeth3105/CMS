<?php
include "db_conn.php";
session_start();

if (isset($_POST['submit'])) {

    $un = $_POST['uname'];
    $psw = $_POST['psw'];
    $name = $_POST['name'];
    $num = $_POST['date'];
    $department = $_POST['department'];
    $email = $_POST['email'];

    // Check duplicate faculty ID
    $check = mysqli_query($conn, "SELECT * FROM faculty WHERE id='$un'");

    if (mysqli_num_rows($check) > 0) {
        echo "<script>
                alert('Faculty ID already exists');
                window.location='addfac.php';
              </script>";
        exit();
    }

    $sql = "INSERT INTO faculty
            (id,name,department,year,password,email)
            VALUES
            ('$un','$name','$department','$num','$psw','$email')";

    $reso = mysqli_query($conn, $sql);

    if ($reso) {

        $sql1 = "INSERT INTO login
                (username,password,name,rollno,department,year,counsular,classteacher)
                VALUES
                ('$un','$psw','$name','$un','$department','$num','','')";

        mysqli_query($conn, $sql1);

        echo "<script>
                alert('Faculty Added Successfully');
                window.location='addfac.php';
              </script>";
    } else {

        echo "<script>
                alert('Data Not Uploaded');
                window.location='addfac.php';
              </script>";
    }
}
