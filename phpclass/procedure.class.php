<?php

// This file was only necessary because ipage does not support stored procedures
// so after spending the time getting them working on localhost I made a class
// to keep track of procedures

class procedure
{


public $con;

public function __construct($constring)
{
	$this->con = $constring;
}

// Gets the current reservation given a ship id
public function get_cur_reserve($sid){
	$currdate = date('Y-m-d');

	$q = 	
	"SELECT 
	sr.*, 
	m.firstname,
	m.lastname
	FROM ship_reservations sr 
	INNER JOIN members m
	ON m.u_id = sr.u_id
	WHERE 
	sr.s_id = $sid AND
	sr.start_date <= '$currdate' AND
    sr.end_date >= '$currdate';";

	$result = mysqli_query($this->con, $q);

	$return = "";

	if (mysqli_num_rows($result) == 0){
		$return = "Free";
	}
	else{
		$result = mysqli_fetch_array($result);
		$return = "Reserved by ".$result['firstname']." ".$result['lastname'];
	}
	return $return;	
}

// Adds a reservation for the ship id given the user id and dates
public function add_reservation($uid, $sid, $sdate, $edate){

// Get the amount of credits the user has
$q = "SELECT s_price FROM ship_info WHERE s_id = $sid";
$result = mysqli_query($this->con, $q);
$price = mysqli_fetch_array($result);
$price = $price['s_price'];

// Get the price of the ship
$q = "SELECT credits FROM member_info WHERE member_info.u_id = $uid";
$result = mysqli_query($this->con, $q);
$credits = mysqli_fetch_array($result);
$credits = $credits['credits'];

$dsdate = new DateTime($sdate);
$dedate = new DateTime($edate);

$diff=$dsdate->diff($dedate);
$diff = (int)$diff->format('%a');
$price = $diff * $price;

$newcredits = $credits - $price;

$q = "UPDATE member_info SET credits = $newcredits WHERE member_info.u_id = $uid;";
mysqli_query($this->con, $q);

$q = "INSERT INTO ship_reservations VALUES (NULL, $sid, $uid, '$sdate', '$edate', $price)";
mysqli_query($this->con, $q);
}



// Checks the availability of a ship at a given time by a given user
public function check_avail($uid, $sid, $sdate, $edate){

$q = "SELECT credits FROM member_info WHERE member_info.u_id = $uid";
$result = mysqli_query($this->con, $q);
$credits = mysqli_fetch_array($result);
$credits = $credits['credits'];

$q = "SELECT reputation FROM member_info WHERE member_info.u_id = $uid";
$result = mysqli_query($this->con, $q);
$reputation = mysqli_fetch_array($result);
$reputation = $reputation['reputation'];

$q = "SELECT s_price FROM ship_info WHERE ship_info.s_id = $sid";
$result = mysqli_query($this->con, $q);
$price = mysqli_fetch_array($result);
$price = $price['s_price'];

$dsdate = new DateTime($sdate);
$dedate = new DateTime($edate);

$diff=$dsdate->diff($dedate);
$diff = (int)$diff->format('%a');
$price = $diff * $price;

// Is the ship reserved on these dates
$q = "SELECT COUNT(*) 'count' FROM ship_reservations sr WHERE sr.s_id = $sid AND sr.start_date < '$edate' AND sr.end_date > '$sdate'";
$result = mysqli_query($this->con, $q);
$overlap = mysqli_fetch_array($result);
$overlap = $overlap['count'];

// Is the user already reserving a ship on those dates
$q = "SELECT COUNT(*) 'count' FROM ship_reservations sr WHERE sr.u_id = $uid AND sr.start_date < '$edate' AND sr.end_date > '$sdate'";
$result = mysqli_query($this->con, $q);
$inuse = mysqli_fetch_array($result);
$inuse = $inuse['count'];

$return = 0;

if ($credits < $price){$return = 1;} // User does not have enough money
else if ($overlap > 0){$return = 2;} // Ship is reserved on some of those days
else if ($inuse > 0){$return = 3;} // User is reserving a ship at those times
else {$return = 0;}

return $return;
}

}


?>