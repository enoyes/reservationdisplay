<?php
include '../phplogins/phplogin.php';
include "../phpclass/procedure.class.php"; 

$newuser = $_POST['newuser'];
$newpass = $_POST['newpass'];
$newfn = $_POST['newfn'];
$newln = $_POST['newln'];
$newemail = $_POST['newemail'];

$mycon = new Procedure($con);
$result = $mycon->add_user($newuser, $newpass, $newfn, $newln, $newemail);

if ($result == -1){
	echo "Username already taken";
	exit;
}
else{
	echo "User Added";
	exit;
}


?>
