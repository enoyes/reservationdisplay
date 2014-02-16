<?php 
include '../phplogins/phplogin.php';
include "../phpclass/procedure.class.php"; 
session_start();

$sdate = $_GET['sdate'];
$edate = $_GET['edate'];
$sid = $_GET['sid'];
$uid = $_SESSION['uid'];

$proc = new procedure($con);
$result = $proc->check_avail($uid, $sid, $sdate, $edate);

echo $result;

?>