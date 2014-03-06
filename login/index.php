<head>
	<link rel="stylesheet" href="reslogin.css" media="screen"/>
	<link rel="shortcut icon" href="http://ernoyes.com/images/engineering.png" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
</head>

<body>
	<div id="overlay"> </div>
	<div id="topbar" class="lcdblue">
		<div style="background:#000;margin-left:50px;width:10px;height:40px;position:absolute;"> </div>
		<div id="toptext" class="text1" style="background:#000;">RESERVATION SYSTEM - LOGIN</div>
	</div>
	<div id="infopane" class="lcorange">
		
		<div id="innerinfo">
			<h1 class='text1' style="margin: 5 0 5 0;">Create User</h1>
			<div class='text2'>Username:<input class="newuserfields" maxlength="16" type="text" id="newun" /></div>
			<div class='text2'>Password:<input class="newuserfields" maxlength="16" type="password" id="newpass" /></div>
			<div class='text2'>Confirm Password:<input class="newuserfields" maxlength="16" type="password" id="cnewpass" /></div>
			<div class='text2'>First Name:<input class="newuserfields" maxlength="16" type="text" id="newfn" /></div>
			<div class='text2'>Last Name:<input class="newuserfields" maxlength="16" type="text" id="newln" /></div>
			<div class='text2'>Email (Optional):<input class="newuserfields" type="text" id="newemail" /></div>
			<div id="createuser" class='loginbuttons'><div class="text2">Add User</div></div>		
		</div> 
		<ul id="infonav">
			<li id="infoexit" class="lctanh" style="border-bottom:5px solid #000;margin:180 0 0 0"> <div>Close</div> </li>
		</ul>
		
	</div>
	<div id="mainarea">
		
		<div id="fedlogo"> <img src="http://ernoyes.com/reservation/images/unfp_logo.jpg" height="385.5" width="459" ></img> </div>
		<input class="userpass" maxlength="16" type="text" id="username" />
		<input class="userpass" maxlength="16" type="password" id="password" />
		<div style="text-align: center;text-align: -webkit-center;">
			<div id="login" class="loginbuttons">Login </div>
			<div class="loginbuttons" id="newuser">Sign Up</div>
		</div>
	</div>
	<div id="topbar" style="margin-top:0px;" class="lcdblue">
		<div id="bottext" class="text1">LCARS - ONLINE</div>
		<div style="background:#000;margin-right:50px;width:10px;height:40px;float:right;"> </div>
	</div>


</body>
<script>
var infopane = 0;
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
	
	$("#newuser").click(toggleinfo);
	
	$("#infoexit").click(toggleinfo);
	
	$("#createuser").click(adduser);
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
		
	$.ajax({
		type: "POST",
		url: "login.php",
		data: {user: $("#username").val(), pass: $("#password").val()}
	})
	.done(function(msg){
		if (msg == 1){
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

function adduser(){
	var newun = $("#newun").val();
	var newpass = $("#newpass").val();
	var cnewpass = $("#cnewpass").val();
	var newfn = $("#newfn").val();
	var newln = $("#newln").val();
	var newemail = $("#newemail").val();
	if (newun == ""){
		alert("Require Username Field");
		return -1;
	}
	if (newpass == ""){
		alert("Require Password Field");
		return -2;
	}
	if (cnewpass == ""){
		alert("Please Confirm Password Field");
		return -3;
	}
	if (cnewpass !== newpass){
		alert("Make Sure Passwords Match");
		return -4;
	}
	if (newfn == ''){
		alert("Require First Name Field");
		return -5;
	}
	if (newln == ''){
		alert("Require Last Name Field");
		return -6;
	}	
	
	$.ajax({
	type: "POST",
	url: "newuser.php",
	data: {newuser: newun, newpass: newpass, newfn: newfn, newln: newln, newemail: newemail}
	}).done(function(msg){
		alert(msg);
		location.reload();
	});
	
}

</script>