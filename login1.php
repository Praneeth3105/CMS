<?php
include "db_conn.php";

if (isset($_POST['submit'])) {

	session_start();
	$uname = mysqli_real_escape_string($conn, $_POST['username']);
	$pass  = mysqli_real_escape_string($conn, $_POST['password']);
	$query  = "SELECT * FROM studentdetails WHERE username='$uname' AND password='$pass'";
	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) == 1) {

		$row = mysqli_fetch_assoc($result);

		$_SESSION['username'] = $uname;
		$_SESSION['id']        = $row['id'];
		$_SESSION['name']      = $row['name'];
		// add any other student fields you need, e.g. $_SESSION['course'] = $row['course'];

		header("Location: studentdat.php");
		exit();
	} else {

		header("Location: login1.php?error=Invalid username or password");
		exit();
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Login | Certificate Management System</title>

	<link rel="icon" href="icon2.png">
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

	<style>
		:root {
			--ink: #0d0d0d;
			--cream: #f7f4ef;
			--gold: #c9a84c;
			--rust: #b84c2c;
			--muted: #6b6560;
			--card: #ffffff;
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'DM Sans', sans-serif;
			background: var(--cream);
			min-height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			overflow-x: hidden;
		}

		body::before {
			content: '';
			position: fixed;
			inset: 0;
			background: linear-gradient(135deg, #f4efe2 0%, #ece2c8 100%);
			z-index: -2;
		}

		body::after {
			content: '';
			position: fixed;
			top: -180px;
			right: -150px;
			width: 500px;
			height: 500px;
			border-radius: 50%;
			background: radial-gradient(circle, rgba(184, 76, 44, .10), transparent 70%);
			z-index: -1;
		}

		.container {
			width: 100%;
			max-width: 430px;
			padding: 20px;
		}

		.login-card {
			background: #fff;
			border-radius: 20px;
			padding: 40px 35px;
			box-shadow: 0 20px 45px rgba(0, 0, 0, .18);
			border: 1px solid #ece5d8;
		}

		.logo {
			width: 90px;
			height: 90px;
			margin: auto;
			border-radius: 50%;
			display: flex;
			justify-content: center;
			align-items: center;
			background: linear-gradient(135deg, #fbf7ee, #f1e6c9);
			border: 1px solid rgba(201, 168, 76, .5);
			margin-bottom: 20px;
		}

		.logo span {
			font-size: 42px;
			color: var(--rust);
		}

		h2 {
			text-align: center;
			font-family: 'Playfair Display', serif;
			color: var(--ink);
			font-size: 2rem;
		}

		.subtitle {
			text-align: center;
			color: var(--muted);
			margin: 10px 0 30px;
		}

		.input-group {
			margin-bottom: 22px;
		}

		.input-group label {
			display: block;
			margin-bottom: 8px;
			color: #555;
			font-weight: 600;
		}

		.input-box {
			display: flex;
			align-items: center;
			border: 1px solid #ddd;
			border-radius: 12px;
			padding: 14px 15px;
			transition: .3s;
		}

		.input-box:focus-within {
			border-color: var(--gold);
			box-shadow: 0 0 0 4px rgba(201, 168, 76, .15);
		}

		.input-box i {
			color: var(--gold);
			margin-right: 12px;
			font-size: 18px;
		}

		.input-box input {
			border: none;
			outline: none;
			width: 100%;
			font-size: 15px;
			background: none;
		}

		.btn-login {
			width: 100%;
			border: none;
			border-radius: 30px;
			padding: 14px;
			background: linear-gradient(to right, var(--ink), #2a2113, var(--ink));
			color: #fff;
			font-size: 15px;
			font-weight: 600;
			text-transform: uppercase;
			cursor: pointer;
			transition: .3s;
		}

		.btn-login:hover {
			color: var(--gold);
			transform: translateY(-2px);
		}

		.error {
			background: #fde8e8;
			color: #c0392b;
			border-radius: 8px;
			padding: 10px;
			margin-bottom: 20px;
			text-align: center;
		}

		.back {
			display: block;
			text-align: center;
			text-decoration: none;
			color: var(--gold);
			margin-top: 22px;
			font-weight: 600;
		}

		.back:hover {
			color: #b84c2c;
		}

		@media(max-width:480px) {

			.login-card {
				padding: 30px 20px;
			}

			h2 {
				font-size: 1.8rem;
			}

		}
	</style>
</head>

<body>

	<div class="container">

		<div class="login-card">

			<form method="POST" action="">

				<div class="logo">
					<span class="material-icons">school</span>
				</div>

				<h2>Student Login</h2>

				<p class="subtitle">
					Certificate Management System
				</p>

				<?php if (isset($_GET['error'])) { ?>
					<div class="error">
						<?php echo htmlspecialchars($_GET['error']); ?>
					</div>
				<?php } ?>

				<div class="input-group">
					<label>Username</label>

					<div class="input-box">
						<i class="fas fa-user"></i>
						<input
							type="text"
							name="username"
							placeholder="Enter Username"
							required>
					</div>
				</div>

				<div class="input-group">
					<label>Password</label>

					<div class="input-box">
						<i class="fas fa-lock"></i>
						<input
							type="password"
							name="password"
							placeholder="Enter Password"
							required>
					</div>
				</div>

				<button type="submit" class="btn-login" name="submit">
					Login
				</button>

			</form>

			<a href="index.php" class="back">
				← Back to Home
			</a>

		</div>

	</div>

</body>

</html>