<?php
include "db_conn.php"; // Using database connection file here

if (isset($_POST['submit1'])) {
    $noc1 = $_POST['noc1'];
    $org1 = $_POST['org1'];
    $dur1 = $_POST['dur1'];
    $query = "INSERT INTO login (noc,org,dur,type) VALUES ('$noc1','$org1','$dur1','intenship')";


    $insert = mysqli_query($conn, $query);

    if ($insert) {
        echo "<script>alert('You have submited the data successfully');
        window.location.href = 'studentadd.php';</script>";
    } else {
        echo "<script>alert('Your record is not submited Please try again');
        window.location.href = 'studentadd.php';</script> ";
    }
}
