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
    $stmt = mysqli_prepare($conn, "SELECT * FROM `bookedited` WHERE id = ?");
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
    $faculty_name = trim($_POST['faculty_name'] ?? '');
    $no_of_authors = trim($_POST['no_of_authors'] ?? '');
    $book_name = trim($_POST['book_name'] ?? '');
    $publisher_name = trim($_POST['publisher_name'] ?? '');
    $isbn_number = trim($_POST['isbn_number'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $academic_year = trim($_POST['academic_year'] ?? '');
    $month = trim($_POST['month'] ?? '');
    $start_date = trim($_POST['start_date'] ?? '');
    $end_date = trim($_POST['end_date'] ?? '');

    // proof_link is now a plain URL/link entered by the user, not an uploaded file.
    $proof_link = trim($_POST['proof_link'] ?? '');
    if ($proof_link === '') {
        $proof_link = $row['proof_link'];
    }

    if (empty($errorMsg)) {
        $sql = "UPDATE `bookedited` SET `faculty_name` = ?, `no_of_authors` = ?, `book_name` = ?, `publisher_name` = ?, `isbn_number` = ?, `url` = ?, `academic_year` = ?, `month` = ?, `start_date` = ?, `end_date` = ?, `proof_link` = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $faculty_name, $no_of_authors, $book_name, $publisher_name, $isbn_number, $url, $academic_year, $month, $start_date, $end_date, $proof_link, $id);
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
    <title>Edit Book Edited</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --dark: #1a120b;
            --dark-2: #2b1d13;
            --gold: #d4af37;
            --gold-soft: #c9a227;
            --gold-pale: #f0e2b8;
            --accent: #c1663b;
            --cream: #f2ece1;
            --cream-card: #fffdf9;
            --box: #f4ecdf;
            --border: #e8dfc9;
            --muted: #8a7d6b;
            --danger: #b6432f;
            --shadow: 0 10px 28px rgba(120, 100, 60, .10);
            --shadow-lg: 0 20px 45px rgba(26, 18, 11, .14);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--cream);
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
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
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border: 1px solid var(--gold-soft);
            padding: 8px 16px;
            border-radius: 999px;
            transition: .2s;
        }

        .back-link:hover {
            background: var(--gold);
            color: var(--dark);
            border-color: var(--gold);
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
            font-size: 30px;
            margin: 0 0 4px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 14px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 28px;
        }

        .card {
            background: var(--cream-card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 30px;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--accent), var(--gold) 50%, var(--accent));
        }

        .msg {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .msg.success {
            background: #eaf5e6;
            color: #2f6b23;
            border: 1px solid #a9d69c;
        }

        .msg.error {
            background: #fbeae7;
            color: var(--danger);
            border: 1px solid #e3b3a7;
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
            color: var(--gold-soft);
            font-weight: 700;
        }

        input[type=text],
        input[type=url],
        input[type=date],
        input[type=number],
        textarea,
        select {
            background: var(--box);
            border: 1px solid var(--border);
            color: var(--dark);
            padding: 11px 12px;
            border-radius: 7px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        input:focus,
        textarea:focus {
            border-color: var(--gold-soft);
            background: var(--cream-card);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, .18);
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        .field-hint {
            font-size: 12.5px;
            color: var(--muted);
        }

        .current-file {
            font-size: 12.5px;
            color: var(--muted);
            margin-top: 4px;
        }

        .current-file a {
            color: var(--accent);
        }

        input[type=file] {
            color: var(--muted);
            font-size: 13px;
        }

        .actions {
            grid-column: 1 / -1;
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        button.save {
            background: linear-gradient(135deg, var(--gold), var(--gold-soft));
            border: none;
            color: var(--dark);
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

        <h1>Edit Book Edited</h1>
        <div class="subtitle">Table: bookedited &middot; Record ID: <?php echo htmlspecialchars($id); ?></div>

        <div class="card">
            <?php if ($successMsg): ?>
                <div class="msg success"><?php echo htmlspecialchars($successMsg); ?></div>
            <?php endif; ?>
            <?php if ($errorMsg): ?>
                <div class="msg error"><?php echo htmlspecialchars($errorMsg); ?></div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <div class="field">
                    <label for="faculty_name">Faculty Name</label>
                    <input type="text" name="faculty_name" id="faculty_name" value="<?php echo htmlspecialchars($row['faculty_name'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="no_of_authors">No. of Authors</label>
                    <input type="number" name="no_of_authors" id="no_of_authors" value="<?php echo htmlspecialchars($row['no_of_authors'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="book_name">Book Name</label>
                    <input type="text" name="book_name" id="book_name" value="<?php echo htmlspecialchars($row['book_name'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="publisher_name">Publisher Name</label>
                    <input type="text" name="publisher_name" id="publisher_name" value="<?php echo htmlspecialchars($row['publisher_name'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="isbn_number">ISBN Number</label>
                    <input type="text" name="isbn_number" id="isbn_number" value="<?php echo htmlspecialchars($row['isbn_number'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" value="<?php echo htmlspecialchars($row['url'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="academic_year">Academic Year</label>
                    <input type="text" name="academic_year" id="academic_year" value="<?php echo htmlspecialchars($row['academic_year'] ?? ''); ?>">
                </div>

                <div class="field">
                    <label for="month">Month</label>
                    <input type="text" name="month" id="month" value="<?php echo htmlspecialchars($row['month'] ?? ''); ?>">
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
                    <label for="proof_link">Proof / Certificate Link (paste a URL; leave empty to keep the current link)</label>
                    <input type="url" name="proof_link" id="proof_link" placeholder="https://...">
                    <?php if (!empty($row['proof_link'])): ?>
                        <div class="current-file">Current link: <a href="<?php echo htmlspecialchars($row['proof_link']); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($row['proof_link']); ?></a></div>
                    <?php else: ?>
                        <div class="field-hint">No link saved yet.</div>
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