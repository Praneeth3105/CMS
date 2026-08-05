<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include_once('db_conn.php');
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="icon" type="image/x-icon" href="icon2.png">
	<title>CERTIFICATE MAINTANCE SYSTEM</title>
	<link rel="stylesheet" href="style2.css">
	<link rel="stylesheet" href="lightbox.min.css">
	<script src="lightbox-plus-jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
			--border: #e6ddc8;
			--muted: #8a7d6b;
			--radius: 18px;
			--radius-sm: 10px;
			--shadow: 0 8px 22px rgba(120, 100, 60, 0.10);
			--shadow-lg: 0 12px 32px rgba(120, 100, 60, 0.12), 0 2px 8px rgba(26, 18, 11, 0.06);
		}

		* {
			box-sizing: border-box;
		}


		html,
		body {
			width: 100% !important;
			max-width: 100% !important;
			margin: 0 !important;
			padding: 0 !important;
			overflow-x: hidden;
			float: none !important;
			display: block !important;
		}

		html body {
			font-family: 'Poppins', sans-serif;
			background: var(--cream);
			color: var(--dark);
			min-height: 100vh;
			padding-bottom: 60px;
		}

		.n {
			text-decoration: none;
		}

		/* ---------- Top bar ---------- */
		html body .topbar {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 10px 24px;
			background: linear-gradient(120deg, var(--dark) 0%, var(--dark-2) 100%);
			box-shadow: var(--shadow);
			position: relative;
			width: 100%;
		}

		.topbar::after {
			content: "";
			position: absolute;
			left: 0;
			right: 0;
			bottom: 0;
			height: 3px;
			background: linear-gradient(90deg, transparent, var(--gold) 50%, transparent);
			opacity: 0.6;
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
			box-shadow: 0 8px 18px rgba(212, 175, 55, 0.3);
		}

		/* download icon buttons inside tables */
		#myTable .btn,
		#myTable1 .btn,
		#myTable2 .btn,
		#myTable3 .btn,
		#myTable4 .btn,
		#myTable5 .btn {
			padding: 8px 14px;
			font-size: 0.8rem;
		}

		/* ---------- Hero ---------- */
		html body .page-hero {
			text-align: center;
			padding: 22px 20px 8px;
			width: 100% !important;
			float: none !important;
		}

		.page-hero .eyebrow {
			text-transform: uppercase;
			letter-spacing: 3px;
			font-size: 0.75rem;
			color: var(--rust);
			font-weight: 600;
			margin-bottom: 10px;
		}

		.page-hero h1 {
			font-family: 'Playfair Display', serif;
			font-size: 2.1rem;
			font-weight: 700;
			color: var(--dark);
			margin: 0 0 8px;
		}

		.page-hero h1 .accent {
			color: var(--gold-soft);
		}

		.page-hero p {
			color: var(--muted);
			max-width: 480px;
			margin: 0 auto;
			font-size: 0.95rem;
		}

		/* ---------- Container / sections ---------- */
		html body .container {
			max-width: 1300px !important;
			width: 100% !important;
			margin: 0 auto !important;
			padding: 0 32px !important;
			float: none !important;
			display: block !important;
			box-sizing: border-box;
		}

		html body .login-content {
			display: flex !important;
			flex-direction: column !important;
			width: 100% !important;
			max-width: 100% !important;
			min-width: 0 !important;
			float: none !important;
			margin: 0 !important;
		}

		.record-section {
			margin-top: 46px;
			padding-top: 30px;
			border-top: 1px dashed var(--border);
			width: 100%;
		}

		.record-section:first-child {
			margin-top: 24px;
			padding-top: 0;
			border-top: none;
		}

		.record-section h1 {
			font-family: 'Playfair Display', serif;
			font-size: 1.5rem;
			font-weight: 700;
			color: var(--dark);
			margin: 0 0 4px;
		}

		.record-section h1::before {
			content: "";
			display: inline-block;
			width: 10px;
			height: 10px;
			border-radius: 50%;
			background: var(--gold);
			margin-right: 10px;
			vertical-align: middle;
		}

		#myInput,
		#myInput1,
		#myInput2,
		#myInput3,
		#myInput4,
		#myInput5 {
			width: 100%;
			max-width: 420px;
			font-family: 'Poppins', sans-serif;
			font-size: 0.9rem;
			padding: 12px 18px 12px 42px;
			border: 1.5px solid var(--border);
			border-radius: 999px;
			background: var(--cream-card) url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%238a7d6b" stroke-width="2"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>') no-repeat 14px center;
			background-size: 16px 16px;
			color: var(--dark);
			box-shadow: var(--shadow);
			margin: 14px 0 18px;
			transition: border-color 0.2s ease, box-shadow 0.2s ease;
		}

		#myInput:focus,
		#myInput1:focus,
		#myInput2:focus,
		#myInput3:focus,
		#myInput4:focus,
		#myInput5:focus {
			outline: none;
			border-color: var(--gold-soft);
			box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
		}

		#myInput::placeholder,
		#myInput1::placeholder,
		#myInput2::placeholder,
		#myInput3::placeholder,
		#myInput4::placeholder,
		#myInput5::placeholder {
			color: var(--muted);
		}

		/* ---------- Scroll wrapper / tables ---------- */
		html body .scroll {
			height: auto;
			max-height: 420px;
			overflow: auto;
			width: 100% !important;
			min-width: 0;
			direction: ltr;
			border-radius: var(--radius);
			box-shadow: var(--shadow);
			border: 1px solid rgba(212, 175, 55, 0.25);
			-webkit-overflow-scrolling: touch;
			float: none !important;
		}

		#myTable,
		#myTable1,
		#myTable2,
		#myTable3,
		#myTable4,
		#myTable5 {
			border-collapse: collapse;
			table-layout: fixed;
			width: 100%;
			min-width: 1100px;
			background: var(--cream-card);
			font-size: 0.88rem;
		}

		#myTable th,
		#myTable1 th,
		#myTable2 th,
		#myTable3 th,
		#myTable4 th,
		#myTable5 th {
			background: var(--dark);
			color: var(--gold-pale);
			text-transform: uppercase;
			font-size: 0.7rem;
			letter-spacing: 0.5px;
			padding: 13px 14px;
			text-align: left;
			border: none;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			position: sticky;
			top: 0;
		}

		#myTable td,
		#myTable1 td,
		#myTable2 td,
		#myTable3 td,
		#myTable4 td,
		#myTable5 td {
			padding: 11px 14px;
			border-bottom: 1px solid #ece3d1;
			color: #4a4030;
			vertical-align: middle;
			text-align: left;

			word-wrap: break-word;
			overflow-wrap: break-word;
		}

		#myTable tr:nth-child(even) td,
		#myTable1 tr:nth-child(even) td,
		#myTable2 tr:nth-child(even) td,
		#myTable3 tr:nth-child(even) td,
		#myTable4 tr:nth-child(even) td,
		#myTable5 tr:nth-child(even) td {
			background: #faf6ec;
		}

		#myTable tr:hover td,
		#myTable1 tr:hover td,
		#myTable2 tr:hover td,
		#myTable3 tr:hover td,
		#myTable4 tr:hover td,
		#myTable5 tr:hover td {
			background: var(--gold-pale);
		}

		#myTable tr:last-child td,
		#myTable1 tr:last-child td,
		#myTable2 tr:last-child td,
		#myTable3 tr:last-child td,
		#myTable4 tr:last-child td,
		#myTable5 tr:last-child td {
			border-bottom: none;
		}

		#myTable img,
		#myTable1 img,
		#myTable2 img,
		#myTable3 img,
		#myTable4 img,
		#myTable5 img {
			border-radius: 8px;
			border: 1px solid var(--border);
			box-shadow: 0 4px 10px rgba(26, 18, 11, 0.12);
			display: block;
			object-fit: cover;
		}

		#myTable embed,
		#myTable1 embed,
		#myTable2 embed,
		#myTable3 embed,
		#myTable4 embed,
		#myTable5 embed {
			border-radius: 8px;
			border: 1px solid var(--border);
			display: block;
		}
		.file-cell {
			position: relative;
			width: 100%;
			max-width: 200px;
			height: 100px;
			overflow: hidden;
			border-radius: 8px;
			border: 1px solid var(--border);
			box-shadow: 0 4px 10px rgba(26, 18, 11, 0.12);
			background: #fff;
		}

		.file-cell embed,
		.file-cell img {
			position: absolute;
			top: 0;
			left: 0;
			width: 100% !important;
			height: 100% !important;
			border: none;
			border-radius: 0;
			box-shadow: none;
			object-fit: cover;
			display: block;
		}

		.wave {
			display: block;
			margin: 0 auto;
			max-width: 260px;
			opacity: 0.9;
		}

		@media only screen and (max-width: 900px) {
			.topbar {
				flex-wrap: wrap;
				gap: 10px;
			}

			.btn,
			#btn1 {
				width: 100% !important;
				justify-content: center;
			}

			html body .container {
				padding: 0 14px !important;
			}

			.scroll {
				max-height: 340px;
			}

			#myInput,
			#myInput1,
			#myInput2,
			#myInput3,
			#myInput4,
			#myInput5 {
				max-width: 100%;
			}

			.wave {
				display: none;
			}
		}
	</style>
