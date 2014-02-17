<?php 
session_start();
include '../phplogins/phplogin.php';

$uid = $_SESSION['uid'];

$q = 	"SELECT si.s_name, sr.start_date, sr.end_date 
		FROM ship_reservations sr 
		INNER JOIN ship_info si ON sr.s_id = si.s_id 
		WHERE sr.u_id = $uid 
		ORDER BY sr.start_date";

$result = mysqli_query($con, $q);
$count = mysqli_num_rows($result);

$restablewrap = 238 + 48 * $count;
$restable = 208 + 48 * $count;
$resttop = 224 + 48*$count;

?>
<body>
<div id="restablewrap" class="lcpurple" style="height:<?php echo $restablewrap?>">
	<div id="restabledecor" style="height:<?php echo $restablewrap?>"></div>
	<div id="restable" style="height:<?php echo $restable?>;top:-<?php echo $resttop ?>">
	<table>
	<caption>Current Reservations for <?php echo $_SESSION['name']; ?></caption>
	<tr>
		<th>Ship</th>
		<th>Start Date</th>
		<th>End Date</th>
	</tr>
	<?php
	while($row = mysqli_fetch_array($result)){
		echo "	<tr>
					<th>".$row['s_name']."</th>
					<th>".$row['start_date']."</th>
					<th>".$row['end_date']."</th>
				</tr>";
	
	}
	?>


	</table>
	</div>
</div>
</body>