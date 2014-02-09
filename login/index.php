<head>
	<link rel="stylesheet" href="reslogin.css" media="screen"/>
	<link rel="shortcut icon" href="http://ernoyes.com/images/engineering.png" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
</head>

<body>
	<div id="topbar" class="lcdblue">
		<div style="background:#000;margin-left:50px;width:10px;height:40px;position:absolute;"> </div>
		<div id="toptext" class="text1" style="background:#000;">RESERVATION SYSTEM - LOGIN</div>
	</div>
	<div id="mainarea">
		
		<div id="fedlogo"> <img src="http://ernoyes.com/reservation/images/unfp_logo.jpg" height="385.5" width="459" ></img> </div>
		<input class="userpass" maxlength="16" type="text" id="username" />
		<input class="userpass" maxlength="16" type="password" id="password" />
		<div id="login">Login </div>
	</div>
	<div id="topbar" style="margin-top:0px;" class="lcdblue">
		<div id="bottext" class="text1">LCARS - ONLINE</div>
		<div style="background:#000;margin-right:50px;width:10px;height:40px;float:right;"> </div>
	</div>


</body>
<script>
$(document).ready(function(){
	$("#username").focus();
	addevents();
	browserAlert();
});

function addevents(){
	$("#login").click(function(){
		login();
	});
	$(".userpass").keypress(function(e){
		if (e.keycode == 13 || event.which == 13){
			login();
		}
	});
	
	
	// Makes the password field larger if more than 10 chars are entered
/*	$("#password").keypress(function(e){
		var temp = $("#password").val().length;
		if (temp > 10){
			
			$("#password").css("width", 168 + 17 * (temp - 10));
		}
		
	});
	*/
	
}

function login(){
	$.get("login.php?user=" + $("#username").val() + "&pass=" + $("#password").val(), 
		function(data){
			console.log(data);
			if (data == 1){
				$(location).attr('href', "..");
			}
			else{
			alert("Invalid Credentials \nTry user/pass or grader/grader"); 
			}
		});
}

function getBrowserId () {

    var
        types = ["MSIE", "Firefox", "Chrome", "Safari", "Opera"],
        userbr = navigator.userAgent, i = types.length - 1;

    for (i; i > -1 && userbr.indexOf(types[i]) === -1; i--);

    return i

}

function browserAlert(){
	if (getBrowserId() != 3){
		alert("It is reccomended you view this page in Google Chrome");
	}
}

</script>