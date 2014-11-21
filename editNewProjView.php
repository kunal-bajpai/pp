<?php
	require_once("includes/init.php");
	//Session::get_instance()->require_login();
	$project = Project::find_by_id($_GET['id']);
	$pictures = Picture::find_for_project($project);
	$customer = Customer::find_by_id($project->customer);
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
	<script>projectId = <?php echo $_GET['id']?>;</script>
	</head>

<body>

	<div id="logobkg">
		<a href="editor.php">
			<img id="instr1" src="images/pp1.png" onmouseover="this.src='images/pp2.png'" onmouseout="this.src='images/pp1.png'"/>
		</a>
	</div>
	 
	<div id="nav" style='z-index:1;' >
		<div class='wrap4'>	 
		<div id="lefter">
		<nav id='navleft' class="menuhead" class='wrap4'>
		<ul>
			<li class="b1 "><a href="editMyProjList.php" style="text-decoration: none;">My Projects</a></li>
			<li class="b1 active"><a href="editNewProjList.php" style="text-decoration:none;">New Projects</a></li>
			<li class="b1 "><a href="#" style="text-decoration: none;">Profile</a></li>
			<li class="b1 "><a href="editTakeTest.php" style="text-decoration: none;">Re-take Test</a></li>
			<li class="b1 "><a href="editLogout.php" style="text-decoration: none;">Logout</a></li>
		</ul>
		</nav>
		</div>

		<div id="righter">
		   <ul id='navright' class="menu"></ul>
		</div>

		</div>
	</div>

 <div id='mininav' class='wrap3'>

		<div id="lefter">
		<ul id='navleft' class="submenu">
			<li>
				Editor &nbsp;Account&nbsp;
			</li>

		</ul>
		</div>

	</div>

	<div id='wrapper'>
		<h5 id='wel'><span class='bluec'><?php echo $project->name;?></span></h5>
		<h5 id='wel'>Project By: <span class='bluec'><?php echo $customer->email;?></span></h5>
		<h5 id='wel'><span class='bluec text-bold'><?php echo ($project->type == 0)?"Basic editing":"Advanced editing"?></span></h5>
		<h5 id='wel'>Project instructions : <span class='bluec'><?php echo ($project->instructions == '')?"None":$project->instructions;?></span></h5>
	
	
	   <h5 id='head5' class='greenc' style='margin-left:50px;'>To Edit:</h5>

		<div id='editPicsPreview' style='border:2px solid rgba(20, 20, 20, 0.25); width:80%;'>
			<?php
				if(!$project->is_free())
					die("Project taken");
				if(is_array($pictures))
					foreach($pictures as $picture):?>
			<div id='imgBox' class='imgBox'>
				<div id='imgThumb' class='imgThumb' data-pic='<?php echo $picture->name;?>' style='background-image:url(<?php echo "pictures/projects/project".$_GET['id']."/original/thumbs/".$picture->name;?>)'></div>
				<div id='blackOverlay' class='blackOverlay greenc'>selected</div>
				<div id='tickSym' class='tickSym greenc'> &#10004;</div>
				<?php if($project->type == 1 && $picture->instructions!=''):?><div class='instrLabel'> INSTRUCTION GIVEN</div><?php endif;?>
				<div id='toSelect' class='toSelect greenc'>Select</div>
			</div>
			<?php endforeach;?>
			 
			<div class='clearfix20'></div>
		</div>

		<div id='dwnldButton'>
			<button id='undertakeButton' class='blueb round-corners'>Undertake</button>
			<button id='dwnldButton2' class='greenb round-corners'><a href="editNewProjList.php" style="text-decoration:none;color:inherit;">Cancel</a></button>
		</div>

		<div class='clearfix20'></div>
	</div>
	
	<div id='photoModal1' style="display:none">
		<div id="fullOverlay" class='fullBlackOverlay'></div>
		<div id='prevpic' class='modalImg fixthisimg'></div>
		<?php if($project->type == 1):?><div class='instrLabel'></div><?php endif;?>
		<div id='closeButton1' class='closeButton bluec'> &times;</div>
		<div id='leftButton1' class='bluec'><</div>
		<div id='rightButton1' class='bluec'>></div>
	</div>

	<footer></footer>
</body>
<script src="js/carousel.js"></script>
<script src="js/editNewProjView.js"></script>
</html>
