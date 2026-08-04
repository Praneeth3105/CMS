<?php
include "db_conn.php";
session_start();

// ===== GUARD: must be logged in =====
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
// =====================================
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="icon2.png">
    <title>CERTIFICATE MAINTANCE SYSTEM</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            --cream: #f5efe6;
            --dark: #1a120b;
            --dark-2: #2b1d13;
            --gold: #d4af37;
            --gold-soft: #c9a227;
            --gold-pale: #f0e2b8;
            --card: #fffdf8;
            --border: #e6ddc8;
            --rust: #b5502e;
            --zebra: #faf6ec;
            --shadow-light: 0 10px 30px rgba(26, 18, 11, .12);
            --shadow-heavy: 0 18px 34px rgba(26, 18, 11, .18);
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
            overflow-y: scroll;
        }

        .n {
            text-decoration: none;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--dark);
            padding: 18px 40px;
            box-shadow: var(--shadow-light);
        }

        .topbar .brand {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
        }

        .topbar .brand span {
            color: var(--gold);
        }

        .topbar-actions {
            display: flex;
            gap: 14px;
        }

        #btn1,
        #btn2 {
            float: none;
            width: auto;
            padding: 10px 26px;
            border: 1.5px solid var(--gold);
            border-radius: 999px;
            background: transparent;
            color: var(--gold-pale);
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: .4px;
            cursor: pointer;
            transition: background .25s ease, color .25s ease, transform .15s ease;
        }

        #btn2 {
            border-color: rgba(212, 175, 55, .5);
        }

        #btn1:hover,
        #btn2:hover {
            background: var(--gold);
            color: var(--dark);
            transform: translateY(-1px);
        }

        .page-wrap {
            max-width: 1000px;
            margin: 40px auto 60px;
            padding: 0 20px;
        }

        .main-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow-heavy);
            padding: 40px 48px;
        }

        .profile-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-icon {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-pale), var(--card));
            border: 2px solid var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--rust);
            font-size: 30px;
        }

        .profile-label {
            font-size: 12px;
            letter-spacing: 1.5px;
            font-weight: 600;
            color: var(--gold-soft);
            text-transform: uppercase;
        }

        .info {
            margin: 0 0 30px 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 18px;
        }

        .info h3 {
            display: block;
            margin: 0;
            min-width: 170px;
            background: var(--zebra);
            border-left: 4px solid var(--gold);
            border-radius: 10px;
            padding: 14px 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: var(--dark-2);
        }

        .info h3::first-line {
            color: var(--gold-soft);
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .divider {
            border: none;
            border-top: 1px dashed var(--border);
            margin: 30px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 6px;
        }

        .section-title h2 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            margin: 0;
            color: var(--dark);
        }

        .section-title h2 span {
            color: var(--gold-soft);
        }

        .section-sub {
            text-align: center;
            color: #7a6c58;
            font-size: 14px;
            margin-bottom: 30px;
        }

        #quick-book {
            width: 100%;
        }

        #radio-buttons {
            width: 100%;
        }

        .option-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
            justify-content: center;
            max-width: 980px;
            margin: 0 auto;
        }

        .option-chip {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            background: var(--card);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: border-color .2s ease, box-shadow .2s ease, transform .15s ease, background .2s ease;
            user-select: none;
        }

        .option-chip span {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14.5px;
            font-weight: 500;
            line-height: 1.35;
            color: var(--dark-2);
            letter-spacing: .1px;
        }

        .option-chip:hover {
            border-color: var(--gold);
            box-shadow: var(--shadow-light);
            transform: translateY(-2px);
        }

        .option-chip input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 19px;
            height: 19px;
            min-width: 19px;
            flex-shrink: 0;
            border-radius: 50%;
            border: 2px solid var(--border);
            margin: 0;
            cursor: pointer;
            position: relative;
            transition: border-color .2s ease;
        }

        .option-chip input[type="radio"]:hover {
            border-color: var(--gold);
        }

        .option-chip input[type="radio"]:checked {
            border-color: var(--gold);
        }

        .option-chip input[type="radio"]:checked::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--gold);
            transform: translate(-50%, -50%);
        }

        .option-chip:has(input[type="radio"]:checked) {
            background: linear-gradient(135deg, var(--gold-pale), var(--card));
            border-color: var(--gold);
            box-shadow: 0 6px 16px rgba(212, 175, 55, .3);
            color: var(--dark);
        }

        .option-chip:has(input[type="radio"]:checked) span {
            color: var(--dark);
            font-weight: 600;
        }

        .note {
            width: 100%;
        }

        #note1 {
            margin: 30px auto 0;
            max-width: 620px;
            text-align: left;
            background: var(--zebra);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 32px 36px;
            box-shadow: var(--shadow-light);
        }

        #note1 h4,
        #note1 h5 {
            font-weight: 400;
            margin: 0;
        }

        #note1 label {
            display: inline-block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 13px;
            color: var(--gold-soft);
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        #note1 p {
            margin: 0 0 18px 0;
        }

        #note1 input[type="text"],
        #note1 input[type="number"],
        #note1 input[type="date"],
        #note1 textarea {
            width: 100%;
            padding: 11px 14px;
            margin-top: 4px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--card);
            color: var(--dark);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        #note1 textarea {
            resize: vertical;
            min-height: 80px;
        }

        #note1 input[type="text"]:focus,
        #note1 input[type="number"]:focus,
        #note1 input[type="date"]:focus,
        #note1 textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, .2);
        }

        #note1 input[type="radio"] {
            accent-color: var(--gold);
            margin-right: 6px;
            cursor: pointer;
        }

        #note1 input[type="file"] {
            width: 100%;
            padding: 10px;
            background: var(--card);
            border: 1px dashed var(--gold);
            border-radius: 8px;
            cursor: pointer;
            margin-top: 6px;
        }

        #note1 select {
            width: 100%;
            padding: 11px 14px;
            margin-top: 4px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--card);
            color: var(--dark);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        #note1 input[type="submit"],
        #note1 .btn {
            display: inline-block;
            margin-top: 14px;
            padding: 12px 34px;
            border: none;
            border-radius: 999px;
            background: var(--dark);
            color: var(--gold-pale);
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background .25s ease, color .25s ease, transform .15s ease;
        }

        #note1 input[type="submit"]:hover,
        #note1 .btn:hover {
            background: var(--gold);
            color: var(--dark);
            transform: translateY(-1px);
        }

        @media only screen and (max-width: 900px) {
            .topbar {
                flex-direction: column;
                gap: 14px;
                padding: 16px 20px;
            }

            #btn1,
            #btn2 {
                width: auto;
                float: none;
                font-size: 12px;
                padding: 8px 18px;
            }

            .main-card {
                padding: 26px 20px;
            }

            .info h3 {
                min-width: 45%;
            }

            #note1 {
                padding: 24px 20px;
            }
        }

        .w3-container {
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>

    <div class="topbar">
        <div class="brand">Certificate <span>Management</span> System</div>
        <div class="topbar-actions">
            <a href="facultydat.php" class="n"><button type="button" class="btn" id="btn2">Back</button></a>
            <a href="logout.php" class="n"><button type="button" class="btn" id="btn1">Logout</button></a>
        </div>
    </div>

    <div class="page-wrap">
        <div class="main-card">

            <?php
            // CHANGED: we no longer re-derive id/name/department from a fresh
            // query here. Login already put them in the session. We only
            // run this query to display the profile card (name + year).
            // CHANGED: your real table is 'faculty', matched on 'id' — not
            // a 'login' table matched on 'username' (that table/column
            // combination doesn't exist in your schema per login2.php).
            $uid = $_SESSION['id'];
            $query = "select * from faculty where id='$uid'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="profile-row">
                    <div class="profile-icon"><i class="fa-solid fa-user"></i></div>
                    <div>
                        <div class="profile-label">Faculty Profile</div>
                        <h2 style="font-family:'Playfair Display', serif; margin:0;"><?php echo htmlspecialchars($row['name']); ?></h2>
                    </div>
                </div>

                <div class="info">
                    <h3>Id.No<br><?php echo htmlspecialchars($_SESSION['id']); ?></h3>
                    <h3>Year of Joining<br><?php echo htmlspecialchars($row['year']); ?></h3>
                </div>
            <?php
                // REMOVED: $_SESSION['id'] = $row['rollno'];
                // REMOVED: $_SESSION['department'] = $row['department'];
                // These are already set at login time now — see login.php
            }
            ?>

            <hr class="divider">

            <div class="section-title">
                <h2>Add <span>Record</span></h2>
            </div>
            <p class="section-sub">Choose which type of record you'd like to submit</p>

            <div class="login-content">
                <div id="quick-book">
                    <form onchange="myFunction()" name="frmRadio" id="radio-buttons" action="" class="note"><br>
                        <div class="option-grid">
                            <label class="option-chip"><input type="radio" id="fdp" name="option"><span>FDP Attended</span></label>
                            <label class="option-chip"><input type="radio" id="fdporg" name="option"><span>FDP Organized</span></label>
                            <label class="option-chip"><input type="radio" id="workshop" name="option"><span>Workshop/Seminar/Conference</span></label>
                            <label class="option-chip"><input type="radio" id="paperpublications" name="option"><span>Paper Publications</span></label>
                            <label class="option-chip"><input type="radio" id="conferences" name="option"><span>Conferences</span></label>
                            <label class="option-chip"><input type="radio" id="certificates" name="option"><span>Certifications</span></label>
                            <label class="option-chip"><input type="radio" id="bookpublish" name="option"><span>Book Chapters Published</span></label>
                            <label class="option-chip"><input type="radio" id="bookedited" name="option"><span>Book Chapters Edited</span></label>
                            <label class="option-chip"><input type="radio" id="textbook" name="option"><span>Textbook</span></label>
                            <label class="option-chip"><input type="radio" id="patents" name="option"><span>Patents</span></label>
                            <label class="option-chip"><input type="radio" id="nptel" name="option"><span>NPTEL</span></label>
                            <label class="option-chip"><input type="radio" id="achievements" name="option"><span>Achievements</span></label>
                            <label class="option-chip"><input type="radio" id="outsideparticipations" name="option"><span>Outside Participations</span></label>
                            <label class="option-chip"><input type="radio" id="revieweractivities" name="option"><span>Reviewer Activities</span></label>
                            <label class="option-chip"><input type="radio" id="professionalmembership" name="option"><span>Professional Membership</span></label>
                            <label class="option-chip"><input type="radio" id="phddetails" name="option"><span>PhD Details</span></label>
                            <label class="option-chip"><input type="radio" id="consultancywork" name="option"><span>Consultancy Work</span></label>
                            <label class="option-chip"><input type="radio" id="workingmodels" name="option"><span>Working Models</span></label>
                            <label class="option-chip"><input type="radio" id="fundingprojects" name="option"><span>Funding Projects</span></label>
                        </div>
                    </form><br>
                    <div id="button"></div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function myFunction() {

            // 1. FDP Attended -> table: fdp
            if (document.getElementById("fdp").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='fdp.php' id='note1' class='w3-container'>
            <p><label>FDP Name</label><input class='w3-input' type='text' name='fdpname' required></p>
            <p><label>Organized By</label><input class='w3-input' type='text' name='org' required></p>
            <p><label>Mode</label><input class='w3-input' type='text' name='mode' required></p>
            <p><label>Duration</label><input class='w3-input' type='text' name='duration' required></p>
            <p><label>Start Date</label><input class='w3-input' type='text' name='startdate' placeholder='YYYY-MM-DD' required></p>
            <p><label>End Date</label><input class='w3-input' type='text' name='enddate' placeholder='YYYY-MM-DD' required></p>
            <p><label>Certificate Link</label><input class='w3-input' type='text' name='certificate_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 2. FDP Organized -> table: fdporg
            if (document.getElementById("fdporg").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='fdporg.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>FDP Name</label><input class='w3-input' type='text' name='fdp_name' required></p>
            <p><label>Association</label><input class='w3-input' type='text' name='association' required></p>
            <p><label>Mode</label><input class='w3-input' type='text' name='mode' required></p>
            <p><label>Start Date</label><input class='w3-input' type='text' name='start_date' placeholder='YYYY-MM-DD' required></p>
            <p><label>End Date</label><input class='w3-input' type='text' name='end_date' placeholder='YYYY-MM-DD' required></p>
            <p><label>Dates (raw text, optional)</label><input class='w3-input' type='text' name='dates_raw'></p>
            <p><label>Duration</label><input class='w3-input' type='text' name='duration' required></p>
            <p><label>Certificate Link</label><input class='w3-input' type='text' name='certificate_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 3. Workshop/Seminar/Conference -> table: ffworkshop
            if (document.getElementById("workshop").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_ffworkshop.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Type (Workshop/Seminar/Conference)</label><input class='w3-input' type='text' name='workshop' required></p>
            <p><label>Organized By</label><input class='w3-input' type='text' name='org' required></p>
            <p><label>Start Date</label><input class='w3-input' type='text' name='start_date' placeholder='YYYY-MM-DD' required></p>
            <p><label>Start Date (raw text, optional)</label><input class='w3-input' type='text' name='start_date_raw'></p>
            <p><label>End Date</label><input class='w3-input' type='text' name='end_date' placeholder='YYYY-MM-DD' required></p>
            <p><label>End Date (raw text, optional)</label><input class='w3-input' type='text' name='end_date_raw'></p>
            <p><label>Duration</label><input class='w3-input' type='text' name='duration' required></p>
            <p><label>Mode</label><input class='w3-input' type='text' name='mode' required></p>
            <p><label>Certificate Link</label><input class='w3-input' type='text' name='certificate_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 4. Paper Publications -> table: paperpublications
            if (document.getElementById("paperpublications").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_paperpublications.php' id='note1' class='w3-container'>
            <p><label>Title of the Paper</label><input class='w3-input' type='text' name='title' required></p>
            <p><label>Name of the Journal</label><input class='w3-input' type='text' name='journal' required></p>
            <p><label>Indexing Type</label><input class='w3-input' type='text' name='indexing_type' required></p>
            <p><label>Volume</label><input class='w3-input' type='text' name='volume' required></p>
            <p><label>Number/Issue</label><input class='w3-input' type='text' name='number' required></p>
            <p><label>URL / DOI</label><input class='w3-input' type='text' name='url_doi' required></p>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Month</label><input class='w3-input' type='text' name='month' required></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 5. Conferences -> table: conferences
            if (document.getElementById("conferences").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_conferences.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Number of Co-Authors</label><input class='w3-input' type='text' name='co_authors_count' required></p>
            <p><label>Author Position</label><input class='w3-input' type='text' name='author_type' required></p>
            <p><label>Paper Title</label><input class='w3-input' type='text' name='paper_title' required></p>
            <p><label>Conference Proceedings</label><input class='w3-input' type='text' name='conference_proceedings' required></p>
            <p><label>UGC/Scopus Type</label><input class='w3-input' type='text' name='ugc_scopus' required></p>
            <p><label>URL</label><input class='w3-input' type='text' name='url' required></p>
            <p><label>DOI</label><input class='w3-input' type='text' name='doi' required></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 6. Certifications -> table: certificates
            if (document.getElementById("certificates").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_certificates.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Certificate Name</label><input class='w3-input' type='text' name='certificate' required></p>
            <p><label>Organization</label><input class='w3-input' type='text' name='org' required></p>
            <p><label>Start Date</label><input class='w3-input' type='text' name='start_date' placeholder='YYYY-MM-DD' required></p>
            <p><label>Start Date (raw text, optional)</label><input class='w3-input' type='text' name='start_date_raw'></p>
            <p><label>End Date</label><input class='w3-input' type='text' name='end_date' placeholder='YYYY-MM-DD' required></p>
            <p><label>End Date (raw text, optional)</label><input class='w3-input' type='text' name='end_date_raw'></p>
            <p><label>Duration</label><input class='w3-input' type='text' name='duration' required></p>
            <p><label>Mode</label><input class='w3-input' type='text' name='mode' required></p>
            <p><label>Certificate Link</label><input class='w3-input' type='text' name='certificate_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 7. Book Chapters Published -> table: bookpublish
            if (document.getElementById("bookpublish").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_bookpublish.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Month</label><input class='w3-input' type='text' name='month' required></p>
            <p><label>Number of Authors</label><input class='w3-input' type='text' name='no_of_authors' required></p>
            <p><label>Author Position</label><input class='w3-input' type='text' name='author_position' required></p>
            <p><label>Title</label><input class='w3-input' type='text' name='title' required></p>
            <p><label>Publisher</label><input class='w3-input' type='text' name='publisher' required></p>
            <p><label>Scopus/SCI</label><input class='w3-input' type='text' name='scopus_sci' required></p>
            <p><label>URL</label><input class='w3-input' type='text' name='url' required></p>
            <p><label>ISBN</label><input class='w3-input' type='text' name='isbn' required></p>
            <p><label>DOI</label><input class='w3-input' type='text' name='doi' required></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 8. Book Chapters Edited -> table: bookedited
            if (document.getElementById("bookedited").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_bookedited.php' id='note1' class='w3-container'>
            <p><label>Number of Authors</label><input class='w3-input' type='text' name='no_of_authors' required></p>
            <p><label>Book Name</label><input class='w3-input' type='text' name='book_name' required></p>
            <p><label>Publisher Name</label><input class='w3-input' type='text' name='publisher_name' required></p>
            <p><label>ISBN Number</label><input class='w3-input' type='text' name='isbn_number' required></p>
            <p><label>URL</label><input class='w3-input' type='text' name='url' required></p>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Month</label><input class='w3-input' type='text' name='month' required></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 9. Textbook -> table: textbook
            if (document.getElementById("textbook").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_textbook.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Month</label><input class='w3-input' type='text' name='month' required></p>
            <p><label>Main Editor</label><input class='w3-input' type='text' name='main_editor' required></p>
            <p><label>Textbook Name</label><input class='w3-input' type='text' name='textbook_name' required></p>
            <p><label>Publisher Name</label><input class='w3-input' type='text' name='publisher_name' required></p>
            <p><label>URL</label><input class='w3-input' type='text' name='url' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 10. Patents -> table: patents
            if (document.getElementById("patents").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_patents.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Month</label><input class='w3-input' type='text' name='month' required></p>
            <p><label>Patent Details</label><input class='w3-input' type='text' name='patent_details' required></p>
            <p><label>Area of Patent</label><input class='w3-input' type='text' name='area_of_patent' required></p>
            <p><label>Application Number</label><input class='w3-input' type='text' name='application_number' required></p>
            <p><label>Status</label><input class='w3-input' type='text' name='status' required></p>
            <p><label>Patent Type</label><input class='w3-input' type='text' name='patent_type' required></p>
            <p><label>Filing Agency</label><input class='w3-input' type='text' name='filing_agency' required></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 11. NPTEL -> table: nptel
            if (document.getElementById("nptel").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_nptel.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Course Name</label><input class='w3-input' type='text' name='course_name' required></p>
            <p><label>Duration</label><input class='w3-input' type='text' name='duration' required></p>
            <p><label>Start Date</label><input class='w3-input' type='text' name='start_date' placeholder='YYYY-MM-DD' required></p>
            <p><label>End Date</label><input class='w3-input' type='text' name='end_date' placeholder='YYYY-MM-DD' required></p>
            <p><label>Percentage</label><input class='w3-input' type='text' name='percentage' required></p>
            <p><label>Top Percentage</label><input class='w3-input' type='text' name='top_percentage'></p>
            <p><label>Remarks</label><input class='w3-input' type='text' name='remarks'></p>
            <p><label>Certificate Link</label><input class='w3-input' type='text' name='certificate_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 12. Achievements -> table: achievements
            if (document.getElementById("achievements").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_achievements.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Award Name</label><input class='w3-input' type='text' name='award_name' required></p>
            <p><label>Description</label><input class='w3-input' type='text' name='description' required></p>
            <p><label>Achievement Date</label><input class='w3-input' type='text' name='achievement_date' required></p>
            <p><label>Organization</label><input class='w3-input' type='text' name='organization' required></p>
            <p><label>Achievement Link</label><input class='w3-input' type='text' name='achievement_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 13. Outside Participations -> table: outside_participations
            if (document.getElementById("outsideparticipations").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_outside_participations.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Month</label><input class='w3-input' type='text' name='month' required></p>
            <p><label>Date Attended</label><input class='w3-input' type='text' name='date_attended' required></p>
            <p><label>Organization</label><input class='w3-input' type='text' name='organization' required></p>
            <p><label>Conference/Journal Name</label><input class='w3-input' type='text' name='conference_journal_name' required></p>
            <p><label>Type</label><input class='w3-input' type='text' name='type' required></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 14. Reviewer Activities -> table: reviewer_activities
            if (document.getElementById("revieweractivities").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_reviewer_activities.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Month</label><input class='w3-input' type='text' name='month' required></p>
            <p><label>Date Attended</label><input class='w3-input' type='text' name='date_attended' required></p>
            <p><label>Organization</label><input class='w3-input' type='text' name='organization' required></p>
            <p><label>Conference/Journal Name</label><input class='w3-input' type='text' name='conference_journal_name' required></p>
            <p><label>Type</label><input class='w3-input' type='text' name='type' required></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 15. Professional Membership -> table: professional_membership
            if (document.getElementById("professionalmembership").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_professional_membership.php' id='note1' class='w3-container'>
            <p><label>Membership Name</label><input class='w3-input' type='text' name='membership_name' required></p>
            <p><label>Membership ID</label><input class='w3-input' type='text' name='membership_id'></p>
            <p><label>Membership Type</label><input class='w3-input' type='text' name='membership_type' required></p>
            <p><label>Start Date</label><input class='w3-input' type='text' name='start_date' required></p>
            <p><label>End Date</label><input class='w3-input' type='text' name='end_date'></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 16. PhD Details -> table: phd_details
            if (document.getElementById("phddetails").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_phd_details.php' id='note1' class='w3-container'>
            <p><label>University Name</label><input class='w3-input' type='text' name='university_name' required></p>
            <p><label>Status</label><input class='w3-input' type='text' name='status' required></p>
            <p><label>Domain Name</label><input class='w3-input' type='text' name='domain_name' required></p>
            <p><label>Date of Completion</label><input class='w3-input' type='text' name='date_of_completion'></p>
            <p><label>Pursuing Year</label><input class='w3-input' type='text' name='pursuing_year'></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 17. Consultancy Work -> table: consultancy_work
            if (document.getElementById("consultancywork").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_consultancy_work.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Description</label><input class='w3-input' type='text' name='description' required></p>
            <p><label>Organization</label><input class='w3-input' type='text' name='organization' required></p>
            <p><label>Amount</label><input class='w3-input' type='text' name='amount' required></p>
            <p><label>Start Date</label><input class='w3-input' type='text' name='start_date' required></p>
            <p><label>End Date</label><input class='w3-input' type='text' name='end_date' required></p>
            <p><label>Duration</label><input class='w3-input' type='text' name='duration' required></p>
            <p><label>Students Involved</label><input class='w3-input' type='text' name='students_involved'></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 18. Working Models -> table: working_models
            if (document.getElementById("workingmodels").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_working_models.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Model Name</label><input class='w3-input' type='text' name='model_name' required></p>
            <p><label>Duration</label><input class='w3-input' type='text' name='duration' required></p>
            <p><label>Students Count</label><input class='w3-input' type='text' name='students_count' required></p>
            <p><label>Domain Name</label><input class='w3-input' type='text' name='domain_name' required></p>
            <p><label>Proof Link</label><input class='w3-input' type='text' name='proof_link' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }

            // 19. Funding Projects -> table: funding_projects
            if (document.getElementById("fundingprojects").checked) {
                document.getElementById("button").innerHTML = `
        <form method='post' action='add_funding_projects.php' id='note1' class='w3-container'>
            <p><label>Academic Year</label><input class='w3-input' type='text' name='academic_year' required></p>
            <p><label>Title</label><input class='w3-input' type='text' name='title' required></p>
            <p><label>Agency Name</label><input class='w3-input' type='text' name='agency_name' required></p>
            <p><label>Amount</label><input class='w3-input' type='text' name='amount' required></p>
            <p><label>Start Date</label><input class='w3-input' type='text' name='start_date' required></p>
            <p><label>End Date</label><input class='w3-input' type='text' name='end_date' required></p>
            <p><label>Duration</label><input class='w3-input' type='text' name='duration' required></p>
            <p><label>Funding Type</label><input class='w3-input' type='text' name='funding_type' required></p>
            <input type='submit' class='btn' value='submit' name='submit'>
        </form>`;
            }
        }
    </script>
</body>

</html>