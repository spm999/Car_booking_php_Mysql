<?php 
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "my_car_rental_system";

	$conn = mysqli_connect($host, $user, $pass, $db);

	if ($conn) {
		echo "Connection to database successful";
	}
	else
	{
		echo "Check your Db connection";
	}
