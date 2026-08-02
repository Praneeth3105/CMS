<?php
include_once('db_conn.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="icon" type="image/x-icon" href="icon2.png">
	<title>CERTIFICATE MAINTANCE SYSTEM</title>
	<link rel="stylesheet" href="lightbox.min.css">
	<script src="lightbox-plus-jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap');

		:root {
			--bg-cream: #f4efe4;
			--bg-dark: #17120e;
			--bg-dark2: #211a14;
			--gold: #caa24c;
			--gold-light: #e6c877;
			--white: #ffffff;
			--ink: #2a231c;
			--border: #e6ddc8;
			--shadow: 0 10px 30px rgba(23, 18, 14, 0.10);
		}

		* {
			box-sizing: border-box;
		}

		body {
			background: var(--bg-cream);
			font-family: 'Poppins', sans-serif;
			color: var(--ink);
			margin: 0;
			padding-bottom: 60px;
			overflow-x: hidden;
		}

		h1 {
			font-family: 'Playfair Display', serif;
			font-size: 26px;
			margin: 0 0 16px 0;
		}

		h1::after {
			content: "";
			display: block;
			width: 64px;
			height: 3px;
			background: var(--gold);
			margin-top: 10px;
			border-radius: 2px;
		}

		h2 {
			font-family: 'Playfair Display', serif;
			font-size: 18px;
			margin: 0 12px 0 0;
		}

		.topbar {
			background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-dark2) 100%);
			padding: 18px 28px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			box-shadow: var(--shadow);
		}

		.topbar .n {
			text-decoration: none;
		}

		.btn,
		button,
		input[type=submit] {
			background: var(--bg-dark);
			color: var(--gold-light);
			border: 1px solid var(--gold);
			border-radius: 999px;
			padding: 10px 22px;
			font-family: 'Poppins', sans-serif;
			font-weight: 600;
			font-size: 14px;
			cursor: pointer;
			transition: all 0.2s ease;
		}

		.btn:hover,
		button:hover,
		input[type=submit]:hover {
			background: var(--gold);
			color: var(--bg-dark);
		}

		.topbar .btn {
			float: none;
		}

		#btn1,
		#btn2 {
			float: none !important;
			width: auto !important;
		}

		.panel {
			background: var(--white);
			margin: 24px 32px;
			padding: 24px 28px;
			border-radius: 14px;
			box-shadow: var(--shadow);
			border: 1px solid var(--border);
		}

		.cen {
			text-align: center;
		}

		.cen form {
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 14px;
			flex-wrap: wrap;
		}

		input[type=date] {
			border: 1px solid var(--border);
			border-radius: 8px;
			padding: 10px 14px;
			font-family: 'Poppins', sans-serif;
		}

		select {
			background-color: var(--white) !important;
			color: var(--ink) !important;
			border: 1px solid var(--gold) !important;
			border-radius: 8px;
			padding: 10px 14px;
			font-size: 15px;
			font-family: 'Poppins', sans-serif;
			cursor: pointer;
			float: none !important;
			width: auto !important;
		}

		#myTable {
			border-collapse: collapse;
			width: 100%;
			background: var(--white);
			font-size: 14px;
			border-radius: 10px;
			overflow: hidden;
		}

		#myTable th,
		#myTable td {
			text-align: left;
			padding: 10px 12px;
			border-bottom: 1px solid var(--border);
			white-space: nowrap;
		}

		#myTable tr.header {
			background: var(--bg-dark);
			color: var(--gold-light);
			font-weight: 600;
		}

		#myTable tr:hover {
			background-color: #faf6ea;
		}

		.n {
			text-decoration: none;
		}

		.scroll {
			height: 320px;
			overflow: auto;
			width: 100%;
		}

		@media only screen and (max-width: 900px) {
			.scroll {
				width: 100%;
			}

			.panel {
				margin: 16px;
				padding: 18px;
			}
		}
	</style>
</head>

