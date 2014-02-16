<head>
	<?php include '../phplogins/phplogin.php' ?>
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
</head>

<body>

	<ul class="innerlist" id="list1">
		<?php 
	
		$q = "select * from ship_info";
		$result = mysqli_query($con, $q);
	
		$colorarr = array("lclblueh", "lcdblueh", "lcpurpleh", "lcorangeh", "lcobrownh", "lcbrownh", "lctanh");
	
		while($shiprow = mysqli_fetch_array($result)){
		
		$rand = mt_rand(0, 6);
		
		echo "<li id='".$shiprow["s_id"]."' class=".$colorarr[$rand].">
			<span /> 
			<span style='top:180' /> 
			<div class='listpart'> 
				<img src=shipman/shipimg/".$shiprow["s_img"].".jpg width='250' height='140' />
				
			</div> 
			<div class='smtext'>".$shiprow["s_name"]."</div>
		</li>";
	
		}
	
	?>

	
	
			
	</ul>

</body>

<script>
$(document).ready(function(){
addsmevents();

});
function addsmevents(){
	$("#list1 li").click(function(){ 
	var member = $(this);
	$("#innerinfo").load("shipman/moreshipinfo.php?shipid=" + member.attr('id'), 
															function(){	
																		$("#infopane").attr('class', member.attr('class').replace("h", ""));
																		$("#infopane").data('id', member.attr('id'));
																		toggleinfo();
																		}) 
									});
}

</script>