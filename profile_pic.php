<?php
session_start();
include "db_conn.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$faculty_id = $_SESSION['id'];
$errorMsg = "";
$successMsg = "";

// ---- Handle upload ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
    $file = $_FILES['profile_pic'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errorMsg = "Upload failed. Please try again.";
    } else {
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $maxSize = 3 * 1024 * 1024; // 3MB

        if (!in_array($ext, $allowedExt)) {
            $errorMsg = "Only JPG, PNG, GIF, or WEBP images are allowed.";
        } elseif ($file['size'] > $maxSize) {
            $errorMsg = "Image must be smaller than 3MB.";
        } else {
            $uploadDir = __DIR__ . '/images/profile/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Delete the old photo first, if one exists
            $oldStmt = mysqli_prepare($conn, "SELECT profile_pic FROM faculty WHERE id = ?");
            mysqli_stmt_bind_param($oldStmt, "s", $faculty_id);
            mysqli_stmt_execute($oldStmt);
            $oldRes = mysqli_stmt_get_result($oldStmt);
            $oldRow = mysqli_fetch_assoc($oldRes);
            mysqli_stmt_close($oldStmt);

            if ($oldRow && !empty($oldRow['profile_pic'])) {
                $oldPath = $uploadDir . basename($oldRow['profile_pic']);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $newName = 'faculty_' . $faculty_id . '_' . time() . '.' . $ext;
            $destPath = $uploadDir . $newName;

            if (move_uploaded_file($file['tmp_name'], $destPath)) {
                $updStmt = mysqli_prepare($conn, "UPDATE faculty SET profile_pic = ? WHERE id = ?");
                mysqli_stmt_bind_param($updStmt, "ss", $newName, $faculty_id);
                if (mysqli_stmt_execute($updStmt)) {
                    $successMsg = "Profile picture updated.";
                } else {
                    $errorMsg = "Could not save to database: " . mysqli_error($conn);
                }
                mysqli_stmt_close($updStmt);
            } else {
                $errorMsg = "Could not save the uploaded file.";
            }
        }
    }
}

// ---- Fetch current photo to display ----
$stmt = mysqli_prepare($conn, "SELECT name, profile_pic FROM faculty WHERE id = ?");
mysqli_stmt_bind_param($stmt, "s", $faculty_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Profile Picture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark: #1a120b;
            --dark-2: #2b1d13;
            --gold: #d4af37;
            --gold-soft: #c9a227;
            --gold-pale: #f0e2b8;
            --cream: #f5efe6;
            --cream-card: #fffdf8;
            --border: #e6ddc8;
            --muted: #8a7d6b;
            --danger: #b5502e;
            --radius: 22px;
            --shadow-lg: 0 20px 45px rgba(26, 18, 11, .16);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--cream);
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            margin: 0;
            padding-bottom: 60px;
        }

        .topbar {
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 100%);
            padding: 18px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
        }

        .brand span {
            color: var(--gold);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--gold-pale);
            border: 1.5px solid var(--gold-soft);
            border-radius: 999px;
            padding: 10px 22px;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background: var(--gold);
            color: var(--dark);
        }

        .wrap {
            max-width: 520px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .panel {
            background: var(--cream-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 44px 40px;
            text-align: center;
        }

        h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            margin: 0 0 6px;
        }

        .sub {
            color: var(--muted);
            font-size: 13.5px;
            margin-bottom: 30px;
        }

        .preview {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            margin: 0 auto 26px;
            background: linear-gradient(145deg, var(--gold-pale), #fff);
            box-shadow: 0 0 0 5px #fff, 0 0 0 6px var(--gold-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview svg {
            width: 60px;
            height: 60px;
        }

        input[type=file] {
            width: 100%;
            padding: 12px;
            background: var(--cream);
            border: 1.5px dashed var(--gold);
            border-radius: 10px;
            cursor: pointer;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
        }

        .msg {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13.5px;
            font-weight: 600;
        }

        .msg.success {
            background: #22331f;
            color: #9fe08a;
        }

        .msg.error {
            background: #331f1f;
            color: #e08a8a;
        }

        input[type=submit] {
            background: var(--dark);
            color: var(--gold-pale);
            border: 1.5px solid var(--gold);
            border-radius: 999px;
            padding: 12px 34px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background: var(--gold);
            color: var(--dark);
        }

        .back-link {
            display: block;
            margin-top: 22px;
            font-size: 13px;
            color: var(--muted);
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--gold-soft);
        }
    </style>
</head>

<body>
    <div class="topbar">
        <div class="brand">Certificate <span>Management</span> System</div>
        <a href="facultydat.php" class="btn">Back</a>
    </div>

    <div class="wrap">
        <div class="panel">
            <h2>Update Profile Picture</h2>
            <div class="sub">Faculty: <?php echo htmlspecialchars($row['name'] ?? ''); ?></div>

            <?php if ($successMsg): ?>
                <div class="msg success"><?php echo htmlspecialchars($successMsg); ?></div>
            <?php endif; ?>
            <?php if ($errorMsg): ?>
                <div class="msg error"><?php echo htmlspecialchars($errorMsg); ?></div>
            <?php endif; ?>

            <div class="preview">
                <?php if (!empty($row['profile_pic'])): ?>
                    <img src="images/profile/<?php echo htmlspecialchars($row['profile_pic']); ?>" alt="Profile photo">
                <?php else: ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="#b5502e" stroke-width="1.6">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 20c0-4.4 3.6-7 8-7s8 2.6 8 7" stroke-linecap="round" />
                    </svg>
                <?php endif; ?>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="profile_pic" accept="image/jpeg,image/png,image/gif,image/webp" required>
                <br>
                <input type="submit" value="Upload Photo">
            </form>

            <a href="facultydat.php" class="back-link">&larr; Back to profile</a>
        </div>
    </div>
</body>

</html>