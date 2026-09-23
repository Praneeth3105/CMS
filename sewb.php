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

$stmt = mysqli_prepare($conn, "SELECT * FROM sinternship WHERE rollno=? AND companyname=? LIMIT 1");
mysqli_stmt_bind_param($stmt, "ss", $rollno, $original);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$row) {
    die("Record not found, or you don't have permission to edit it.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $companyname = trim($_POST['companyname']);
    $branch      = trim($_POST['branch']);
    $year        = trim($_POST['year']);
    $startdate   = trim($_POST['startdate']);
    $enddate     = trim($_POST['enddate']);
    $duration    = trim($_POST['duration']);
    $amount      = trim($_POST['amount']);
    $paid        = trim($_POST['paid']);
    $tech        = trim($_POST['tech']);
    $filename    = $row['pic'];

    if (!empty($_FILES['file']['name'])) {
        $newfile = time() . '_' . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], __DIR__ . '/images/' . $newfile)) {
            if (!empty($row['pic']) && file_exists(__DIR__ . '/images/' . $row['pic'])) {
                @unlink(__DIR__ . '/images/' . $row['pic']);
            }
            $filename = $newfile;
        }
    }

    $upd = mysqli_prepare($conn, "UPDATE sinternship SET companyname=?, branch=?, year=?, startdate=?, enddate=?, duration=?, amount=?, paid=?, tech=?, pic=? WHERE rollno=? AND companyname=?");
    mysqli_stmt_bind_param($upd, "ssssssssssss", $companyname, $branch, $year, $startdate, $enddate, $duration, $amount, $paid, $tech, $filename, $rollno, $original);

    if (mysqli_stmt_execute($upd)) {
        header("Location: ssearch.php?updated=internship");
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
    <title>Edit Internship</title>
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
            <h1>Edit Internship</h1>
            <?php if ($error): ?><div class="error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

            <?php
            $ext = pathinfo($row['pic'] ?? '', PATHINFO_EXTENSION);
            if (!empty($row['pic'])) {
                echo '<div class="current-file">';
                if (strtolower($ext) === 'pdf') {
                    echo '<embed src="images/' . htmlspecialchars($row['pic']) . '" type="application/pdf" width="220" height="130">';
                } else {
                    echo '<img src="images/' . htmlspecialchars($row['pic']) . '" alt="Current file">';
                }
                echo '</div>';
            }
            ?>

            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="original_name" value="<?php echo htmlspecialchars($original); ?>">

                <div class="field"><label>Company Name</label><input type="text" name="companyname" value="<?php echo htmlspecialchars($row['companyname']); ?>" required></div>
                <div class="field"><label>Branch</label><input type="text" name="branch" value="<?php echo htmlspecialchars($row['branch']); ?>"></div>
                <div class="field"><label>Year</label><input type="text" name="year" value="<?php echo htmlspecialchars($row['year']); ?>"></div>
                <div class="field"><label>Start Date</label><input type="date" name="startdate" value="<?php echo htmlspecialchars($row['startdate']); ?>" required></div>
                <div class="field"><label>End Date</label><input type="date" name="enddate" value="<?php echo htmlspecialchars($row['enddate']); ?>" required></div>
                <div class="field"><label>Duration</label><input type="text" name="duration" value="<?php echo htmlspecialchars($row['duration']); ?>"></div>
                <div class="field"><label>Amount</label><input type="text" name="amount" value="<?php echo htmlspecialchars($row['amount']); ?>"></div>
                <div class="field"><label>Paid</label><input type="text" name="paid" value="<?php echo htmlspecialchars($row['paid']); ?>"></div>
                <div class="field"><label>Tech / Non-Tech</label><input type="text" name="tech" value="<?php echo htmlspecialchars($row['tech']); ?>"></div>
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