<body>
	<div class="topbar">
		<a href="admin.php" class="n"><button type="button" class="btn" id="btn2">Back</button></a>
		<a href="logout.php" class="n"><button type="button" class="btn" id="btn1">Logout</button></a>
	</div>

	<div class="panel">
		<div class="cen">
			<form method="POST">
				<span>From <input type="date" id="min" name="stdd"></span>
				<span>To <input type="date" id="max" name="endd"></span>
				<input type="submit" name="submit" id="bb">
			</form>
		</div>

		<br>
		<a href="graph.php" class="n"><button type="button" class="btn" id="btn1">Graph Analysis</button></a>
		
		<br><br>
		<h1>Faculty Details</h1>

		<?php if (isset($_POST['submit'])) {
			$std = $_POST['stdd'];
			$end = $_POST['endd'];
		?>
			<div class="login-content">
				<div class="scroll">
					<table id="myTable">
						<tr class="header">
							<th style="width:60%;">Faculty Names</th>
							<th style="width:60%;">Workshop Attended</th>
							<th style="width:30%;">Seminar Attended</th>
							<th style="width:20%;">Conference Attended</th>
							<th style="width:30%;">Workshop Organized</th>
							<th style="width:20%;">Seminar Organized</th>
							<th style="width:30%;">Conference Organized</th>
							<th style="width:20%;">Paper Publications</th>

							<th style="width:20%;">Certifications</th>

							<th style="width:20%;">Book Chapters Published</th>
							<th style="width:20%;">Book Chapters Edited</th>
							<th style="width:20%;">FDP</th>

						</tr>
						<tr>
							<?php
							include "db_conn.php";
							#$name=$_SESSION['name'];
							$std = $_POST['stdd'];
							$endd = $_POST['endd'];
							$query = "SELECT * FROM faculty";
							$result = mysqli_query($conn, $query);
							while ($rows = mysqli_fetch_assoc($result)) {
								$names = $rows['name'];
								$sql = "SELECT * from fworkshop WHERE name='$names' and type='workshop' AND startdate BETWEEN '$std' AND '$end'
AND enddate BETWEEN '$std' AND '$end'";

								if ($results = mysqli_query($conn, $sql)) {
									$rowcount = mysqli_num_rows($results);

							?>
									<td><?php echo $rows['name']; ?></td>
									<td><?php echo $rowcount;
									} ?></td>

									<?php
									$sql1 = "SELECT * from fworkshop WHERE name='$names' and type='seminar' AND startdate BETWEEN '$std' AND '$end'
AND enddate BETWEEN '$std' AND '$end'";

									if ($results1 = mysqli_query($conn, $sql1)) {
										$rowcount1 = mysqli_num_rows($results1);
									?>
										<td><?php echo $rowcount1;
										} ?></td>
										<?php
										$sql2 = "SELECT * from fworkshop WHERE name='$names' and type='conference' AND startdate BETWEEN '$std' AND '$end'
AND enddate BETWEEN '$std' AND '$end'";

										if ($results2 = mysqli_query($conn, $sql2)) {
											$rowcount2 = mysqli_num_rows($results2);
										?>
											<td><?php echo $rowcount2;
											} ?></td>
											<?php
											$sql3 = "SELECT * from ffworkshop WHERE name='$names' and type='workshop' AND startdate BETWEEN '$std' AND '$end'
AND enddate BETWEEN '$std' AND '$end'";

											if ($results3 = mysqli_query($conn, $sql3)) {
												$rowcount3 = mysqli_num_rows($results3);
											?>
												<td><?php echo $rowcount3;
												} ?></td>
												<?php
												$sql4 = "SELECT * from ffworkshop WHERE name='$names' and type='seminar' AND startdate BETWEEN '$std' AND '$end'
AND enddate BETWEEN '$std' AND '$end'";

												if ($results4 = mysqli_query($conn, $sql4)) {
													$rowcount4 = mysqli_num_rows($results4);
												?>
													<td><?php echo $rowcount4;
													} ?></td>
													<?php
													$sql5 = "SELECT * from ffworkshop WHERE name='$names' and type='conference' AND startdate BETWEEN '$std' AND '$end'
AND enddate BETWEEN '$std' AND '$end'";

													if ($results5 = mysqli_query($conn, $sql5)) {
														$rowcount5 = mysqli_num_rows($results5);
													?>
														<td><?php echo $rowcount5;
														} ?></td>
														<?php
														$sql6 = "SELECT * from paperpublications WHERE name='$names' AND date BETWEEN '$std' AND '$end'";

														if ($results6 = mysqli_query($conn, $sql6)) {
															$rowcount6 = mysqli_num_rows($results6);
														?>
															<td><?php echo $rowcount6;
															} ?></td>
															<?php
															$sql7 = "SELECT * from certificates WHERE name='$names' AND startdate BETWEEN '$std' AND '$end'
AND enddate BETWEEN '$std' AND '$end'";

															if ($results7 = mysqli_query($conn, $sql7)) {
																$rowcount7 = mysqli_num_rows($results7);
															?>
																<td><?php echo $rowcount7;
																} ?></td>
																<?php
																$sql8 = "SELECT * from bookpublish WHERE name='$names' AND date BETWEEN '$std' AND '$end'";

																if ($results8 = mysqli_query($conn, $sql8)) {
																	$rowcount8 = mysqli_num_rows($results8);
																?>
																	<td><?php echo $rowcount8;
																	} ?></td>
																	<?php
																	$sql9 = "SELECT * from bookedited WHERE name='$names' AND date BETWEEN '$std' AND '$end'";

																	if ($results9 = mysqli_query($conn, $sql9)) {
																		$rowcount9 = mysqli_num_rows($results9);
																	?>
																		<td><?php echo $rowcount9;
																		} ?></td>
																		<?php
																		$sql10 = "SELECT * from fdp WHERE name='$names' AND startdate BETWEEN '$std' AND '$end'
AND enddate BETWEEN '$std' AND '$end'";

																		if ($results10 = mysqli_query($conn, $sql10)) {
																			$rowcount10 = mysqli_num_rows($results10);
																		?>
																			<td><?php echo $rowcount10;
																			} ?></td>

						</tr>
					<?php
							}
					?>
					</table>
				</div>
			</div>

		<?php  } else { ?>

			<div class="login-content">
				<div class="scroll">
					<table id="myTable">
						<tr class="header">
							<th style="width:60%;">Faculty Names</th>
							<th style="width:60%;">Workshop Attended</th>
							<th style="width:30%;">Seminar Attended</th>
							<th style="width:20%;">Conference Attended</th>
							<th style="width:30%;">Workshop Organized</th>
							<th style="width:20%;">Seminar Organized</th>
							<th style="width:30%;">Conference Organized</th>
							<th style="width:20%;">Paper Publications</th>

							<th style="width:20%;">Certifications</th>

							<th style="width:20%;">Book Chapters Published</th>
							<th style="width:20%;">Book Chapters Edited</th>
							<th style="width:20%;">FDP</th>

						</tr>
						<tr>
							<?php
							include "db_conn.php";
							#$name=$_SESSION['name'];
							#           $std=$_POST['stdd'];
							#           $endd=$_POST['endd'];
							$query = "SELECT * FROM faculty";
							$result = mysqli_query($conn, $query);
							while ($rows = mysqli_fetch_assoc($result)) {
								$names = $rows['name'];
								$sql = "SELECT * from fworkshop WHERE name='$names' and type='workshop'";

								if ($results = mysqli_query($conn, $sql)) {
									$rowcount = mysqli_num_rows($results);

							?>
									<td><?php echo $rows['name']; ?></td>
									<td><?php echo $rowcount;
									} ?></td>

									<?php
									$sql1 = "SELECT * from fworkshop WHERE name='$names' and type='seminar'";

									if ($results1 = mysqli_query($conn, $sql1)) {
										$rowcount1 = mysqli_num_rows($results1);
									?>
										<td><?php echo $rowcount1;
										} ?></td>
										<?php
										$sql2 = "SELECT * from fworkshop WHERE name='$names' and type='conference'";

										if ($results2 = mysqli_query($conn, $sql2)) {
											$rowcount2 = mysqli_num_rows($results2);
										?>
											<td><?php echo $rowcount2;
											} ?></td>
											<?php
											$sql3 = "SELECT * from ffworkshop WHERE name='$names' and type='workshop'";

											if ($results3 = mysqli_query($conn, $sql3)) {
												$rowcount3 = mysqli_num_rows($results3);
											?>
												<td><?php echo $rowcount3;
												} ?></td>
												<?php
												$sql4 = "SELECT * from ffworkshop WHERE name='$names' and type='seminar'";

												if ($results4 = mysqli_query($conn, $sql4)) {
													$rowcount4 = mysqli_num_rows($results4);
												?>
													<td><?php echo $rowcount4;
													} ?></td>
													<?php
													$sql5 = "SELECT * from ffworkshop WHERE name='$names' and type='conference'";

													if ($results5 = mysqli_query($conn, $sql5)) {
														$rowcount5 = mysqli_num_rows($results5);
													?>
														<td><?php echo $rowcount5;
														} ?></td>
														<?php
														$sql6 = "SELECT * from paperpublications WHERE name='$names'";

														if ($results6 = mysqli_query($conn, $sql6)) {
															$rowcount6 = mysqli_num_rows($results6);
														?>
															<td><?php echo $rowcount6;
															} ?></td>
															<?php
															$sql7 = "SELECT * from certificates WHERE name='$names'";

															if ($results7 = mysqli_query($conn, $sql7)) {
																$rowcount7 = mysqli_num_rows($results7);
															?>
																<td><?php echo $rowcount7;
																} ?></td>
																<?php
																$sql8 = "SELECT * from bookpublish WHERE name='$names'";

																if ($results8 = mysqli_query($conn, $sql8)) {
																	$rowcount8 = mysqli_num_rows($results8);
																?>
																	<td><?php echo $rowcount8;
																	} ?></td>
																	<?php
																	$sql9 = "SELECT * from bookedited WHERE name='$names'";

																	if ($results9 = mysqli_query($conn, $sql9)) {
																		$rowcount9 = mysqli_num_rows($results9);
																	?>
																		<td><?php echo $rowcount9;
																		} ?></td>
																		<?php
																		$sql10 = "SELECT * from fdp WHERE name='$names'";

																		if ($results10 = mysqli_query($conn, $sql10)) {
																			$rowcount10 = mysqli_num_rows($results10);
																		?>
																			<td><?php echo $rowcount10;
																			} ?></td>

						</tr>
					<?php
							}
					?>
					</table>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="panel">
		<div class="cen">
			<form method="POST">
				<div style='display:flex;align-items:center;gap:14px;flex-wrap:wrap;justify-content:center;'>
					<h2>year</h2> <select id='year' onclick='my()' name='year' required>
						<option value="">Year</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
					<h2>Branch</h2> <select name="department" id="department" required>
						<option value="">Branch</option>
						<option value="CSM">CSM</option>
						<option value="CSE">CSE</option>
						<option value="CSO">CSO</option>
						<option value="CIC">CIC</option>
						<option value="EEE">EEE</option>
						<option value="ECE">ECE</option>
						<option value="MECH">MECH</option>
						<option value="CIVIL">CIVIL</option>
						<option value="CSD">CSD</option>
					</select>
					<input type="submit" name="submi" id="bb">
</div>
			</form>
		</div>

		<br>
		<a href="graph1.php" class="n"><button type="button" class="btn" id="btn1">Graph Analysis</button></a>
		<br><br>
		<h1>Student Details</h1>
		

		<?php if (isset($_POST['submi'])) {
			$year = $_POST['year'];
			$branch = $_POST['department'];
		?>
			<div class="login-content">
				<div class="scroll">
					<table id="myTable">
						<tr class="header">
							<th style="width:30%;">Student RollNo</th>
							<th style="width:30%;">Student Names</th>
							<th style="width:20%;">Workshop</th>
							<th style="width:20%;">Project</th>
							<th style="width:20%;">Internship</th>
							<th style="width:20%;">Extracircular</th>
							<th style="width:20%;">Cocircular</th>
							<th style="width:20%;">Certificates</th>


						</tr>
						<?php
						include "db_conn.php";
						#session_start();
						#$name=$_SESSION['name'];

						$query = "SELECT * FROM studentdetails WHERE  department='$branch' and year='$year' ";
						$result = mysqli_query($conn, $query);
						while ($rows = mysqli_fetch_assoc($result)) {
							$names = $rows['name'];
							$sql = "SELECT * from sworkshop WHERE name='$names' and branch='$branch' and year='$year'";

							if ($results = mysqli_query($conn, $sql)) {
								$rowcount = mysqli_num_rows($results);

						?>
								<tr>
									<td><?php echo $rows['username']; ?></td>
									<td><?php echo $rows['name']; ?></td>
									<td><?php echo $rowcount;
									} ?></td>
									<?php
									$sql1 = "SELECT * from sproject WHERE Name='$names' and branch='$branch' and year='$year'";

									if ($results1 = mysqli_query($conn, $sql1)) {
										$rowcount1 = mysqli_num_rows($results1);
									?>
										<td><?php echo $rowcount1;
										} ?></td>
										<?php
										$sql2 = "SELECT * from sinternship WHERE name='$names' and branch='$branch' and year='$year'";

										if ($results2 = mysqli_query($conn, $sql2)) {
											$rowcount2 = mysqli_num_rows($results2);
										?>
											<td><?php echo $rowcount2;
											} ?></td>
											<?php
											$sql3 = "SELECT * from extracircular WHERE name='$names' and branch='$branch' and year='$year'";

											if ($results3 = mysqli_query($conn, $sql3)) {
												$rowcount3 = mysqli_num_rows($results3);
											?>
												<td><?php echo $rowcount3;
												} ?></td>
												<?php
												$sql4 = "SELECT * from cocircular WHERE name='$names' and branch='$branch' and year='$year'";

												if ($results4 = mysqli_query($conn, $sql4)) {
													$rowcount4 = mysqli_num_rows($results4);
												?>
													<td><?php echo $rowcount4;
													} ?></td>
													<?php
													$sql7 = "SELECT * from course WHERE Name='$names' and branch='$branch' and year='$year'";

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
			</div><br>
		<?php } else { ?>
			<div class="login-content">
				<div class="scroll">
					<table id="myTable">
						<tr class="header">
							<th style="width:30%;">Student RollNo</th>
							<th style="width:30%;">Student Names</th>
							<th style="width:20%;">Workshop</th>
							<th style="width:20%;">Project</th>
							<th style="width:20%;">Internship</th>
							<th style="width:20%;">Extracircular</th>
							<th style="width:20%;">Cocircular</th>
							<th style="width:20%;">Certificates</th>


						</tr>
						<?php
						include "db_conn.php";
						#session_start();
						#$name=$_SESSION['name'];
						#$year=$_POST['year'];
						#$branch=$_POST['department'];
						$query = "SELECT * FROM studentdetails";
						$result = mysqli_query($conn, $query);
						while ($rows = mysqli_fetch_assoc($result)) {
							$names = $rows['name'];
							$sql = "SELECT * from sworkshop WHERE name='$names'";

							if ($results = mysqli_query($conn, $sql)) {
								$rowcount = mysqli_num_rows($results);

						?>
								<tr>
									<td><?php echo $rows['username']; ?></td>
									<td><?php echo $rows['name']; ?></td>
									<td><?php echo $rowcount;
									} ?></td>
									<?php
									$sql1 = "SELECT * from sproject WHERE Name='$names'";

									if ($results1 = mysqli_query($conn, $sql1)) {
										$rowcount1 = mysqli_num_rows($results1);
									?>
										<td><?php echo $rowcount1;
										} ?></td>
										<?php
										$sql2 = "SELECT * from sinternship WHERE name='$names'";

										if ($results2 = mysqli_query($conn, $sql2)) {
											$rowcount2 = mysqli_num_rows($results2);
										?>
											<td><?php echo $rowcount2;
											} ?></td>
											<?php
											$sql3 = "SELECT * from extracircular WHERE name='$names'";

											if ($results3 = mysqli_query($conn, $sql3)) {
												$rowcount3 = mysqli_num_rows($results3);
											?>
												<td><?php echo $rowcount3;
												} ?></td>
												<?php
												$sql4 = "SELECT * from cocircular WHERE name='$names'";

												if ($results4 = mysqli_query($conn, $sql4)) {
													$rowcount4 = mysqli_num_rows($results4);
												?>
													<td><?php echo $rowcount4;
													} ?></td>
													<?php
													$sql7 = "SELECT * from course WHERE Name='$names'";

													if ($results7 = mysqli_query($conn, $sql7)) {
														$rowcount7 = mysqli_num_rows($results7);
													?>
														<td><?php echo $rowcount7;
														} ?></td>
								</tr>
						<?php
						}
					}
						?>
					</table>
				</div>
			</div><br>
	</div>
	</div>

</body>

</html>