<?php

include "db_conn.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: classincharge.php");
    exit();
}

if (!isset($_POST['submit'], $_POST['faculty'], $_POST['check'])) {
    echo "<script>
        alert('Please select a faculty and at least one student.');
        window.location='classincharge.php';
    </script>";
    exit();
}

$facultyId = trim($_POST['faculty']);
$selected = $_POST['check'];

$fq = mysqli_prepare(
    $conn,
    "SELECT id, name FROM faculty WHERE id = ? LIMIT 1"
);

mysqli_stmt_bind_param($fq, "s", $facultyId);
mysqli_stmt_execute($fq);

$facultyResult = mysqli_stmt_get_result($fq);
$facultyRow = mysqli_fetch_assoc($facultyResult);

if (!$facultyRow) {

    echo "<script>
        alert('Invalid faculty selected.');
        window.location='classincharge.php';
    </script>";

    exit();
}

$facultyName = $facultyRow['name'];


/* -----------------------------------------
   TABLES WHICH MUST RECEIVE CLASS INCHARGE
----------------------------------------- */

$tables = [

    ['table' => 'studentdetails', 'col' => 'username'],

    ['table' => 'sworkshop', 'col' => 'RollNo'],

    ['table' => 'sinternship', 'col' => 'rollno'],

    ['table' => 'sproject', 'col' => 'Roll_Number'],

    ['table' => 'extracircular', 'col' => 'rollno'],

    ['table' => 'cocircular', 'col' => 'rollno'],

    ['table' => 'course', 'col' => 'RollNo']

];


/* -----------------------------------------
   START TRANSACTION
----------------------------------------- */

mysqli_begin_transaction($conn);

try {

    foreach ($selected as $studentRollNo) {

        foreach ($tables as $t) {

            $sql = "
                UPDATE `{$t['table']}`
                SET
                    classteacher_id = ?,
                    classteacher = ?
                WHERE `{$t['col']}` = ?
            ";

            $stmt = mysqli_prepare($conn, $sql);

            if (!$stmt) {
                throw new Exception(mysqli_error($conn));
            }

            mysqli_stmt_bind_param(
                $stmt,
                "sss",
                $facultyId,
                $facultyName,
                $studentRollNo
            );

            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception(mysqli_stmt_error($stmt));
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_commit($conn);

    echo "<script>
        alert('Class Incharge assigned successfully.');
        window.location='classincharge.php';
    </script>";
} catch (Exception $e) {

    mysqli_rollback($conn);

    echo "<script>
        alert('Assignment failed. No changes were saved.');
        window.location='classincharge.php';
    </script>";
}

exit();
