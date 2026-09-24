<?php

include "db_conn.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: counsellor.php");
    exit();
}

if (!isset($_POST['submit'], $_POST['faculty'], $_POST['check'])) {

    echo "<script>
        alert('Please select a counsellor and at least one student.');
        window.location='counsellor.php';
    </script>";

    exit();
}

$facultyId = trim($_POST['faculty']);
$selected = $_POST['check'];


/* -----------------------------------------
   GET FACULTY DETAILS
----------------------------------------- */

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
        window.location='counsellor.php';
    </script>";

    exit();
}

$facultyName = $facultyRow['name'];


/* -----------------------------------------
   TABLES
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
                    counsular_id = ?,
                    counsular = ?
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
        alert('Counsellor assigned successfully.');
        window.location='counsellor.php';
    </script>";
} catch (Exception $e) {

    mysqli_rollback($conn);

    echo "<script>
        alert('Assignment failed. No changes were saved.');
        window.location='counsellor.php';
    </script>";
}

exit();
