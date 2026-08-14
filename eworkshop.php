<?php
session_start();
include_once('db_conn.php');

// Get the ID from the URL
$id = $_GET['id'] ?? null;
if (!$id) {
    die("No ID provided.");
}

// Fetch the existing record so the form can be pre-filled
$query = "SELECT * FROM ffworkshop WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Record not found.");
}

// Handle the UPDATE when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name              = mysqli_real_escape_string($conn, $_POST['name']);
    $academic_year     = mysqli_real_escape_string($conn, $_POST['academic_year']);
    $workshop          = mysqli_real_escape_string($conn, $_POST['workshop']);
    $org               = mysqli_real_escape_string($conn, $_POST['org']);
    $mode              = mysqli_real_escape_string($conn, $_POST['mode']);
    $start_date        = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date          = mysqli_real_escape_string($conn, $_POST['end_date']);
    $duration          = mysqli_real_escape_string($conn, $_POST['duration']);
    $certificate_link  = mysqli_real_escape_string($conn, $_POST['certificate_link']);

    // keep the raw-date columns in sync too, since your table has them
    $start_date_raw = $start_date;
    $end_date_raw   = $end_date;

    $update = "UPDATE ffworkshop SET 
                name='$name', 
                academic_year='$academic_year', 
                workshop='$workshop', 
                org='$org', 
                mode='$mode', 
                start_date='$start_date', 
                start_date_raw='$start_date_raw',
                end_date='$end_date', 
                end_date_raw='$end_date_raw',
                duration='$duration', 
                certificate_link='$certificate_link'
               WHERE id='$id'";

    if (mysqli_query($conn, $update)) {
        header("Location: facultydat.php?updated=1");
        exit();
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Workshop / Seminar / Conference</title>
    <link rel="stylesheet" href="edit-style.css">
    
</head>

<body>

    <div class="topbar">
        <h1 class="brand">Certificate <span>Management</span> System</h1>
        <div class="topbar-actions">
            <a href="facultydat.php" class="n"><button type="button" class="btn">Back</button></a>
        </div>
    </div>

    <div class="page-head">
        <h1>Edit <span>Workshop / Seminar / Conference</span></h1>
    </div>

    <div class="form-box">
        <a href="facultydat.php" class="back-link">&larr; Back to list</a>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

            <label>Academic Year</label>
            <input type="text" name="academic_year" value="<?php echo htmlspecialchars($row['academic_year']); ?>" required>

            <label>Type</label>
            <select name="workshop" required>
                <option value="Workshop" <?php if ($row['workshop'] === 'Workshop') echo 'selected'; ?>>Workshop</option>
                <option value="Seminar" <?php if ($row['workshop'] === 'Seminar') echo 'selected'; ?>>Seminar</option>
                <option value="Conference" <?php if ($row['workshop'] === 'Conference') echo 'selected'; ?>>Conference</option>
            </select>

            <label>Organisation</label>
            <input type="text" name="org" value="<?php echo htmlspecialchars($row['org']); ?>" required>

            <label>Mode</label>
            <select name="mode" required>
                <option value="Online" <?php if ($row['mode'] === 'Online') echo 'selected'; ?>>Online</option>
                <option value="Offline" <?php if ($row['mode'] === 'Offline') echo 'selected'; ?>>Offline</option>
            </select>

            <label>Start Date</label>
            <input type="date" name="start_date" value="<?php echo htmlspecialchars($row['start_date']); ?>" required>

            <label>End Date</label>
            <input type="date" name="end_date" value="<?php echo htmlspecialchars($row['end_date']); ?>" required>

            <label>Duration</label>
            <input type="text" name="duration" value="<?php echo htmlspecialchars($row['duration']); ?>">

            <label>Certificate Link</label>
            <input type="text" name="certificate_link" value="<?php echo htmlspecialchars($row['certificate_link']); ?>">

            <button type="submit">Update</button>
        </form>
    </div>

</body>

</html>