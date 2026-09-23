<?php
include_once('db_conn.php');
if (session_status() === PHP_SESSION_NONE) session_start();

$rollno = $_SESSION['username'] ?? null;
if (!$rollno) {
    header('Location: index.php');
    exit;
}

$name = $_GET['editwn'] ?? ($_POST['name'] ?? '');
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    $stmt = mysqli_prepare($conn, "DELETE FROM sproject WHERE Roll_Number=? AND Project_title=?");
    mysqli_stmt_bind_param($stmt, "ss", $rollno, $name);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ssearch.php?deleted=project");
        exit;
    } else {
        $error = "Delete failed: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark: #1a120b;
            --dark-2: #2b1d13;
            --gold: #d4af37;
            --gold-soft: #c9a227;
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
            max-width: 480px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: var(--cream-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 34px;
            text-align: center;
        }

        .card h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            margin: 0 0 10px;
        }

        .card p {
            color: var(--muted);
            font-size: .9rem;
            margin: 0 0 26px;
        }

        .card p b {
            color: var(--dark);
        }

        .btn-row {
            display: flex;
            gap: 12px;
            justify-content: center;
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

        .btn-danger {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
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
            text-align: left;
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
            <h1>Delete Project</h1>
            <?php if ($error): ?><div class="error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
            <p>Are you sure you want to delete <b><?php echo htmlspecialchars($name); ?></b>? This cannot be undone.</p>
            <form method="post">
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <div class="btn-row">
                    <button type="submit" name="confirm" value="1" class="btn btn-danger">Yes, Delete</button>
                    <a href="ssearch.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>