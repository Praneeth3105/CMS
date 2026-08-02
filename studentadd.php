<?php
include "db_conn.php";
session_start();
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

        /* =================== TOP BAR =================== */
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

        /* =================== PAGE WRAPPER =================== */
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

        /* =================== STUDENT PROFILE =================== */
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

        /* =================== SECTION HEADING =================== */
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

        /* =================== RADIO SELECTION AREA =================== */
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
            max-width: 780px;
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

        /* =================== DYNAMICALLY INJECTED FORM =================== */
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
        #note1 input[type="date"] {
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

        #note1 input[type="text"]:focus,
        #note1 input[type="date"]:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, .2);
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
            appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, var(--gold-soft) 50%),
                linear-gradient(135deg, var(--gold-soft) 50%, transparent 50%);
            background-position: calc(100% - 18px) calc(1em + 2px), calc(100% - 13px) calc(1em + 2px);
            background-size: 5px 5px, 5px 5px;
            background-repeat: no-repeat;
        }

        #note1 select:focus {
            outline: none;
            border-color: var(--gold);
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

        /* =================== RESPONSIVE =================== */
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

    <!-- ============ TOP BAR ============ -->
    <div class="topbar">
        <div class="brand">Certificate <span>Management</span> System</div>
        <div class="topbar-actions">
            <a href="studentdat.php" class="n"><button type="button" class="btn" id="btn2">Back</button></a>
            <a href="logout.php" class="n"><button type="button" class="btn" id="btn1">Logout</button></a>
        </div>
    </div>

    <div class="page-wrap">
        <div class="main-card">

            <?php
            $uname = $_SESSION['username'];
            $query = "select * from studentdetails where username='$uname'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                $_SESSION['name'] = $row['name'];
                $_SESSION['rollno'] = $row['username'];
                $_SESSION['year'] = $row['year'];
                $_SESSION['department'] = $row['department'];
                $_SESSION['counsular'] = $row['counsular'];
                $_SESSION['classteacher'] = $row['classteacher'];
                $_SESSION['academic_year'] = $row['academic_year'];
            ?>
                <div class="profile-row">
                    <div class="profile-icon"><i class="fa-solid fa-user"></i></div>
                    <div>
                        <div class="profile-label">Student Profile</div>
                        <h2 style="font-family:'Playfair Display', serif; margin:0;"><?php echo $row['name']; ?></h2>
                    </div>
                </div>

                <div class="info">
                    <h3>Roll No<br><?php echo $row['username']; ?></h3>
                    <h3>Year of Studying<br><?php echo $row['year']; ?></h3>
                    <h3>Counsellor<br><?php echo $row['counsular']; ?></h3>
                    <h3>Class Incharge<br><?php echo $row['classteacher']; ?></h3>
                </div>
            <?php
            } ?>

            <hr class="divider">

            <div class="section-title">
                <h2>Add <span>Achievement</span></h2>
            </div>
            <p class="section-sub">Choose which type of achievement/certificate you'd like to submit</p>

            <div class="login-content">
                <div id="quick-book">
                    <form onchange="myFunction()" name="frmRadio" id="radio-buttons" action="" class="note"><br>
                        <div class="option-grid">
                            <label class="option-chip"><input type="radio" id="workshop" name="option" onclick="document.getElementById('radio-buttons').action='';"><span>Workshop</span></label>
                            <label class="option-chip"><input type="radio" id="internship" name="option" onclick="document.getElementById('radio-buttons').action='';"><span>Internship</span></label>
                            <label class="option-chip"><input type="radio" id="project" name="option" onclick="document.getElementById('radio-buttons').action='';"><span>Project</span></label>
                            <label class="option-chip"><input type="radio" id="course" name="option" onclick="document.getElementById('radio-buttons').action='';"><span>Certificates</span></label>
                            <label class="option-chip"><input type="radio" id="extracircular" name="option" onclick="document.getElementById('radio-buttons').action='';"><span>Extra-Circular</span></label>
                            <label class="option-chip"><input type="radio" id="cocircular" name="option" onclick="document.getElementById('radio-buttons').action='';"><span>Co-circular</span></label>
                        </div>
                    </form><br>
                    <div id="button">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        var academicYearOptions = "<option value=''>Academic Year</option><option value='2019-2020'>2019-2020</option><option value='2020-2021'>2020-2021</option><option value='2021-2022'>2021-2022</option><option value='2022-2023'>2022-2023</option><option value='2023-2024'>2023-2024</option><option value='2024-2025'>2024-2025</option><option value='2025-2026'>2025-2026</option><option value='2026-2027'>2026-2027</option><option value='2027-2028'>2027-2028</option><option value='2028-2029'>2028-2029</option><option value='2029-2030'>2029-2030</option>";

        function myFunction() {
            if (document.getElementById("workshop").checked) {
                document.getElementById("button").innerHTML = "<form method='post' action='sworkshop.php' id='note1' class='w3-container' enctype='multipart/form-data'><h4><p><label>Workshop Name</label><input class='w3-input' type='text' name='wn' required></p><p><label>Name of the Organization</label><input class='w3-input' type='text' name='org' required></p><p><label>Place</label><input class='w3-input' type='text' name='place' required></p><p><label>Start Date</label><input class='w3-input' type='date' name='sd' required></p><p><label>End Date</label><input class='w3-input' type='date' name='ed' required></p><p><label for='academic'>Academic Year</label><select id='academic' onclick='my()' name='accy' required>" + academicYearOptions + "</select></p><p><label>Upload File</label><input class='w3-input' type='file' name='file' required></p><input type='submit' class='btn' value='submit' name='submit'></h4></form>";
            }
            if (document.getElementById("internship").checked) {
                document.getElementById("button").innerHTML = "<form method='post' action='sinternship.php' id='note1' class='w3-container' enctype='multipart/form-data'><h4><p><label>Company Name</label><input class='w3-input' type='text' name='cn' required></p><p><label>Technical/Non Technical</label><input class='w3-input' type='text' name='tech' required></p><p><label>Domain</label><input class='w3-input' type='text' name='dd' required></p><p><label>Starting Date</label><input class='w3-input' type='date' name='sd' required></p><p><label>Ending Date</label><input class='w3-input' type='date' name='ed' required></p><p><label>Paid/Not Paid</label><input class='w3-input' type='text' name='paid' required></p><p><label>Total Amount</label><input class='w3-input' type='text' name='tamount' required></p><p><label for='academic'>Academic Year</label><select id='academic' onclick='my()' name='acc' required>" + academicYearOptions + "</select></p><p><label>Upload File</label><input class='w3-input' type='file' name='file' required></p><input type='submit' class='btn' value='submit' name='submit'></h4></form>";
            }
            if (document.getElementById("project").checked) {
                document.getElementById("button").innerHTML = "<form method='post' action='sproject.php' id='note1' class='w3-container'><h4><p><label>Title of the Project</label><input class='w3-input' type='text' name='tname' required></p><p><label>Team Number</label><input class='w3-input' type='text' name='bnum' required></p><p><label for='academic'>Academic Year</label><select id='academic' onclick='my()' name='acc' required>" + academicYearOptions + "</select></p><p><label>Project Drive Link</label><input class='w3-input' type='text' name='link' required></p><input type='submit' class='btn' value='submit' name='submit'></h4></form>";
            }
            if (document.getElementById("course").checked) {
                document.getElementById("button").innerHTML = "<form method='post' action='scourse.php' id='note1' class='w3-container' enctype='multipart/form-data'><h4><p><label>Name of Institution</label><input class='w3-input' type='text' name='ni' required></p><p><label>Name of the Course</label><input class='w3-input' type='text' name='nc' required></p><p><label>Starting Date</label><input class='w3-input' type='date' name='sd' required></p><p><label>Ending Date</label><input class='w3-input' type='date' name='ed' required></p><p><label for='academic'>Academic Year</label><select id='academic' onclick='my()' name='acc' required>" + academicYearOptions + "</select></p><p><label>Upload File</label><input class='w3-input' type='file' name='file' required></p><input type='submit' class='btn' value='submit' name='submit'></h4></form>";
            }
            if (document.getElementById("extracircular").checked) {
                document.getElementById("button").innerHTML = "<form method='post' action='sextracircular.php' id='note1' class='w3-container' enctype='multipart/form-data'><h4><p><label>Event Name</label><input class='w3-input' type='text' name='nevent' required></p><p><label>Name of the Conducting College</label><input class='w3-input' type='text' name='condclg' required></p><p><label>Conducting Organisation</label><input class='w3-input' type='text' name='conorg' required></p><p><label>Dates</label><input class='w3-input' type='date' name='dates' required></p><p><label>Internal/External</label><input class='w3-input' type='text' name='ie' required></p><p><label for='academic'>Academic Year</label><select id='academic' onclick='my()' name='acc' required>" + academicYearOptions + "</select></p><p><label>Upload File</label><input class='w3-input' type='file' name='file' required></p><input type='submit' class='btn' value='submit' name='submit'></h4></form>";
            }
            if (document.getElementById("cocircular").checked) {
                document.getElementById("button").innerHTML = "<form method='post' action='scocircular.php' id='note1' class='w3-container' enctype='multipart/form-data'><h4><p><label>Event Name</label><input class='w3-input' type='text' name='nevent' required></p><p><label>Name of the Conducting College</label><input class='w3-input' type='text' name='condclg' required></p><p><label>Conducting Organisation</label><input class='w3-input' type='text' name='conorg' required></p><p><label>Dates</label><input class='w3-input' type='date' name='dates' required></p><p><label>Internal/External</label><input class='w3-input' type='text' name='ie' required></p><p><label for='academic'>Academic Year</label><select id='academic' onclick='my()' name='acc' required>" + academicYearOptions + "</select></p><p><label>Upload File</label><input class='w3-input' type='file' name='file' required></p><input type='submit' class='btn' value='submit' name='submit'></h4></form>";
            }
        }
    </script>
    <script src="mainl.js"></script>

</body>

</html>