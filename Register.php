<?php
	require_once 'dbconfig/config.php';	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration Page</title>
	<link rel="stylesheet" href="./css/style.css">

	<script type="text/javascript">
		function PreviewImage(){
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("imglink").files[0]);

			oFReader.onload = function (oFREvent){
				document.getElementById("uploadPreview").src = oFREvent.target.result;
			};
		};
	</script>
</head>

<body style="background-color: #7f8c8d">
	<form class="form" action="register.php" method="post" enctype="multipart/form-data">
		<div id="main-wrapper">
			<center>
				<h2>Registration Form</h2>
				<img id="uploadPreview" src="imgs/avatar.png" alt="Avatar" class="avatar"><br>
				<input type="file" id="imglink" name="imglink" accept=".jpg, jpeg, png" onchange="PreviewImage();"/>
			</center>
			<b><label for="fullname">Full Name: </label></b>
			<input name="fullname" type="text" id="fullname" class="inputvalues" placeholder="Type your full name" required>
			<!--<b><label for="gender">Gender: </label></b>
			<input type="radio" value="male" name="gender" class="radiobtns" id="gender" checked required>Male
			<input type="radio" value="female" name="gender" class="radiobtns" id="gender" required>Female</br>
			<label for="qualification"><b>Qualification</b></label>
			<select name="qualification" id="qualification" class="qualification">
				<option value="BIT">BIT</option>
				<option value="BMS">BMS</option>
				<option value="MCA">MCA</option>
				<option value="CIMA">CIMA</option>
			</select></br>-->
			<b><label for="username">Username: </label></b>
			<input name="username" type="text" id="username" class="inputvalues" placeholder="Type your username" required>
			<b><label for="password">Password: </label></b>
			<input name="password" type="password" id="password" class="inputvalues" placeholder="Type your password" required>
			<b><label for="cpassword">Confirm Password: </label></b>
			<input name="cpassword" type="password" id="cpassword" class="inputvalues" placeholder="Renter your password" required>
			<input name="signup_btn" type="submit" id="signup_btn" value="Sign Up">
			<a href="index.php"><input name="back_btn" type="button" id="back_btn" value="Back to Login Page"></a>
		</div>
	</form>
	<?php
		if (isset($_POST['signup_btn'])) {
			//echo '<script type="text/javascript">alert("Your profile has been created")</script>';
			
			$fullname = $_POST['fullname'];
			//$gender = $_POST['gender'];
			//$qualification = $_POST['qualification'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$cpassword = $_POST['cpassword'];

			$img_name = $_FILES['imglink']['name'];
			$img_size = $_FILES['imglink']['size'];
			$img_tmp = $_FILES['imglink']['tmp_name'];

			$directory = 'uploads/';
			$target_file = $directory.$img_name;


			if ($password == $cpassword) {
				$query = "SELECT * FROM fileuploadtable WHERE username = '$username'";
				$query_run = mysqli_query($con, $query);

				if (mysqli_num_rows($query_run)>0) {
					//there is already a user with the same name
					echo '<script type="text/javascript">alert("User already exists... try another username")</script>';
				}else if (file_exists($target_file)) {
					echo '<script type="text/javascript">alert("Image file alreadyexists... Try another image file")</script>';
				}else if ($img_size>2097152) {
					echo '<script type="text/javascript">alert("Image file size larger than 2MB.. Try another image")</script>';
				}else{
					move_uploaded_file($img_tmp, $target_file);
					$query = "INSERT INTO fileuploadtable VALUES ('', '$username', '$password', '$fullname', '$target_file')";
					$query_run = mysqli_query($con, $query);

					if ($query_run) {
						echo '<script type="text/javascript">alert("User Registered.. Go to login page to login")</script>';
					}else{
						echo '<script type="text/javascript">alert("Error!")</script>';
					}
				}
				/*else{
					$query = "INSERT INTO fileuploadtable VALUES ('', '$username', '$fullname', '$gender', '$qualification', '$password')";
					$query_run = mysqli_query($con, $query);

					if ($query_run) {
						echo '<script type="text/javascript">alert("Your profile has been created")</script>';
					}else{
						echo '<script type="text/javascript">alert("'.mysqli_error($con).'")</script>';
					}
				}*/
			}else{
				echo '<script type="text/javascript">alert("Password dont match")</script>';
			}
		}
	?>

</body>
</html>