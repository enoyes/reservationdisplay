<?php include '../phplogins/phplogin.php';

$getuser = $_POST["user"];
$getpass = $_POST["pass"];
//$getuser = stripslashes($getuser);
//$getpass = stripslashes($getpass);
//$getuser = mysql_real_escape_string($getuser);
//$getpass = mysql_real_escape_string($getpass);

$q = "SELECT * FROM members WHERE username='$getuser' and password='$getpass'";

$result = mysqli_query($con, $q);

$count = mysqli_num_rows($result);

$farr = mysqli_fetch_array($result);
if($count == 1){
	
	if (session_start()){
	$_SESSION["uid"] = $farr['u_id'];
	$_SESSION["name"] = $farr['lastname'].", ".$farr['firstname'];
	$_SESSION["loggedin"] = 1;
	echo 1;
	}
	else{
	echo -1;
	}
}

else{
echo 0;

}

?>