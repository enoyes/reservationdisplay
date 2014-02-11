<head>
<?php 
include '../phplogins/phplogin.php';
session_start();

$shipid = $_GET["shipid"];




?>
</head>
<body>

						
						

<?php

$q = "select * from ship_info where S_Id = $shipid";
$result = mysqli_query($con, $q);
$result = mysqli_fetch_array($result);

echo 	"<img src='shipman/shipimg/".$result["Ship_Img"].".jpg' width='500' height='280'> </img>
		 <h1 class='text1'>".$result["Ship_Name"]."</h1>
		 <h2 id='desctext' class='text3'>".$result["Ship_Desc"]."</h2>";
?>						

</body>