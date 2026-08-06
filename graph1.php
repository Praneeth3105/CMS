<?php
include "db_conn.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/x-icon" href="icon2.png">
	<title>Academic Year Analysis | Certificate Management System</title>
	<link rel="stylesheet" href="lightbox.min.css">
	<script src="lightbox-plus-jquery.min.js"></script>
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

		body {
			font-family: 'Poppins', sans-serif;
			background: var(--cream);
			color: var(--dark);
			margin: 0;
			padding: 0 0 60px;
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

		.btn {
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

		.btn:hover {
			background: var(--gold);
			color: var(--dark) !important;
			border-color: var(--gold);
			transform: translateY(-1px);
		}

		.page-hero {
			text-align: center;
			padding: 40px 24px 18px;
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

		/* ---------- Filter form ---------- */
		.filter-wrap {
			display: flex;
			justify-content: center;
		}

		.filter-form {
			display: flex;
			gap: 14px;
			background: var(--cream-card);
			border: 1px solid rgba(212, 175, 55, 0.25);
			border-radius: 999px;
			padding: 10px 12px;
			box-shadow: var(--shadow);
			align-items: center;
		}

		.filter-form select {
			border: none;
			background: transparent;
			padding: 10px 16px;
			font-family: 'Poppins', sans-serif;
			font-weight: 500;
			font-size: 0.9rem;
			color: var(--dark-2);
			outline: none;
			cursor: pointer;
		}

		.filter-form input[type="submit"] {
			padding: 10px 26px;
			background: var(--dark);
			color: var(--gold-pale);
			border: 1px solid var(--gold-soft);
			border-radius: 999px;
			font-weight: 600;
			letter-spacing: 0.4px;
			text-transform: uppercase;
			font-size: 0.8rem;
			cursor: pointer;
			transition: all 0.25s ease;
		}

		.filter-form input[type="submit"]:hover {
			background: var(--gold);
			color: var(--dark);
		}

		/* ---------- Table ---------- */
		.data-wrap {
			max-width: 1300px;
			margin: 34px auto 0;
			padding: 0 32px;
		}

		.data-wrap h3 {
			font-family: 'Playfair Display', serif;
			color: var(--dark-2);
			font-size: 1.3rem;
			margin-bottom: 14px;
			text-align: center;
		}

		.scroll {
			overflow-x: auto;
			border-radius: var(--radius-sm);
			box-shadow: var(--shadow);
		}

		table {
			border-collapse: collapse;
			width: 100%;
			min-width: 900px;
			background: var(--cream-card);
		}

		th {
			background: var(--dark);
			color: var(--gold-pale);
			text-transform: uppercase;
			font-size: 0.75rem;
			letter-spacing: 0.5px;
			padding: 14px 12px;
			text-align: left;
			border: none;
			white-space: nowrap;
		}

		td {
			padding: 11px 12px;
			border-bottom: 1px solid #ece3d1;
			font-size: 0.9rem;
			color: #4a4030;
		}

		tr:nth-child(even) td {
			background: #faf6ec;
		}

		tr:hover td {
			background: var(--gold-pale);
		}

		@media only screen and (max-width: 900px) {
			.filter-form {
				flex-direction: column;
				border-radius: var(--radius-sm);
				width: 90%;
			}

			.filter-form select,
			.filter-form input[type="submit"] {
				width: 100%;
			}

			.data-wrap {
				padding: 0 16px;
			}
		}
	</style>
</head>

<body>

	<div class="topbar">
		<a href="admin.php" class="n"><button type="button" class="btn" id="btn2">Back</button></a>
		<a href="logout.php" class="n"><button type="button" class="btn" id="btn1">Logout</button></a>
	</div>
	<div class="page-hero">
		<div class="eyebrow">Analytics</div>
		<h2>Academic Year Wise <span class="accent">Analysis</span></h2>
	</div>

	<div class="filter-wrap">
		<form method="POST" class="filter-form">
			<select id="academic" name="accy" required>
				<option value="">Academic Year</option>
				<option value="2019-2020">2019-2020</option>
				<option value="2020-2021">2020-2021</option>
				<option value="2021-2022">2021-2022</option>
				<option value="2022-2023">2022-2023</option>
				<option value="2023-2024">2023-2024</option>
				<option value="2024-2025">2024-2025</option>
				<option value="2025-2026">2025-2026</option>
				<option value="2026-2027">2026-2027</option>
				<option value="2027-2028">2027-2028</option>
				<option value="2028-2029">2028-2029</option>
				<option value="2029-2030">2029-2030</option>
			</select>
			<input type="submit" name="submit" value="Filter">
		</form>
	</div>

	<?php if (isset($_POST['submit'])) { ?>
		<div class="data-wrap">
			<div class="scroll">
				<table id="myTable">
					<tr class="header">
						<th style="width:30%;">Branch</th>
						<th style="width:20%;">Workshop</th>
						<th style="width:20%;">Project</th>
						<th style="width:20%;">Internship</th>
						<th style="width:20%;">Extracircular</th>
						<th style="width:20%;">Cocircular</th>
						<th style="width:20%;">Certificates</th>
					</tr>
					<?php
					// include "db_conn.php";
					// session_start();

					$accy = $_POST['accy'];
					$query = "SELECT * FROM department";
					$result = mysqli_query($conn, $query);
					while ($rows = mysqli_fetch_assoc($result)) {
						$branch = $rows['branch'];
						$sql = "SELECT * from sworkshop WHERE academic_year='$accy' and branch='$branch'";

						if ($results = mysqli_query($conn, $sql)) {
							$rowcount = mysqli_num_rows($results);
					?>
							<tr>
								<td><?php echo $branch; ?></td>
								<td><?php echo $rowcount;
								} ?></td>
								<?php
								$sql1 = "SELECT * from sproject WHERE academicyear='$accy' and branch='$branch'";

								if ($results1 = mysqli_query($conn, $sql1)) {
									$rowcount1 = mysqli_num_rows($results1);
								?>
									<td><?php echo $rowcount1;
									} ?></td>
									<?php
									$sql2 = "SELECT * from sinternship WHERE academic_year='$accy' and branch='$branch'";

									if ($results2 = mysqli_query($conn, $sql2)) {
										$rowcount2 = mysqli_num_rows($results2);
									?>
										<td><?php echo $rowcount2;
										} ?></td>
										<?php
										$sql3 = "SELECT * from extracircular WHERE academic_year='$accy' and branch='$branch'";

										if ($results3 = mysqli_query($conn, $sql3)) {
											$rowcount3 = mysqli_num_rows($results3);
										?>
											<td><?php echo $rowcount3;
											} ?></td>
											<?php
											$sql4 = "SELECT * from cocircular WHERE academic_year='$accy' and branch='$branch'";

											if ($results4 = mysqli_query($conn, $sql4)) {
												$rowcount4 = mysqli_num_rows($results4);
											?>
												<td><?php echo $rowcount4;
												} ?></td>
												<?php
												$sql7 = "SELECT * from course WHERE academicyear='$accy' and branch='$branch'";

												if ($results7 = mysqli_query($conn, $sql7)) {
													$rowcount7 = mysqli_num_rows($results7);
												?>
													<td><?php echo $rowcount7;
													} ?></td>
							</tr>
						<?php
					}

						?>
				</table>
			</div>
		</div>
	<?php } else { ?>
		<div class="data-wrap">
			<div class="scroll">
				<table id="myTable">
					<tr class="header">
						<th style="width:30%;">Branch</th>
						<th style="width:20%;">Workshop</th>
						<th style="width:20%;">Project</th>
						<th style="width:20%;">Internship</th>
						<th style="width:20%;">Extracircular</th>
						<th style="width:20%;">Cocircular</th>
						<th style="width:20%;">Certificates</th>
					</tr>
					<?php
					$query = "SELECT * FROM department";
					$result = mysqli_query($conn, $query);
					while ($rows = mysqli_fetch_assoc($result)) {
						$branch = $rows['branch'];
						$sql = "SELECT * from sworkshop WHERE branch='$branch' ";

						if ($results = mysqli_query($conn, $sql)) {
							$rowcount = mysqli_num_rows($results);
					?>
							<tr>
								<td><?php echo $branch; ?></td>
								<td><?php echo $rowcount;
								} ?></td>
								<?php
								$sql1 = "SELECT * from sproject WHERE branch='$branch'";

								if ($results1 = mysqli_query($conn, $sql1)) {
									$rowcount1 = mysqli_num_rows($results1);
								?>
									<td><?php echo $rowcount1;
									} ?></td>
									<?php
									$sql2 = "SELECT * from sinternship WHERE branch='$branch'";

									if ($results2 = mysqli_query($conn, $sql2)) {
										$rowcount2 = mysqli_num_rows($results2);
									?>
										<td><?php echo $rowcount2;
										} ?></td>
										<?php
										$sql3 = "SELECT * from extracircular WHERE branch='$branch'";

										if ($results3 = mysqli_query($conn, $sql3)) {
											$rowcount3 = mysqli_num_rows($results3);
										?>
											<td><?php echo $rowcount3;
											} ?></td>
											<?php
											$sql4 = "SELECT * from cocircular WHERE branch='$branch'";

											if ($results4 = mysqli_query($conn, $sql4)) {
												$rowcount4 = mysqli_num_rows($results4);
											?>
												<td><?php echo $rowcount4;
												} ?></td>
												<?php
												$sql7 = "SELECT * from course WHERE branch='$branch' ";

												if ($results7 = mysqli_query($conn, $sql7)) {
													$rowcount7 = mysqli_num_rows($results7);
												?>
													<td><?php echo $rowcount7;
													} ?></td>
							</tr>
						<?php
					}

						?>
				</table>
			</div>
		</div>
	<?php } ?>

</body>

</html>	