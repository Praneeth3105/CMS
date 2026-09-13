<?php
session_start();
include_once('db_conn.php');


$faculty_id = $_SESSION['id'];
if (!$faculty_id) {
    die("Not logged in.");
}

$allowedTables = array(
    'fdp'                       => 'certificate_link',
    'fdporg'                    => 'certificate_link',
    'ffworkshop'                => 'certificate_link',
    'paperpublications'         => 'proof_link',
    'conferences'                => 'proof_link',
    'certificates'               => 'certificate_link',
    'bookpublish'                => 'proof_link',
    'bookedited'                 => 'proof_link',
    'textbook'                   => null,
    'patents'                    => 'proof_link',
    'nptel'                      => 'certificate_link',
    'achievements'                => 'achievement_link',
    'outside_participations'     => 'proof_link',
    'reviewer_activities'        => 'proof_link',
    'professional_membership'    => 'proof_link',
    'phd_details'                => 'proof_link',
    'consultancy_work'           => 'proof_link',
    'working_models'             => 'proof_link',
    'funding_projects'           => null,
);

$table = isset($_GET['table']) ? $_GET['table'] : '';
$id    = isset($_GET['id']) ? $_GET['id'] : '';

// ---- Validate table name against the whitelist ----
if (!array_key_exists($table, $allowedTables)) {
    die("Invalid table.");
}
if (!$id || !ctype_digit((string)$id)) {
    die("Invalid record id.");
}

$fileColumn = $allowedTables[$table];

$selectSql = "SELECT * FROM `$table` WHERE id = ? AND faculty_id = ?";
$stmt = mysqli_prepare($conn, $selectSql);
mysqli_stmt_bind_param($stmt, "ss", $id, $faculty_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$row) {
    // Either the id doesn't exist, or it belongs to someone else.
    header("Location: fsearch.php?deleted=notfound");
    exit;
}

if ($fileColumn && !empty($row[$fileColumn])) {
    $filePath = __DIR__ . '/images/' . basename($row[$fileColumn]);
    if (file_exists($filePath)) {
        @unlink($filePath);
    }
}

$deleteSql = "DELETE FROM `$table` WHERE id = ? AND faculty_id = ?";
$stmt = mysqli_prepare($conn, $deleteSql);
mysqli_stmt_bind_param($stmt, "ss", $id, $faculty_id);
$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($ok) {
    header("Location: fsearch.php?deleted=success");
} else {
    header("Location: fsearch.php?deleted=error");
}
exit;
