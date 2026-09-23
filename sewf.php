<?php
include_once('db_conn.php');
if (session_status() === PHP_SESSION_NONE) session_start();

$rollno = $_SESSION['username'] ?? null;
if (!$rollno) {
    header('Location: index.php');
    exit;
}

$original = $_GET['editwn'] ?? ($_POST['original_name'] ?? '');
$error = '';

$stmt = mysqli_prepare($conn, "SELECT * FROM cocircular WHERE rollno=? AND eventname=? LIMIT 1");
mysqli_stmt_bind_param($stmt, "ss", $rollno, $original);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$row) {
    die("Record not found, or you don't have permission to edit it.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventname     = trim($_POST['eventname']);
    $year          = trim($_POST['year']);
    $branch        = trim($_POST['branch']);
    $conductingclg = trim($_POST['conductingclg']);
    $orgname       = trim($_POST['orgname']);
    $dates         = trim($_POST['dates']);
    $ie            = trim($_POST['ie']);
    $academic_year = trim($_POST['academic_year']);
    $filename      = $row['file'];

    if (!empty($_FILES['file']['name'])) {
        $newfile = time() . '_' . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], __DIR__ . '/images/' . $newfile)) {
            if (!empty($row['file']) && file_exists(__DIR__ . '/images/' . $row['file'])) {
                @unlink(__DIR__ . '/images/' . $row['file']);
            }
            $filename = $newfile;
        }
    }

    $upd = mysqli_prepare($conn, "UPDATE cocircular SET eventname=?, year=?, branch=?, conductingclg=?, orgname=?, dates=?, ie=?, academic_year=?, file=? WHERE rollno=? AND eventname=?");
    mysqli_stmt_bind_param($upd, "sssssssssss", $eventname, $year, $branch, $conductingclg, $orgname, $dates, $ie, $academic_year, $filename, $rollno, $original);

    if (mysqli_stmt_execute($upd)) {
        header("Location: ssearch.php?updated=cocircular");
        exit;
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Co Circular</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark: #1a120b;
            --dark-2: #2b1d13;
            --gold: #d4af37;
            --gold-soft: #c9a227;
            --gold-pale: #f0e2b8;
            --cream: #f2ece1;
            --cream-card: #fffdf9;
            --border: #e8dfc9;
            --muted: #8a7d6b;
            --danger: #b6432f;
            --radius: 16px;
            --shadow: 0 10px 28px rgba(120, 100, 60, .10);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--dark);
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 28px;
            background: linear-gradient(120deg, var(--dark), var(--dark-2));
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #fff;
            font-size: 1.2rem;
        }

        .brand span {
            color: var(--gold);
        }

        .navbar a button {
            padding: 9px 18px;
            background: transparent;
            color: var(--gold-pale);
            border: 1px solid var(--gold-soft);
            border-radius: 999px;
            font-weight: 600;
            font-size: .75rem;
            text-transform: uppercase;
            cursor: pointer;
        }

        .wrap {
            max-width: 640px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: var(--cream-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 30px;
        }

        .card h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            margin: 0 0 20px;
        }

        .field {
            margin-bottom: 16px;
        }

        .field label {
            display: block;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .field input {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: .9rem;
            background: #fff;
        }

        .field input:focus {
            outline: none;
            border-color: var(--gold-soft);
        }

        .current-file {
            margin-bottom: 16px;
        }

        .current-file img,
        .current-file embed {
            max-width: 220px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .btn-row {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn {
            padding: 11px 26px;
            border-radius: 999px;
            font-weight: 600;
            font-size: .8rem;
            text-transform: uppercase;
            cursor: pointer;
            border: 1px solid transparent;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: var(--gold);
            color: var(--dark);
            border-color: var(--gold);
        }

        .btn-secondary {
            background: transparent;
            color: var(--dark);
            border-color: var(--border);
        }

        .error {
            background: rgba(182, 67, 47, .08);
            color: var(--danger);
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: .85rem;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="brand">Certificate <span>Management</span> System</div>
        <a href="ssearch.php"><button type="button">Back</button></a>
    </div>
    <div class="wrap">
        <div class="card">
            <h1>Edit Co Circular</h1>
            <?php if ($error): ?><div class="error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

            <?php
            $ext = pathinfo($row['file'] ?? '', PATHINFO_EXTENSION);
            if (!empty($row['file'])) {
                echo '<div class="current-file">';
                if (strtolower($ext) === 'pdf') {
                    echo '<embed src="images/' . htmlspecialchars($row['file']) . '" type="application/pdf" width="220" height="130">';
                } else {
                    echo '<img src="images/' . htmlspecialchars($row['file']) . '" alt="Current file">';
                }
                echo '</div>';
            }
            ?>

            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="original_name" value="<?php echo htmlspecialchars($original); ?>">

                <div class="field"><label>Event Name</label><input type="text" name="eventname" value="<?php echo htmlspecialchars($row['eventname']); ?>" required></div>
                <div class="field"><label>Year</label><input type="text" name="year" value="<?php echo htmlspecialchars($row['year']); ?>"></div>
                <div class="field"><label>Branch</label><input type="text" name="branch" value="<?php echo htmlspecialchars($row['branch']); ?>"></div>
                <div class="field"><label>Conducting College</label><input type="text" name="conductingclg" value="<?php echo htmlspecialchars($row['conductingclg']); ?>"></div>
                <div class="field"><label>Organisation</label><input type="text" name="orgname" value="<?php echo htmlspecialchars($row['orgname']); ?>"></div>
                <div class="field"><label>Dates</label><input type="text" name="dates" value="<?php echo htmlspecialchars($row['dates']); ?>"></div>
                <div class="field"><label>Internal / External</label><input type="text" name="ie" value="<?php echo htmlspecialchars($row['ie']); ?>"></div>
                <div class="field"><label>Academic Year</label><input type="text" name="academic_year" value="<?php echo htmlspecialchars($row['academic_year']); ?>"></div>
                <div class="field"><label>Replace File (optional)</label><input type="file" name="file"></div>

                <div class="btn-row">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="ssearch.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>