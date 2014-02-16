<head>
<?php 
include '../phplogins/phplogin.php';
include "../phpclass/procedure.class.php"; 
session_start();

$shipid = $_GET["shipid"];

?>

</head>
<body>

<?php

$q1 = "select s_name from ship_info where s_id = $shipid";
$ship = mysqli_query($con, $q1);
$ship = mysqli_fetch_array($ship);

$proc = new procedure($con);
$free = $proc->get_cur_reserve($shipid);


?>

<h1 class='text1'>Reservation For <?php echo $ship["s_name"]?></h1>
<h2 class='text2'>Current Status: <?php echo $free; ?></h2>
<div class='text2'>Start Date: <input class="datefields" maxlength="16" type="date" id="startdate"></input></div>
<div class='text2'>End Date: <input class="datefields" maxlength="16" type="date" id="enddate" /></div>

<div id="reschecker" class='text2'>
	<span id='checkbutton'>Check</span>
	<div id='resulttext'>Status</div>
</div>
<div id="paybutton" class='text2'><div>Reserve</div></div>					

</body>
<script>
$(document).ready(function(){
addsrevents();
goodtogo(0);
});

function addsrevents(){
	
	$('#checkbutton').click(checkRes);

	$('.datefields').change(function(){goodtogo(0);});
	
	$('#paybutton').click(reserve);
	
}

function checkRes(){
	goodtogo(0);
	var edate = $('#enddate').val();
	var sdate = $('#startdate').val();
	var cdate = new Date();
	var cdate = cdate.getFullYear().toString() + "-0" + (cdate.getMonth() + 1).toString() + "-" + cdate.getDate().toString();
	if(edate == "" || sdate == ""){
		$('#resulttext').html("Select valid start and end dates!").css('opacity', '1');
	}
	else if(edate < sdate){
		$('#resulttext').html("End date isn't larger than start date!").css('opacity', '1');
	}
	else if(sdate < cdate){
		$('#resulttext').html("Date must not be in past!").css('opacity', '1');
		console.log(sdate + " < " + cdate);
	}
	else{
		$.ajax({
			type: "GET",
			url: "shipman/shipavail.php",
			data: "sdate=" + sdate + "&edate=" + edate + "&sid=" + "<?php echo $shipid?>",
			timeout: 6000,
			success: function(response) {
				//console.log(response);
				checkResHelp(response);
				
				}
			});
		
	}


}

function checkResHelp(i){
		if (i == 0){
			$('#resulttext').html("Good to go!").css('opacity', '1');
			goodtogo(1);
		}
		if (i == 1){
			$('#resulttext').html("Insufficient Funds!").css('opacity', '1');
		}
		if (i == 2){
			$('#resulttext').html("Conflict with existing reservation!").css('opacity', '1');
		}
		if (i == 3){
			$('#resulttext').html("You have an existing reservation!").css('opacity', '1');
		}
	
}

function goodtogo(toggle){
	if (toggle){
		$("#paybutton").css('opacity', 1);
		$("#paybutton").data('disabled', 0)
	}
	else{
		$("#paybutton").data('disabled', 1);
		$("#paybutton").css('opacity', .1);
	}
}

function reserve(){
	if ($("#paybutton").data('disabled')){}
	
	else{
	var edate = $('#enddate').val();
	var sdate = $('#startdate').val();
	$.ajax({
	type: "POST",
	url: "shipman/shipreserve.php",
	data: "sdate=" + sdate + "&edate=" + edate + "&sid=" + "<?php echo $shipid?>",
	timeout: 120000,
	success: function(output){
		goodtogo(0);
		toggleinfo();
		loaddash();
		alert("Reserved <?php echo $ship["s_name"]?> From " + sdate + " to " + edate);
	}
	
	
	});
	
	
	}
}
</script>