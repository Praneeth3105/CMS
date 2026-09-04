<?php
include "db_conn.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && isset($_POST['check'])) {
    $facultyId = $_POST['faculty'];
    $selected  = $_POST['check'];

    $fq = mysqli_prepare($conn, "SELECT name FROM faculty WHERE id = ?");
    mysqli_stmt_bind_param($fq, "s", $facultyId);
    mysqli_stmt_execute($fq);
    $facultyRow = mysqli_stmt_get_result($fq)->fetch_assoc();
    $facultyName = $facultyRow['name'] ?? '';

    if ($facultyName === '') {
        echo "<script>alert('Invalid faculty selected');window.location='classincharge.php';</script>";
        exit;
    }

    $tables = [
        ['table' => 'studentdetails', 'col' => 'username'],
        ['table' => 'sworkshop',      'col' => 'RollNo'],
        ['table' => 'sinternship',    'col' => 'rollno'],
        ['table' => 'sproject',       'col' => 'Roll_Number'],
        ['table' => 'extracircular',  'col' => 'rollno'],
        ['table' => 'cocircular',     'col' => 'rollno'],
        ['table' => 'course',         'col' => 'RollNo'],
    ];

    $ok = true;
    foreach ($selected as $update) {
        foreach ($tables as $t) {
            $sql = "UPDATE `{$t['table']}` SET classteacher_id = ?, classteacher = ? WHERE `{$t['col']}` = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $facultyId, $facultyName, $update);
            if (!mysqli_stmt_execute($stmt)) {
                $ok = false;
            }
        }
    }

    if ($ok) {
        echo "<script>alert('Class incharge assigned successfully');window.location='classincharge.php';</script>";
    } else {
        echo "<script>alert('Some records could not be updated');window.location='classincharge.php';</script>";
    }
    exit;
}

header("Location: classincharge.php");
exit;
