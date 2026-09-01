<?php
include "db_conn.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$uname = $_SESSION['username'];
$errorMsg = "";

function resolveStudentPicUrl($pic)
{
    if (empty($pic)) {
        return null;
    }

    $picClean = ltrim(str_replace('\\', '/', $pic), '/');
    $needle = basename($picClean);

    $candidates = [
        'images/student_profile/' . $needle,
        'images/' . $picClean,
        'images/' . $needle,
    ];
    foreach ($candidates as $rel) {
        if (file_exists(__DIR__ . '/' . $rel)) {
            return $rel;
        }
    }

    $imagesRoot = __DIR__ . '/images';
    if (is_dir($imagesRoot)) {
        $it = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($imagesRoot, FilesystemIterator::SKIP_DOTS)
        );
        foreach ($it as $file) {
            if ($file->isFile() && strcasecmp($file->getFilename(), $needle) === 0) {
                return str_replace('\\', '/', substr($file->getPathname(), strlen(__DIR__) + 1));
            }
        }
    }

    return null;
}

// ---- Handle update submission ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $name       = trim($_POST['name'] ?? '');
    $num        = trim($_POST['number'] ?? '');
    $year       = trim($_POST['year'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $add        = trim($_POST['address'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $acc        = trim($_POST['acc'] ?? '');
    $oldimage   = trim($_POST['oldimage'] ?? '');

    // Look up the current pic value fresh from the DB, so we never trust
    // a hidden field alone for what to delete / fall back to.
    $curStmt = mysqli_prepare($conn, "SELECT pic FROM studentdetails WHERE username = ?");
    mysqli_stmt_bind_param($curStmt, "s", $uname);
    mysqli_stmt_execute($curStmt);
    $curRes = mysqli_stmt_get_result($curStmt);
    $curRow = mysqli_fetch_assoc($curRes);
    mysqli_stmt_close($curStmt);
    $currentPic = $curRow['pic'] ?? $oldimage;

    $newPicName = $currentPic; // default: keep existing photo unless a new one is uploaded

    $hasNewFile = isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE;

    if ($hasNewFile) {
        $file = $_FILES['file'];

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
                $uploadDir = __DIR__ . '/images/student_profile/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $newPicName = 'student_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $uname) . '_' . time() . '.' . $ext;
                $destPath = $uploadDir . $newPicName;

                if (move_uploaded_file($file['tmp_name'], $destPath)) {
                    // Clean up the old photo, wherever it actually is.
                    $oldResolved = resolveStudentPicUrl($currentPic);
                    if ($oldResolved && basename($oldResolved) !== $newPicName) {
                        @unlink(__DIR__ . '/' . $oldResolved);
                    }
                } else {
                    $errorMsg = "Could not save the uploaded file.";
                    $newPicName = $currentPic; // fall back, don't null out an existing photo
                }
            }
        }
    }

    if ($errorMsg === "") {
        $sql = "UPDATE studentdetails SET
                name = ?,
                number = ?,
                location = ?,
                email = ?,
                department = ?,
                year = ?,
                pic = ?,
                academic_year = ?
                WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "sssssssss",
                $name,
                $num,
                $add,
                $email,
                $department,
                $year,
                $newPicName,
                $acc,
                $uname
            );
            $res = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($res) {
                echo "<script>
                        alert('Data Updated Successfully');
                        window.location='studentdat.php';
                      </script>";
                exit;
            } else {
                $errorMsg = "Data not updated: " . mysqli_error($conn);
            }
        } else {
            $errorMsg = "Query preparation failed: " . mysqli_error($conn);
        }
    }
}

// ---- Fetch current record for the form ----
$stmt = mysqli_prepare($conn, "SELECT * FROM studentdetails WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $uname);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$row) {
    die("Record not found.");
}