</head>

<body>

	<div class="topbar">
		<a href="facultydat.php" class="n"><button type="button" class="btn" id="btn1">Back</button></a>
		<a href="logout.php" class="n"><button type="button" class="btn">Logout</button></a>
	</div>

	<div class="page-hero">
		<div class="eyebrow">Class Teacher Records</div>
		<h1>Student <span class="accent">Activity Records</span></h1>
		<p>Browse workshops, internships, projects, certificates and extracurricular records for your class.</p>
	</div>

	<div class="container">
		<div class="login-content">

			<div class="record-section">
				<h1>Workshop</h1>
				<input type="text" id="myInput" onkeyup="myFunction()" placeholder="search by Workshop Name.." title="Type in a name">
				<div class="scroll">
					<table id="myTable">
						<tr class="header">
							<th style="width:8%;">Roll No</th>
							<th style="width:8%;">Name</th>
							<th style="width:10%;">Workshop Name</th>
							<th style="width:10%;">Organisation</th>
							<th style="width:7%;">Start Date</th>
							<th style="width:7%;">End Date</th>
							<th style="width:7%;">Duration</th>
							<th style="width:7%;">Place</th>
							<th style="width:14%;">File</th>
							<th style="width:5%;">Year</th>
							<th style="width:8%;">Counsular</th>
							<th style="width:8%;">Class Teacher</th>
							<th style="width:6%;">Download</th>
						</tr>
						<?php
						$name = $_SESSION['name'];
						$query = "SELECT * FROM sworkshop WHERE classteacher='$name'";
						$result = mysqli_query($conn, $query);
						while ($rows = mysqli_fetch_assoc($result)) {
						?>
							<tr>
								<td><?php echo $rows['RollNo']; ?></td>
								<td><?php echo $rows['Name']; ?></td>
								<td><?php echo $rows['WorkshopName']; ?></td>
								<td><?php echo $rows['OrgName']; ?></td>
								<td><?php echo $rows['StartDate']; ?></td>
								<td><?php echo $rows['EndDate']; ?></td>
								<td><?php echo $rows['Duration']; ?></td>
								<td><?php echo $rows['Place']; ?></td>
								<td>
									<div class="file-cell"><?php
															$ext = pathinfo('images/' . $rows['file'] . '', PATHINFO_EXTENSION);
															if ($ext == 'pdf') {
																echo "
<embed
    src='images/" . $rows['file'] . "'
    type='application/pdf'
    frameBorder='0'
    scrolling='auto'
    height='100'
    width='200'
></embed>";
															} else {
																echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery' ><img src='images/" . $rows['file'] . "' width='200' height='100' ></a>";
															}
															?></div>
								</td>
								<td><?php echo $rows['year']; ?></td>
								<td><?php echo $rows['counsular']; ?></td>
								<td><?php echo $rows['classteacher']; ?></td>
								<td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:20px' class='fa'>&#xf019;</i></button></a>"; ?></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>

			<div class="record-section">
				<h1>Internship</h1>
				<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="search by Internship Name.." title="Type in a name">
				<div class="scroll">
					<table id="myTable1">
						<tr class="header">
							<th style="width:6%;">Roll No</th>
							<th style="width:7%;">Name</th>
							<th style="width:9%;">Company Name</th>
							<th style="width:6%;">Branch</th>
							<th style="width:5%;">Year</th>
							<th style="width:7%;">Start Date</th>
							<th style="width:7%;">End Date</th>
							<th style="width:7%;">Duration</th>
							<th style="width:6%;">Amount</th>
							<th style="width:6%;">Paid</th>
							<th style="width:7%;">Tech/Non-Tech</th>
							<th style="width:12%;">File</th>
							<th style="width:7%;">Counsular</th>
							<th style="width:7%;">Class Teacher</th>
							<th style="width:6%;">Download</th>
						</tr>
						<?php
						$query = "SELECT * FROM sinternship WHERE classteacher='$name'";
						$result = mysqli_query($conn, $query);
						while ($rows = mysqli_fetch_assoc($result)) {
						?>
							<tr>
								<td><?php echo $rows['rollno']; ?></td>
								<td><?php echo $rows['name']; ?></td>
								<td><?php echo $rows['companyname']; ?></td>
								<td><?php echo $rows['branch']; ?></td>
								<td><?php echo $rows['year']; ?></td>
								<td><?php echo $rows['startdate']; ?></td>
								<td><?php echo $rows['enddate']; ?></td>
								<td><?php echo $rows['duration']; ?></td>
								<td><?php echo $rows['amount']; ?></td>
								<td><?php echo $rows['paid']; ?></td>
								<td><?php echo $rows['tech']; ?></td>
								<td>
									<div class="file-cell"><?php
															$ext = pathinfo('images/' . $rows['pic'] . '', PATHINFO_EXTENSION);
															if ($ext == 'pdf') {
																echo "
<embed
    src='images/" . $rows['pic'] . "'
    type='application/pdf'
    frameBorder='0'
    scrolling='auto'
    height='100'
    width='200'
></embed>";
															} else {
																echo "<a href='images/" . $rows['pic'] . "' data-lightbox='mygallery' ><img src='images/" . $rows['pic'] . "' width='200' height='100' ></a>";
															}
															?></div>
								</td>
								<td><?php echo $rows['counsular']; ?></td>
								<td><?php echo $rows['classteacher']; ?></td>
								<td><?php echo "<a href='images/" . $rows['pic'] . "' download><button class='btn'><i style='font-size:20px' class='fa'>&#xf019;</i></button></a>"; ?></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>

			<div class="record-section">
				<h1>Project</h1>
				<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="search by Project Name.." title="Type in a name">
				<div class="scroll">
					<table id="myTable2">
						<tr class="header">
							<th style="width:12%;">Roll Number</th>
							<th style="width:10%;">Team Number</th>
							<th style="width:16%;">Name</th>
							<th style="width:32%;">Project Title</th>
							<th style="width:10%;">Drive Link</th>
							<th style="width:10%;">Counsular</th>
							<th style="width:10%;">Class Teacher</th>
						</tr>
						<?php
						$query = "SELECT * FROM sproject WHERE classteacher='$name'";
						$result = mysqli_query($conn, $query);
						while ($rows = mysqli_fetch_assoc($result)) {
						?>
							<tr>
								<td><?php echo $rows['Roll_Number']; ?></td>
								<td><?php echo $rows['Team_Number']; ?></td>
								<td><?php echo $rows['Name']; ?></td>
								<td><?php echo $rows['Project_title']; ?></td>
								<td><?php echo "<a href='" . $rows['Drive_link'] . "' target='_blank'>Drive link</a>"; ?></td>
								<td><?php echo $rows['counsular']; ?></td>
								<td><?php echo $rows['classteacher']; ?></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>

			<div class="record-section">
				<h1>Certificates</h1>
				<input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="search for Name of Certificate.." title="Type in a name">
				<div class="scroll">
					<table id="myTable3">
						<tr class="header">
							<th style="width:7%;">Roll No</th>
							<th style="width:9%;">Name</th>
							<th style="width:12%;">Course Name</th>
							<th style="width:10%;">Organisation</th>
							<th style="width:8%;">Start Date</th>
							<th style="width:8%;">End Date</th>
							<th style="width:8%;">Duration</th>
							<th style="width:15%;">File</th>
							<th style="width:9%;">Counsular</th>
							<th style="width:8%;">Class Teacher</th>
							<th style="width:6%;">Download</th>
						</tr>
						<?php
						$query = "SELECT * FROM course WHERE classteacher='$name'";
						$result = mysqli_query($conn, $query);
						while ($rows = mysqli_fetch_assoc($result)) {
						?>
							<tr>
								<td><?php echo $rows['RollNo']; ?></td>
								<td><?php echo $rows['Name']; ?></td>
								<td><?php echo $rows['CourseName']; ?></td>
								<td><?php echo $rows['OrganisationName']; ?></td>
								<td><?php echo $rows['StartDate']; ?></td>
								<td><?php echo $rows['EndDate']; ?></td>
								<td><?php echo $rows['Duration']; ?></td>
								<td>
									<div class="file-cell"><?php
															$ext = pathinfo('images/' . $rows['file'] . '', PATHINFO_EXTENSION);
															if ($ext == 'pdf') {
																echo "
<embed
    src='images/" . $rows['file'] . "'
    type='application/pdf'
    frameBorder='0'
    scrolling='auto'
    height='100'
    width='200'
></embed>";
															} else {
																echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery' ><img src='images/" . $rows['file'] . "' width='200' height='100' ></a>";
															}
															?></div>
								</td>
								<td><?php echo $rows['counsular']; ?></td>
								<td><?php echo $rows['classteacher']; ?></td>
								<td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:20px' class='fa'>&#xf019;</i></button></a>"; ?></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>

			<div class="record-section">
				<h1>Extra Circular</h1>
				<input type="text" id="myInput4" onkeyup="myFunction4()" placeholder="search for Name of Event.." title="Type in a name">
				<div class="scroll">
					<table id="myTable4">
						<tr class="header">
							<th style="width:6%;">Roll No</th>
							<th style="width:8%;">Name</th>
							<th style="width:5%;">Year</th>
							<th style="width:10%;">Event Name</th>
							<th style="width:11%;">Conducting College</th>
							<th style="width:10%;">Organisation Name</th>
							<th style="width:8%;">Dates</th>
							<th style="width:8%;">Internal/External</th>
							<th style="width:14%;">File</th>
							<th style="width:7%;">Counsular</th>
							<th style="width:7%;">Class Teacher</th>
							<th style="width:6%;">Download</th>
						</tr>
						<?php
						$query = "SELECT * FROM extracircular WHERE classteacher='$name'";
						$result = mysqli_query($conn, $query);
						while ($rows = mysqli_fetch_assoc($result)) {
						?>
							<tr>
								<td><?php echo $rows['rollno']; ?></td>
								<td><?php echo $rows['name']; ?></td>
								<td><?php echo $rows['year']; ?></td>
								<td><?php echo $rows['eventname']; ?></td>
								<td><?php echo $rows['conductingclg']; ?></td>
								<td><?php echo $rows['orgname']; ?></td>
								<td><?php echo $rows['dates']; ?></td>
								<td><?php echo $rows['ie']; ?></td>
								<td>
									<div class="file-cell"><?php
															$ext = pathinfo('images/' . $rows['file'] . '', PATHINFO_EXTENSION);
															if ($ext == 'pdf') {
																echo "
<embed
    src='images/" . $rows['file'] . "'
    type='application/pdf'
    frameBorder='0'
    scrolling='auto'
    height='100'
    width='200'
></embed>";
															} else {
																echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery' ><img src='images/" . $rows['file'] . "' width='200' height='100' ></a>";
															}
															?></div>
								</td>
								<td><?php echo $rows['counsular']; ?></td>
								<td><?php echo $rows['classteacher']; ?></td>
								<td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:20px' class='fa'>&#xf019;</i></button></a>"; ?></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>

			<div class="record-section">
				<h1>Co Circular</h1>
				<input type="text" id="myInput5" onkeyup="myFunction5()" placeholder="search for Name of Event.." title="Type in a name">
				<div class="scroll">
					<table id="myTable5">
						<tr class="header">
							<th style="width:6%;">Roll No</th>
							<th style="width:8%;">Name</th>
							<th style="width:5%;">Year</th>
							<th style="width:10%;">Event Name</th>
							<th style="width:11%;">Conducting College</th>
							<th style="width:10%;">Organisation Name</th>
							<th style="width:8%;">Dates</th>
							<th style="width:8%;">Internal/External</th>
							<th style="width:14%;">File</th>
							<th style="width:7%;">Counsular</th>
							<th style="width:7%;">Class Teacher</th>
							<th style="width:6%;">Download</th>
						</tr>
						<?php
						$query = "SELECT * FROM cocircular WHERE classteacher='$name'";
						$result = mysqli_query($conn, $query);
						while ($rows = mysqli_fetch_assoc($result)) {
						?>
							<tr>
								<td><?php echo $rows['rollno']; ?></td>
								<td><?php echo $rows['name']; ?></td>
								<td><?php echo $rows['year']; ?></td>
								<td><?php echo $rows['eventname']; ?></td>
								<td><?php echo $rows['conductingclg']; ?></td>
								<td><?php echo $rows['orgname']; ?></td>
								<td><?php echo $rows['dates']; ?></td>
								<td><?php echo $rows['ie']; ?></td>
								<td>
									<div class="file-cell"><?php
															$ext = pathinfo('images/' . $rows['file'] . '', PATHINFO_EXTENSION);
															if ($ext == 'pdf') {
																echo "
<embed
    src='images/" . $rows['file'] . "'
    type='application/pdf'
    frameBorder='0'
    scrolling='auto'
    height='100'
    width='200'
></embed>";
															} else {
																echo "<a href='images/" . $rows['file'] . "' data-lightbox='mygallery' ><img src='images/" . $rows['file'] . "' width='200' height='100' ></a>";
															}
															?></div>
								</td>
								<td><?php echo $rows['counsular']; ?></td>
								<td><?php echo $rows['classteacher']; ?></td>
								<td><?php echo "<a href='images/" . $rows['file'] . "' download><button class='btn'><i style='font-size:20px' class='fa'>&#xf019;</i></button></a>"; ?></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>

		</div>
	</div>

	<script src="mainl.js"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			document.querySelectorAll(".scroll").forEach(function(el) {
				el.scrollLeft = 0;
			});
		});

		function myFunction() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("myTable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[2];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}

		function myFunction1() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput1");
			filter = input.value.toUpperCase();
			table = document.getElementById("myTable1");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[2];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}

		function myFunction2() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput2");
			filter = input.value.toUpperCase();
			table = document.getElementById("myTable2");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[3];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}

		function myFunction3() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput3");
			filter = input.value.toUpperCase();
			table = document.getElementById("myTable3");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[2];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}

		function myFunction4() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput4");
			filter = input.value.toUpperCase();
			table = document.getElementById("myTable4");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[4];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}

		function myFunction5() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput5");
			filter = input.value.toUpperCase();
			table = document.getElementById("myTable5");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[4];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	</script>
</body>

</html>