<?php
$USER="admin";
$PASS="admin";
$ADD="localhost";
$DB="reservation";

$con = mysqli_connect($ADD, $USER, $PASS, $DB);
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}




?>