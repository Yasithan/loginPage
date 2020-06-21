<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home Page</title>
	<link rel="stylesheet" href="./css/style.css">
</head>
<body style="background-color: #7f8c8d">
	<div id="main-wrapper">
		<center>
			<h2>Login Form</h2>
			<h3>Welcome
				<?php echo $_SESSION['username']?>
			</h3>
			<?php echo '<img class="avatar" src="'.$_SESSION["imglink"].'" alt="Avatar">'; ?>
		</center>
	
		<form class="form" action="homepage.php" method="post">
			<input name="logout_btn" type="submit" id="logout_btn" value="Log Out">
		</form>

		<?php
			if (isset($_POST['logout_btn'])) {
				session_destroy();
				header("location:index.php");
			}
		?>
	</div>
</body>
</html>