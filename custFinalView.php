<?php
	require_once("includes/init.php");
	$project = Project::find_by_id($_GET['id']);
	cust_require_login($project);
	$donepics = DonePic::find_chosen_for_project($project);
	if($project->status != Project::COMPLETED)
		header("location:custProjView.php?id=".$project->id);
?>
 <!DOCTYPE html>

 <html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>EDITOR'S PAGE</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico" type="image/pp-icon"/>
	<link href="css/style_editor.css" rel="stylesheet">
	<link href="css/reset.css" rel="stylesheet">
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/menu.css">
	<link rel="stylesheet" href="css/progressbar.css">

	</head>

<script>
	var projectId = <?php echo $_GET['id'];?>;
</script>

<body>

	<div id="logobkg">
	<a href="editor.php">
	<img id="instr1" src="images/pp5.png" onmouseover="this.src='images/pp6.png'" onmouseout="this.src='images/pp5.png'"/>
	</a>
	</div>
	 
	<?php include("custHeader.html");?>

 <div id='mininav' class='wrap3'>

		<div id="lefter">
		<ul id='navleft' class="submenu">
			<li>
				Undertaken Project Details
			</li>
		</ul>
		</div>
	</div>

	<div id='wrapper'>
		<h5 id='wel'><span class='bluec'><?php echo $project->name;?></span></h5>
		<h5 id='wel'><span class='bluec'><?php echo ($project->mode == 0)?"Basic editing":"Advanced editing"?></span></h5>
		<h5>Project instructions : <span class='bluec'><?php echo ($project->instructions == '')?"None":$project->instructions;?></span></h5>
		<div id="projectLog"><?php echo $project->log->show_logs();?></div>

		<div class='clearfix20'></div>

		<h5 id='head5' class='bluec'>Done Editing :</h5>

		<div id='editPicsPreview2'>
			<?php
		   		if(is_array($donepics))
		   			foreach($donepics as $donepic):
		   	?>
			<div id='imgBox' class='imgBox' data-selected='<?php echo $donepic->chosen;?>' data-id='<?php echo $donepic->id;?>'>
				<img id='imgThumb2' class='imgThumb2' src='<?php echo "pictures/projects/project".$project->id."/done/".$donepic->name;?>' data-pic='<?php echo $donepic->name;?>'>>
				<div id='blackOverlay' style='display:none' class='blackOverlay greenc'>selected</div>
				<div id='tickSym' style="display:none" class='tickSym greenc'> &#10004;</div>
				<div id='toSelect' style="display:block" class='toSelect greenc'>Select</div>
				<div id='toUnselect' style="display:none" class='toUnselect greenc'>Unselect</div>
			</div>
			<?php endforeach;?>
		</div>
		<div class='clearfix20'></div>
		<div id='dwnldButton'>
			<button id='dwnldButton1' class='blueb round-corners'>Download Selected</button>
			<button id='dwnldButton2' class='greenb round-corners'>Download All</button>
		</div>
		
		<div id='photoModal1' class='photoModal' style="display:none">
			<div class='fullBlackOverlay'></div>

			<div id='prevPic11' class="modalImg"></div>
			<?php if($project->mode == 1):?><div class='instrLabel' onmouseover="this.parentNode.querySelector('.instrText').style.visibility='visible';" onmouseout="this.parentNode.querySelector('.instrText').style.visibility='hidden';"> INSTRUCTION GIVEN</div><div class='instrText'></div><?php endif;?>
			<div id='closeButton1' class='closeButton bluec'> &times;</div>
			<div id='leftButton1' class='modalButton bluec'><</div>
			<div id='rightButton1' class='modalButton bluec'>></div>

		</div>
		<div id="photoModal" style="display:none">
                <div class='fullwhiteoverlay'></div>
                <div id='closeButton3' class='closeButton'></div>
                <div id='leftButton3' class='modalButton '></div>
                <div id='rightButton3' class='modalButton'></div>

                <div id='photoModal2' class='photoModal'>
                  <div id='lefthalfpic'><div id='prevPic21' class="modalImg" ></div></div>
                  <div id='righthalfpic'><div id='prevPic22' class="modalImg2" ></div></div>
                </div>
        </div>
		
	<footer></footer>
</body>
<script src="js/carousel.js"></script>
<script src="js/dualCarousel.js"></script>
<script src="js/custFinalView.js"></script>

</html>
