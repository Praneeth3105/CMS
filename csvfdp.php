<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FDP CSV Upload | Certificate Management System</title>
    <link rel="icon" type="image/x-icon" href="icon2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --dark: #1a120b;
            --dark-2: #2b1d13;
            --gold: #d4af37;
            --gold-soft: #c9a227;
            --gold-pale: #f0e2b8;
            --cream: #f5efe6;
            --cream-card: #fffdf8;
            --rust: #b5502e;
            --radius: 18px;
            --radius-sm: 10px;
            --shadow: 0 10px 30px rgba(26, 18, 11, 0.15);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            overflow-x: hidden;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .n {
            text-decoration: none;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 32px;
            background: linear-gradient(120deg, var(--dark) 0%, var(--dark-2) 100%);
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--cream);
            letter-spacing: 0.3px;
            margin: 0;
        }

        .brand span {
            color: var(--gold);
        }

        .btn,
        #btn1 {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 26px;
            background: var(--dark-2);
            color: var(--gold-pale) !important;
            border: 1px solid var(--gold-soft);
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.4px;
            cursor: pointer;
            transition: all 0.25s ease;
            text-transform: uppercase;
            float: none !important;
            width: auto !important;
        }

        .btn:hover,
        #btn1:hover {
            background: var(--gold);
            color: var(--dark) !important;
            border-color: var(--gold);
            transform: translateY(-1px);
        }

        .page-hero {
            text-align: center;
            padding: 48px 24px 32px;
        }

        .page-hero .eyebrow {
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 0.75rem;
            color: var(--rust);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .page-hero h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.1rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0 0 8px;
        }

        .page-hero h2 .accent {
            color: var(--gold-soft);
        }

        .page-hero p {
            color: #6b6153;
            max-width: 520px;
            margin: 0 auto;
            font-size: 0.95rem;
        }

        .upload-card {
            max-width: 560px;
            margin: 0 auto 48px;
            background: var(--cream-card);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 40px 36px;
            text-align: center;
            border: 1px solid rgba(212, 175, 55, 0.25);
        }

        .upload-card label {
            display: block;
            font-weight: 600;
            color: var(--dark-2);
            margin-bottom: 14px;
            font-size: 0.95rem;
        }

        .upload-card input[type="file"] {
            display: block;
            width: 100%;
            padding: 14px;
            border: 2px dashed var(--gold-soft);
            border-radius: var(--radius-sm);
            background: #fbf7ee;
            color: var(--dark-2);
            font-family: 'Poppins', sans-serif;
            margin-bottom: 22px;
            cursor: pointer;
        }

        .upload-card input[type="submit"] {
            padding: 13px 34px;
            background: var(--dark);
            color: var(--gold-pale);
            border: 1px solid var(--gold-soft);
            border-radius: 999px;
            font-weight: 600;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .upload-card input[type="submit"]:hover {
            background: var(--gold);
            color: var(--dark);
        }

        .preview-wrap {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto 60px;
            padding: 0 32px;
        }

        .preview-wrap h3 {
            font-family: 'Playfair Display', serif;
            color: var(--dark-2);
            font-size: 1.3rem;
            margin-bottom: 14px;
            text-align: center;
        }

        .table-scroll {
            width: 100%;
            overflow-x: auto;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(212, 175, 55, 0.25);
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            background: var(--cream-card);
            border-radius: var(--radius);
            overflow: hidden;
        }

        th {
            background: var(--dark);
            color: var(--gold-pale);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            text-align: left;
            border: none;
            white-space: nowrap;
        }

        td {
            padding: 13px 16px;
            border-bottom: 1px solid #ece3d1;
            font-size: 0.88rem;
            color: #4a4030;
            vertical-align: top;
            word-break: break-word;
            max-width: 260px;
        }

        tr:nth-child(even) td {
            background: #faf6ec;
        }

        tr:hover td {
            background: var(--gold-pale);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status-success {
            color: #2e7d32;
            font-weight: 600;
            background: #eaf6ea;
            border: 1px solid #b7dfb9;
            padding: 12px 20px;
            border-radius: 10px;
            width: fit-content;
            margin: 20px auto;
            text-align: center;
        }

        .status-error {
            color: var(--rust);
            font-weight: 600;
            background: #fbeae4;
            border: 1px solid #eec4b4;
            padding: 12px 20px;
            border-radius: 10px;
            width: fit-content;
            margin: 20px auto;
            text-align: center;
        }

        @media (max-width: 600px) {
            .preview-wrap {
                padding: 0 14px;
            }
        }
    </style>

</head>

<body>

    <div class="topbar">
        <a href="csvdataupload.php" class="n"><button type="button" class="btn" id="btn1">Back</button></a>
        <a href="logout.php" class="n"><button type="button" class="btn">Logout</button></a>
    </div>
    <div class="page-hero">
        <div class="eyebrow">Faculty Records</div>
        <h2>FDP Attended <span class="accent">CSV </span></h2>
        <p>Upload a CSV file to bulk-import Faculty Development Program (FDP) records.</p>
    </div>

    <div class="upload-card">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="csvFile"><i class="fa fa-file-csv"></i> Choose CSV File</label>
            <input type="file" name="csvFile" id="csvFile" accept=".csv" required>
            <input type="submit" value="Upload CSV">
        </form>
    </div>
    <?php
    include "db_conn.php";

    function parseFlexibleDate($dateStr)
    {
        $dateStr = (string) $dateStr;

        // Strip invisible/problematic characters Excel/CSV exports sometimes leave behind:
        // BOM, non-breaking spaces, zero-width spaces, stray control chars.
        $dateStr = str_replace(["\xC2\xA0", "\xEF\xBB\xBF", "\xE2\x80\x8B"], ' ', $dateStr);
        $dateStr = preg_replace('/[\x00-\x1F\x7F]/', '', $dateStr);
        $dateStr = trim($dateStr);

        if ($dateStr === '') {
            return null;
        }

        // Remove ordinal suffixes: "10th" -> "10"
        $dateStr = preg_replace('/(\d+)(st|nd|rd|th)\b/i', '$1', $dateStr);

        // Normalize dot and spaced-out dash separators to a single dash:
        // "19 -Dec-23" -> "19-Dec-23", "12.06.2024" -> "12-06-2024"
        $dateStr = preg_replace('/\s*-\s*/', '-', $dateStr);
        $dateStr = preg_replace('/(\d)\s*\.\s*(\d)/', '$1-$2', $dateStr);

        // Trim stray leading/trailing dashes, spaces
        $dateStr = trim($dateStr, "- \t\n\r\0\x0B");
        $dateStr = preg_replace('/\s+/', ' ', $dateStr);

        if ($dateStr === '') {
            return null;
        }

        $formats = [
            'Y-m-d',
            'Y/m/d',
            'Y.m.d',
            'd/m/Y',
            'd-m-Y',
            'd/m/y',
            'd-m-y',
            'd-M-y',
            'd-M-Y',
            'd M Y',
            'd M y',
            'm/d/Y',
            'm-d-Y',
            'M-d-Y',
            'M d Y',
            'M d, Y',
            'j F Y',
            'd F Y',
            'd-F-Y',
            'd.m.Y',
            'd.m.y',
        ];

        foreach ($formats as $fmt) {
            $d = DateTime::createFromFormat($fmt, $dateStr);
            if ($d !== false) {
                $errors = DateTime::getLastErrors();
                if ($errors === false || ($errors['warning_count'] === 0 && $errors['error_count'] === 0)) {
                    return $d->format('Y-m-d');
                }
            }
        }

        // "Month Year" only, e.g. "June 2025" -> 1st of that month
        if (preg_match('/^[A-Za-z]+ \d{4}$/', $dateStr)) {
            $d = DateTime::createFromFormat('F Y', $dateStr);
            if ($d !== false) {
                return $d->format('Y-m-01');
            }
        }

        // Excel serial date number, e.g. "45458" (days since 1899-12-30)
        if (preg_match('/^\d{5}$/', $dateStr)) {
            $unixTimestamp = ((int) $dateStr - 25569) * 86400;
            $converted = gmdate('Y-m-d', $unixTimestamp);
            if ($converted !== false) {
                return $converted;
            }
        }

        // Last resort: PHP's own guesser
        $timestamp = strtotime($dateStr);
        if ($timestamp !== false) {
            return date('Y-m-d', $timestamp);
        }

        return null;
    }

    // Returns a hex dump of a string so hidden/invisible characters are visible for debugging.
    function debugRawBytes($str)
    {
        $hex = bin2hex((string) $str);
        return implode(' ', str_split($hex, 2));
    }

    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {

        $file   = $_FILES['csvFile']['tmp_name'];
        $handle = fopen($file, "r");

        if ($handle) {

            // Skip Header Row
            $header = fgetcsv($handle, 1000, ",");

            echo '<div class="preview-wrap">';
            echo "<h3>CSV Preview</h3>";
            echo '<div class="table-scroll">';
            echo "<table>";
            echo "<tr>";

            foreach ($header as $head) {
                echo "<th>" . htmlspecialchars($head) . "</th>";
            }

            echo "</tr>";

            $success = 0;
            $failed  = 0;
            $unparsedDates = [];
            $rowNum = 1;

            // Prepare the insert once, outside the loop
            $stmt = $conn->prepare(
                "INSERT INTO fdp
                (name, department, fdpname, org, mode, duration, startdate, enddate, startdate_raw, enddate_raw, certificate_link, faculty_id)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            if (!$stmt) {
                echo "<p class='status-error'>Prepare failed: " . htmlspecialchars($conn->error) . "</p>";
                echo "</table></div></div>";
                $conn->close();
                exit;
            }

            $stmt->bind_param(
                "ssssssssssss",
                $name,
                $department,
                $fdpname,
                $org,
                $mode,
                $duration,
                $startdateParam,
                $enddateParam,
                $startRaw,
                $endRaw,
                $certificatelink,
                $faculty_id
            );

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $rowNum++;

                // Skip fully blank rows
                if (count(array_filter($data, fn($v) => trim($v) !== "")) === 0) {
                    continue;
                }

                $faculty_id  = isset($data[0]) ? trim($data[0]) : "";
                $name        = isset($data[1]) ? trim($data[1]) : "";
                $department  = isset($data[2]) ? trim($data[2]) : "";
                $fdpname     = isset($data[3]) ? trim($data[3]) : "";
                $org         = isset($data[4]) ? trim($data[4]) : "";
                $mode        = isset($data[5]) ? trim($data[5]) : "";
                $duration    = isset($data[6]) ? trim($data[6]) : "";
                $startRaw    = isset($data[7]) ? trim($data[7]) : "";
                $endRaw      = isset($data[8]) ? trim($data[8]) : "";
                $certificatelink = isset($data[9]) ? trim($data[9]) : "";

                $startdate = parseFlexibleDate($startRaw);
                $enddate   = parseFlexibleDate($endRaw);
                $startdateParam = $startdate; // null -> stored as NULL via bind_param
                $enddateParam   = $enddate;

                $rowHasBadDate = false;
                if ($startRaw !== '' && $startdate === null) {
                    $unparsedDates[] = "Row $rowNum, Start Date: \"$startRaw\" (bytes: " . debugRawBytes($startRaw) . ")";
                    $rowHasBadDate = true;
                }
                if ($endRaw !== '' && $enddate === null) {
                    $unparsedDates[] = "Row $rowNum, End Date: \"$endRaw\" (bytes: " . debugRawBytes($endRaw) . ")";
                    $rowHasBadDate = true;
                }

                echo "<tr>";
                foreach ($data as $colIndex => $value) {
                    $cellClass = '';
                    if ($rowHasBadDate && ($colIndex === 7 || $colIndex === 8)) {
                        $cellClass = ' class="bad-date"';
                    }
                    echo "<td" . $cellClass . ">" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";

                if ($stmt->execute()) {
                    $success++;
                } else {
                    $failed++;
                    echo "<p class='status-error'>MySQL Error: " . htmlspecialchars($stmt->error) . "</p>";
                }
            }

            $stmt->close();
            fclose($handle);

            echo "</table>";
            echo "</div>";
            echo "<br>";

            echo '<p class="status-success"><i class="fa fa-check-circle"></i> CSV Data Uploaded Successfully. Inserted: ' . $success . '</p>';
            if ($failed > 0) {
                echo "<p class='status-error'>Failed : $failed</p>";
            }

            if (!empty($unparsedDates)) {
                echo '<div class="status-warning"><i class="fa fa-exclamation-triangle"></i> ';
                echo count($unparsedDates) . ' date value(s) could not be understood and were saved as empty (highlighted above). The original text is still kept in startdate_raw / enddate_raw in the database, so nothing is lost — you can fix these manually:';
                echo '<ul>';
                foreach ($unparsedDates as $issue) {
                    echo '<li>' . htmlspecialchars($issue) . '</li>';
                }
                echo '</ul></div>';
            }

            echo '</div>'; // .preview-wrap
        } else {
            echo '<div class="preview-wrap"><p class="status-error">Unable to open CSV file.</p></div>';
        }
    }

    $conn->close();
    ?>
</body>

</html>