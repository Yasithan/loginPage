<?php
	$con = mysqli_connect("localhost", "root", "") or die("Unable to conncet to the database");
	mysqli_select_db($con, 'logindb');
?>