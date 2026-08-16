<?php
session_start();
include "db_conn.php";

$id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
if (!$id) {
    die("No record id provided.");
}

$successMsg = "";
$errorMsg = "";

function fetch_row($conn, $id)
{
    $stmt = mysqli_prepare($conn, "SELECT * FROM `conferences` WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $r = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $r;
}

// Fetch current record first, so POST handling can fall back to existing file values
$row = fetch_row($conn, $id);
if (!$row) {
    die("Record not found for id: " . htmlspecialchars($id));
}

// Handle update submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $academic_year = trim($_POST['academic_year'] ?? '');
    $faculty_name = trim($_POST['faculty_name'] ?? '');
    $co_authors_count = trim($_POST['co_authors_count'] ?? '');
    $author_type = trim($_POST['author_type'] ?? '');
    $paper_title = trim($_POST['paper_title'] ?? '');
    $conference_proceedings = trim($_POST['conference_proceedings'] ?? '');
    $ugc_scopus = trim($_POST['ugc_scopus'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $doi = trim($_POST['doi'] ?? '');
    $start_date = trim($_POST['start_date'] ?? '');
    $end_date = trim($_POST['end_date'] ?? '');

    // Handle optional file re-upload for proof_link
    $proof_link = $row['proof_link']; // keep existing by default
    if (isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $origName = basename($_FILES['upload_file']['name']);
        $safeName = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $origName);
        $destPath = $uploadDir . $safeName;
        if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $destPath)) {
            $proof_link = $safeName;
        } else {
            $errorMsg = "File upload failed, keeping the existing file.";
        }
    }

    if (empty($errorMsg)) {
        $sql = "UPDATE `conferences` SET `academic_year` = ?, `faculty_name` = ?, `co_authors_count` = ?, `author_type` = ?, `paper_title` = ?, `conference_proceedings` = ?, `ugc_scopus` = ?, `url` = ?, `doi` = ?, `start_date` = ?, `end_date` = ?, `proof_link` = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssssssssss", $academic_year, $faculty_name, $co_authors_count, $author_type, $paper_title, $conference_proceedings, $ugc_scopus, $url, $doi, $start_date, $end_date, $proof_link, $id);
            if (mysqli_stmt_execute($stmt)) {
                $successMsg = "Record updated successfully.";
                $row = fetch_row($conn, $id); // refresh with latest saved values
            } else {
                $errorMsg = "Update failed: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            $errorMsg = "Query preparation failed: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Conference Paper</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #16130f;
            background-image: radial-gradient(circle at top, #221c14 0%, #16130f 60%);
            font-family: 'Poppins', sans-serif;
            color: #f5f0e6;
            min-height: 100vh;
        }

        .wrap {
            max-width: 760px;
            margin: 40px auto;
            padding: 0 20px 60px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .back-link {
            color: #d4af37;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border: 1px solid #d4af37;
            padding: 8px 16px;
            border-radius: 6px;
            transition: .2s;
        }

        .back-link:hover {
            background: #d4af37;
            color: #16130f;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: #d4af37;
            font-size: 30px;
            margin: 0 0 4px;
            border-bottom: 1px solid #3a3225;
            padding-bottom: 14px;
        }

        .subtitle {
            color: #b8ad95;
            font-size: 13px;
            margin-bottom: 28px;
        }

        .card {
            background: #1f1a13;
            border: 1px solid #3a3225;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
        }

        .msg {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .msg.success {
            background: #22331f;
            color: #9fe08a;
            border: 1px solid #3f6b32;
        }

        .msg.error {
            background: #331f1f;
            color: #e08a8a;
            border: 1px solid #6b3232;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 22px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 12.5px;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: #d4af37;
            font-weight: 600;
        }

        input[type=text],
        input[type=date],
        input[type=number],
        textarea,
        select {
            background: #14110c;
            border: 1px solid #443a29;
            color: #f5f0e6;
            padding: 11px 12px;
            border-radius: 7px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color .2s;
        }

        input:focus,
        textarea:focus {
            border-color: #d4af37;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        .current-file {
            font-size: 12.5px;
            color: #b8ad95;
            margin-top: 4px;
        }

        .current-file a {
            color: #d4af37;
        }

        input[type=file] {
            color: #b8ad95;
            font-size: 13px;
        }

        .actions {
            grid-column: 1 / -1;
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        button.save {
            background: linear-gradient(135deg, #d4af37, #b8912b);
            border: none;
            color: #16130f;
            font-weight: 700;
            padding: 13px 28px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14.5px;
            transition: transform .15s, box-shadow .15s;
        }

        button.save:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(212, 175, 55, .35);
        }

        @media (max-width: 640px) {
            form {
                grid-template-columns: 1fr;
            }
        }
    </style>

</head>

<body>
    <div class="wrap">
        <div class="topbar">
            <a href="fsearch.php" class="back-link">&larr; Back</a>
        </div>

        <h1>Edit Conference Paper</h1>
        <div class="subtitle">Table: conferences &middot; Record ID: <?php echo htmlspecialchars($id); ?></div>

        <div class="card">
            <?php if ($successMsg): ?>
                <div class="msg success"><?php echo htmlspecialchars($successMsg); ?></div>
            <?php endif; ?>
            <?php if ($errorMsg): ?>
                <div class="msg error"><?php echo htmlspecialchars($errorMsg); ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <div class="field">
                    <label for="academic_year">Academic Year</label>
                    <input type="text" name="academic_year" id="academic_year" value="<?php echo htmlspecialchars($row['academic_year'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="faculty_name">Faculty Name</label>
                    <input type="text" name="faculty_name" id="faculty_name" value="<?php echo htmlspecialchars($row['faculty_name'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="co_authors_count">Co-authors Count</label>
                    <input type="number" name="co_authors_count" id="co_authors_count" value="<?php echo htmlspecialchars($row['co_authors_count'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="author_type">Author Type</label>
                    <input type="text" name="author_type" id="author_type" value="<?php echo htmlspecialchars($row['author_type'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="paper_title">Paper Title</label>
                    <input type="text" name="paper_title" id="paper_title" value="<?php echo htmlspecialchars($row['paper_title'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="conference_proceedings">Conference / Proceedings</label>
                    <input type="text" name="conference_proceedings" id="conference_proceedings" value="<?php echo htmlspecialchars($row['conference_proceedings'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="ugc_scopus">UGC / Scopus</label>
                    <input type="text" name="ugc_scopus" id="ugc_scopus" value="<?php echo htmlspecialchars($row['ugc_scopus'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" value="<?php echo htmlspecialchars($row['url'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="doi">DOI</label>
                    <input type="text" name="doi" id="doi" value="<?php echo htmlspecialchars($row['doi'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="<?php echo htmlspecialchars($row['start_date'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="<?php echo htmlspecialchars($row['end_date'] ?? ''); ?>">
                </div>

                <div class="field full">
                    <label for="upload_file">Proof / Certificate File (leave empty to keep current file)</label>
                    <input type="file" name="upload_file" id="upload_file">
                    <?php if (!empty($row['proof_link'])): ?>
                        <div class="current-file">Current file: <a href="images/<?php echo htmlspecialchars($row['proof_link']); ?>" target="_blank"><?php echo htmlspecialchars($row['proof_link']); ?></a></div>
                    <?php endif; ?>
                </div>

                <div class="actions">
                    <button type="submit" class="save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>