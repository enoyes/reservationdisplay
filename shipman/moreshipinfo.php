<head>
<?php 
include '../phplogins/phplogin.php';
session_start();

$shipid = $_GET["shipid"];




?>
</head>
<body>

						
						

<?php

$q = "select * from ship_info where s_id = $shipid";
$result = mysqli_query($con, $q);
$result = mysqli_fetch_array($result);

echo 	"<img src='shipman/shipimg/".$result["s_img"].".jpg' width='500' height='280'> </img>
		 <h1 class='text1'>".$result["s_name"]."</h1>
		 <h2 class='text2' style='font-size:50'>".$result["s_class"]." Class</h2>
		 <h2 class='text2'>Price: ".$result["s_price"]." Credits/Day</h2>
		 <h2 class='text2'>Reputation: ".$result["s_rep"]." Credits</h2>
		 <h2 id='desctext' class='text3'>".$result["s_desc"]."</h2>";
?>						

</body>