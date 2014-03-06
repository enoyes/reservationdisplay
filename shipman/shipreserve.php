<?php
include '../phplogins/phplogin.php';
include "../phpclass/procedure.class.php"; 
session_start();

$sid = $_POST['sid'];
$sdate = $_POST['sdate'];
$edate = $_POST['edate'];
$uid = $_SESSION['uid'];

date_default_timezone_set('America/New_York');
if ($sdate == "" || $edate == ""){
	echo -1;
	exit;
}
else if ($edate < $sdate){
	echo -2;
	exit;
}


else if ($sdate < date("Y-m-d")){
	echo -3;
	exit;
}
else{

$proc = new procedure($con);
$error = $proc->check_avail($uid, $sid, $sdate, $edate);

}

if ($error == 0){
	
	$proc->add_reservation($uid, $sid, $sdate, $edate);
	
	
	echo 0;
	exit;
}
echo -4;
	exit;


?>
