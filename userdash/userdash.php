<head>
<?php include "../phplogins/phplogin.php"; ?>
<?php session_start(); ?>
</head>
<?php
$q = "select credits, reputation from memberinfo where u_id = ".$_SESSION['uid'];
$result = mysqli_query($con, $q);
$result = mysqli_fetch_array($result);


?>


<body>
	<div style="height:80;">
		<div class="text1" style="margin:0 0 0 10;display:block;float:left">Welcome: <?php echo $_SESSION['name']; ?></div>
		<div class="text1" style="margin:0 30% 0 0;display:block;float:right;">User ID: <?php echo $_SESSION['uid']; ?></div>
	</div>
	<div style="height:80;">
		<div class="text1" style="margin:0 0 0 10;display:block;float:left">Available Credits: <?php echo $result["credits"]; ?></div>
		<div class="text1" style="margin:0 30% 0 0;display:block;float:right;">Reputation: <?php echo $result["reputation"]; ?></div>
	</div>
</body>