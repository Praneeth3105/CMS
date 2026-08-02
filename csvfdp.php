<?php
// ============================================================
// This is an admin bulk-upload page (no logged-in faculty session
// involved). faculty_id now comes straight from a column in the CSV
// itself — see the $faculty_id line inside the row-parsing loop below.
// Everything else — the CSV parsing, date handling, preview table,
// styling — is untouched.
// ============================================================
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

    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {

        $file = $_FILES['csvFile']['tmp_name'];
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
            $failed = 0;

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                echo "<tr>";

                foreach ($data as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }

                echo "</tr>";

                // CSV Mapping
                // Change these indexes according to your CSV columns

                $name       = mysqli_real_escape_string($conn, isset($data[0]) ? $data[0] : "");
                $department = mysqli_real_escape_string($conn, isset($data[1]) ? $data[1] : "");
                $fdpname    = mysqli_real_escape_string($conn, isset($data[2]) ? $data[2] : "");
                $org        = mysqli_real_escape_string($conn, isset($data[3]) ? $data[3] : "");
                $mode       = mysqli_real_escape_string($conn, isset($data[4]) ? $data[4] : "");
                $duration   = mysqli_real_escape_string($conn, isset($data[5]) ? $data[5] : "");

                $startdate = "";
                $enddate   = "";

                $dateText = trim($data[6]);

                if (!empty($dateText)) {

                    if (stripos($dateText, "TO") !== false) {

                        $parts = explode("TO", $dateText);

                        $startdate = trim($parts[0]);

                        if (isset($parts[1])) {
                            $enddate = trim($parts[1]);
                        } else {
                            $enddate = "";
                        }
                    } else {
                        $startdate = $dateText;
                    }

                    // convert start date
                    $startdate = date("Y-m-d", strtotime(str_replace("/", "-", $startdate)));

                    // convert end date
                    if (!empty($enddate))
                        $enddate = date("Y-m-d", strtotime(str_replace("/", "-", $enddate)));
                }

                $certificatelink = mysqli_real_escape_string($conn, trim($data[8] ?? ""));

                // NEW: faculty_id now comes straight from the CSV row itself
                // (this is the new column you're adding to the CSV).
                // Index 9 = 10th column — change this number if you put the
                // faculty_id column somewhere else in your sheet.
                //
                // NOTE: this must contain the same value the rest of the system
                // uses as faculty_id — check with whoever built the login/search
                // pages whether that's rollno or username, they are NOT the same
                // column in your `login` table.
                $faculty_id = mysqli_real_escape_string($conn, isset($data[9]) ? trim($data[9]) : "");

                $sql = "INSERT INTO fdp
        (
            name,
            department,
            fdpname,
            org,
            mode,
            duration,
            startdate,
            enddate,
            certificate_link,
            faculty_id
        )

        VALUES
        (
            '$name',
            '$department',
            '$fdpname',
            '$org',
            '$mode',
            '$duration',
            '$startdate',
            '$enddate',
            '$certificatelink',
            '$faculty_id'
        )";

                if (mysqli_query($conn, $sql)) {
                    $success++;
                } else {
                    $failed++;

                    echo "<p class='status-error'>MySQL Error : " . mysqli_error($conn) . "</p>";
                }
            }

            fclose($handle);

            echo "</table>";
            echo "</div>"; // .table-scroll

            echo "<br>";

            echo '<p class="status-success"><i class="fa fa-check-circle"></i> CSV Data Uploaded Successfully.</p>';
            if ($failed > 0) {
                echo "<p class='status-error'>Failed : $failed</p>";
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