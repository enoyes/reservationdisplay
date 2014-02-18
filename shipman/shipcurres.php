<?php 
	session_start();
	include '../phplogins/phplogin.php';
	
	$sid = $_GET['shipid'];
	
	$q = "SELECT s_name FROM ship_info WHERE s_id = $sid"; //Get the ship name
	$name = mysqli_query($con, $q);
	$name = mysqli_fetch_array($name);
	$name = $name['s_name'];
	
	$q = 
	
	"SELECT m.lastname, sr.start_date, sr.end_date
	FROM ship_reservations sr
	INNER JOIN members m ON sr.u_id = m.u_id 
	WHERE sr.s_id = $sid
	ORDER BY sr.start_date";

	$result = mysqli_query($con, $q);

	$count = mysqli_num_rows($result);
	
	$restable = 208 + 48 * $count;
	
	
	
	?>

<div id="restable" style="height:<? echo $restable ?>;left:50%;margin:0 0 0 -300">
<table>
	<caption>Current Reservations for <?php echo $name ?></caption>
	<tr>
		<th>User</th>
		<th>Start Date</th>
		<th>End Date</th>
	</tr>
	<?php 
	while($row = mysqli_fetch_array($result)){
		echo "	<tr>
					<th>".$row['lastname']."</th>
					<th>".$row['start_date']."</th>
					<th>".$row['end_date']."</th>
				</tr>";
	
	}
	?>
</table>
<div>