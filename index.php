<?php
	session_start();
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<link rel="stylesheet" href="./css/style.css">
</head>
<body style="background-color: #7f8c8d">
	<div id="main-wrapper">
		<center>
			<h2>Login Form</h2>
			<img src="imgs/avatar.png" alt="Avatar" class="avatar">
		</center>
	
		<form class="form" action="index.php" method="post">
			<b><label for="username">Username: </label></b>
			<input name="username" type="text" id="username" class="inputvalues" placeholder="Type your username" required>
			<b><label for="password">Password: </label></b>
			<input name="password" type="password" id="password" class="inputvalues" placeholder="Type your password" required>
			<input name="login_btn" type="submit" id="login_btn" value="Login">
			<a href="register.php"><input name="register_btn" type="button" id="register_btn" value="Register"></a>
		</form>
	</div>

	<?php
		if (isset($_POST['login_btn'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$query = "SELECT * FROM fileuploadtable WHERE username='$username' AND password='$password'";
			$query_run = mysqli_query($con, $query);
			if (mysqli_num_rows($query_run)>0){
				//vaild
				$row = mysqli_fetch_assoc($query_run);
				$_SESSION['username']=$row['$username'];
				$_SESSION['imglink']=$row['imglink'];
				header('location:homepage.php');
			}else{
				//invalid
				echo '<script type="text/javascript">alert("Invalid username or password")</script>';
			}
		}
	?>

</body>
</html>