$picUrl = resolveStudentPicUrl($row['pic'] ?? null);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CERTIFICATE MAINTENANCE SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --dark: #1c1510;
            --dark-2: #241b14;
            --gold: #c9a227;
            --gold-light: #d9b84a;
            --cream: #f5efe4;
            --card-bg: #ffffff;
            --text-dark: #2b2318;
            --text-muted: #6b6155;
            --border: #e6ddc9;
            --danger: #a0522d;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            background: var(--cream);
            color: var(--text-dark);
        }

        .topbar {
            background: linear-gradient(180deg, var(--dark) 0%, var(--dark-2) 100%);
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--gold);
        }

        .topbar h1 {
            color: #f2ead8;
            font-size: 22px;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .topbar h1 span {
            color: var(--gold-light);
        }

        .btn {
            font-family: Georgia, serif;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.4px;
            padding: 10px 22px;
            border-radius: 999px;
            border: 1px solid var(--gold);
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-dark {
            background: var(--dark);
            color: var(--gold-light);
        }

        .btn-dark:hover {
            background: #000;
        }

        .btn-gold {
            background: var(--gold);
            color: var(--dark);
            border-color: var(--gold);
        }

        .btn-gold:hover {
            background: var(--gold-light);
        }

        .n {
            text-decoration: none;
        }

        .page-heading {
            text-align: center;
            margin: 34px 0 22px;
        }

        .page-heading .eyebrow {
            color: var(--text-muted);
            letter-spacing: 3px;
            font-size: 12px;
            text-transform: uppercase;
            font-family: Arial, sans-serif;
            margin-bottom: 6px;
        }

        .page-heading h2 {
            font-size: 30px;
            margin: 0;
            color: var(--text-dark);
        }

        .page-heading h2 span {
            color: #a0522d;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto 60px;
            padding: 0 24px;
        }

        .form-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(28, 21, 16, 0.08);
            padding: 40px;
        }

        .error-msg {
            background: #fbeae4;
            color: var(--danger);
            border: 1px solid #eec4b4;
            padding: 12px 16px;
            border-radius: 8px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 22px;
        }

        /* ---- Profile photo upload block ---- */
        .photo-upload-row {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 8px;
        }

        .photo-preview {
            width: 84px;
            height: 84px;
            min-width: 84px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--cream);
            border: 3px solid var(--gold);
            box-shadow: 0 4px 12px rgba(28, 21, 16, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: var(--text-muted);
            text-align: center;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-controls {
            flex: 1;
        }

        .file-input-wrap {
            position: relative;
            display: inline-block;
        }

        .file-input-wrap input[type=file] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-input-label {
            display: inline-block;
            font-family: Arial, sans-serif;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 18px;
            border-radius: 999px;
            border: 1px solid var(--gold);
            background: var(--cream);
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-input-wrap:hover .file-input-label {
            background: var(--gold);
            color: var(--dark);
        }

        .file-hint {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 8px;
        }

        /* ---- end profile photo upload block ---- */

        .parent {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .child {
            flex: 1;
            min-width: 260px;
        }

        label {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: var(--text-muted);
            letter-spacing: 0.3px;
            display: block;
            margin-top: 16px;
            margin-bottom: 6px;
        }

        input[type=text],
        input[type=password],
        input[type=email],
        select {
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 15px;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #faf7f0;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s ease;
        }

        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        select:focus {
            border-color: var(--gold);
        }

        select {
            appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, var(--text-muted) 50%),
                linear-gradient(135deg, var(--text-muted) 50%, transparent 50%);
            background-position: calc(100% - 18px) calc(1em + 4px), calc(100% - 13px) calc(1em + 4px);
            background-size: 5px 5px, 5px 5px;
            background-repeat: no-repeat;
        }

        .submit-row {
            text-align: center;
            margin-top: 32px;
        }

        .submit-row input[type=submit] {
            width: 30%;
            min-width: 180px;
            font-family: Georgia, serif;
            font-weight: 600;
            font-size: 15px;
            padding: 12px 22px;
            border-radius: 999px;
            border: 1px solid var(--gold);
            background: var(--gold);
            color: var(--dark);
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .submit-row input[type=submit]:hover {
            background: var(--gold-light);
        }
    </style>
</head>

<body>

    <div class="topbar">
        <h1>Certificate <span>Management</span> System</h1>
        <a href="studentdat.php" class="n"><button type="button" class="btn btn-dark">&larr; Back</button></a>
    </div>

    <div class="page-heading">
        <div class="eyebrow">Digital Records, Verified</div>
        <h2>Update <span>Details</span></h2>
    </div>

    <div class="form-container">
        <div class="form-card">

            <?php if ($errorMsg): ?>
                <div class="error-msg"><?php echo htmlspecialchars($errorMsg); ?></div>
            <?php endif; ?>

            <form method='POST' action='' enctype='multipart/form-data'>
                <div class="parent">
                    <div class="child">
                        <label for="name">Name</label>
                        <input type="text" placeholder="Enter Your Name" value='<?php echo htmlspecialchars($row['name']); ?>' name="name" id="name" required>

                        <label for="number">Phone Number</label>
                        <input type="text" placeholder="Enter Phone Number" name="number" value='<?php echo htmlspecialchars($row['number']); ?>' id="number" required>

                        <label for="department">Department</label>
                        <select name="department" id="department" required>
                            <option value="">Branch</option>
                            <?php foreach (['CSM', 'CSE', 'CIC', 'CSO', 'EEE', 'ECE', 'MECH', 'CIVIL', 'CSD'] as $dept): ?>
                                <option value="<?php echo $dept; ?>" <?php echo ($row['department'] === $dept) ? 'selected' : ''; ?>><?php echo $dept; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="year">Year</label>
                        <select id='year' name='year' required>
                            <option value="">Year</option>
                            <?php foreach (['1', '2', '3', '4'] as $yr): ?>
                                <option value="<?php echo $yr; ?>" <?php echo ((string) $row['year'] === $yr) ? 'selected' : ''; ?>><?php echo $yr; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="child">
                        <label for="address">Address</label>
                        <input type="text" placeholder="Enter Your Address" value='<?php echo htmlspecialchars($row['location']); ?>' name="address" id="address" required>

                        <label for="email">Email</label>
                        <input type="email" placeholder="Enter Email" name="email" value='<?php echo htmlspecialchars($row['email']); ?>' id="email" required>

                        <label for="academic">Academic Year</label>
                        <select id='academic' name='acc' required>
                            <option value="">Academic Year</option>
                            <?php foreach (['2019-2023', '2020-2024', '2021-2025', '2022-2026', '2023-2027'] as $acc): ?>
                                <option value="<?php echo $acc; ?>" <?php echo ($row['academic_year'] === $acc) ? 'selected' : ''; ?>><?php echo $acc; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="photo">Profile Photo</label>
                        <div class="photo-upload-row">
                            <div class="photo-preview">
                                <?php if ($picUrl): ?>
                                    <img src="<?php echo htmlspecialchars($picUrl); ?>" alt="Current photo">
                                <?php else: ?>
                                    No photo
                                <?php endif; ?>
                            </div>
                            <div class="photo-controls">
                                <div class="file-input-wrap">
                                    <span class="file-input-label" id="fileLabel">Choose Photo</span>
                                    <input type="file" name="file" id="photo"
                                        accept="image/jpeg,image/png,image/gif,image/webp"
                                        onchange="document.getElementById('fileLabel').textContent = this.files[0] ? this.files[0].name : 'Choose Photo'">
                                </div>
                                <div class="file-hint">Leave empty to keep your current photo.</div>
                            </div>
                        </div>
                        <input type='hidden' name='oldimage' value='<?php echo htmlspecialchars($row['pic'] ?? ''); ?>'>
                    </div>
                </div>

                <div class="submit-row">
                    <input type='submit' value='Update' name='submit'>
                </div>
            </form>
        </div>
    </div>

</body>

</html>