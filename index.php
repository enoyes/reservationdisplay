<?php include "login/islog.php"; ?>
<?php require_once "phpclass/procedure.class.php"; ?>

<head>
	<link rel="stylesheet" href="reserve.css" media="screen"/>
	<link rel="shortcut icon" href="http://ernoyes.com/images/engineering.png" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<title> Reservations </title>
</head>

<body>
	<div id="overlay"> </div>
	<div id="infopane" class="lcorange">
		
		<div id="innerinfo"> </div> 
		<ul id="infonav">
			<li id="infoinfo" class="lcpurpleh"><div>Info</div></li>
			<li id="inforeserve" class="lclblueh"> <div>Reserve</div> </li>
			<li id="e" class="lcdblueh"> </li>
			<li id="infoexit" class="lctanh" style="border-bottom:5px solid #000"> <div>Close</div> </li>
		</ul>
		
	</div>
	<div id="dashboard">
		<div id="leftdash" class="lclblue"> 
			<div class="lcdblue" style="height:180px;border-bottom:5px solid #000000;"> </div>
		</div>
		
		<div id="dashcontentwrap"> 
			<div id="access" style="width:80%;background:#000;height:60px;margin:5% 0 0 0;text-align:center;font-family:lcars;color:#DD6644;font-size:100;">Access Granted</div>
		</div>
		<div id="botdash" class="lclblue"> 
			<div class="lclblue" style="margin-left:100px;height:30px;width:100px;border-left:5px solid #000;float:left;"> </div>
			<div class="lclblue" style="height:30px;width:300px;border-left:5px solid #000;float:left;"> </div>
			<div class="lcdblue" style="height:30px;width:300px;border-left:5px solid #000;float:left;"> </div>
			<div class="lclblue" style="height:30px;width:100px;border-left:5px solid #000;float:left;border-right:5px solid #000;"> </div>
		</div>
		
	</div>
	
	<div id="mainareawrap">
	
		<div id="navpane" class="lcorange">
			<ul id="navbuttons">
				<li id="expand" class="lcorangeh"> <div>Hide Dashboard</div></li>
				<li id="shipman" class="lcdblueh"> <div>Ship Manifest</div> </li>
				<li id="currentres" class="lclblueh"> <div>Current Reservations</div> </li>
				<li id="logout" class="lctanh" style="border-bottom:5px solid black"> <div>Logout</div> </li>
				
			</ul>
		</div>
		<div id="mainupper" class="lcorange">
			<div class="lclblue" style="margin-left:100px;height:30px;width:100px;border-left:5px solid #000;float:left;"> </div>
			<div class="lclblue" style="height:30px;width:300px;border-left:5px solid #000;float:left;"> </div>
			<div class="lcdblue" style="height:30px;width:300px;border-left:5px solid #000;float:left;"> </div>
			<div class="lclblue" style="height:30px;width:100px;border-left:5px solid #000;float:left;border-right:5px solid #000;"> </div>		
		</div>
		
		<div id="mcborder" class="lcorange" style="margin-left:150px;width:inherit;height:435px;">
			<div id="maincontentwrap"> </div>
		</div>
	</div>

</body>

<script>
var hiddendash = 1;
var infopane = 0;
$(document).ready(function(){
	blinkag();
	setTimeout(loaddash, 5000);

	addevents();
	resize();
	window.onresize = resize;
});

function blinkag(){
	
	$("#access").fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500);
}

function loaddash(){
	$("#dashcontentwrap").load("userdash/userdash.php");
}

function loadman(){
	$("#maincontentwrap").load("shipman/shipman.php");
}

function loadcurres(){
	$("#maincontentwrap").load("currentres/currentres.php");
}

function addevents(){
	$("#expand").click(function(){
		if(hiddendash == 1){
			console.log("hide");
			$("#dashboard").hide();
			hiddendash = 0;
			$("#expand").children().text("Show Dashboard");
			resize();
			//$("#navpane").css("height", window.innerHeight - 5);
		}
		else{
			console.log("show");
			$("#dashboard").show();
			hiddendash = 1;
			$("#expand").children().text("Hide Dashboard");
			resize();
			//$("#navpane").css("height", window.innerHeight - 305)
		}
	});
	
	$("#shipman").click(function(){
		loadman();
	});
	
	$("#logout").click(function(){
		logout();
	});
	
	$("#infoexit").click(function(){ toggleinfo() });
	
	$("#inforeserve").click(function(){
	
		$("#innerinfo").load("shipman/shipres.php?shipid=" + $("#infopane").data('id'));
	
	});
	
	$("#infoinfo").click(function(){
	
		$("#innerinfo").load("shipman/moreshipinfo.php?shipid=" + $("#infopane").data('id'));
	
	});
	
	$("#currentres").click(loadcurres);
	
}



function toggleinfo(){
	if (infopane === 0){
		$("#infopane").show();
		$("#overlay").show();
		infopane = 1;
	}
	else{
	$("#infopane").hide();
	$("#overlay").hide();
		infopane = 0;
	}
}



function logout(){
	$.get("login/logout.php", 
		function(){
			$(location).attr('href', "login");
		});

}

function resize(){
	winh = window.innerHeight;
	winw = window.innerWidth;
	
	
	
	
	
	
	$("#mcborder").css("width", winw - 150);
	
	
	if (hiddendash == 1){
	$("#mainareawrap").css("height", winh - 305);
	$("#navpane").css("height", winh - 305);
	$("#maincontentwrap").css("height", winh - 340);
	$("#mcborder").css("height", winh - 352);
	}
	else
	{
	$("#mainareawrap").css("height", winh - 5);
	$("#navpane").css("height", winh - 5);
	$("#maincontentwrap").css("height", winh - 40);
	$("#mcborder").css("height", winh - 52);
	}
	
	if (winw > 1110){
	$("#botdash").css("width", winw - 150);
	$("#mainupper").css("width", winw - 150);
	$("#dashcontentwrap").css("width", winw - 150);
	$("#maincontentwrap").css("width", winw - 150);
	}
	else{
	$("#botdash").css("width", 950);
	$("#mainupper").css("width", 950);
	$("#dashcontentwrap").css("width", 950);
	$("#maincontentwrap").css("width", 950);
	}
	console.log("resized");
}
	

</script>