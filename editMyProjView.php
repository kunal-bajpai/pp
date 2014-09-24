<?php
	require_once("includes/init.php");
	$session = Session::get_instance();
	//Session::get_instance()->require_login();
	$project = Project::find_by_id($_GET['id']);
	$pictures = Picture::find_for_project($project);
	$donepics = DonePic::find_for_project($project);
	$customer = Customer::find_by_id($project->customer);
	if($project->status == Project::CANCELLED)
		die("Project has been cancelled");
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
	<script src="js/jquery-1.10.2.min.js"></script>
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
	 
	<?php include("editHeader.html");?>

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
		<h5 id='wel'>Project By: <span class='bluec'><?php echo $customer->email;?></span></h5>
		<h5 id='wel'><span class='bluec'><?php echo ($project->type == 0)?"Basic editing":"Advanced editing";?></span></h5>
		<h5 id='wel'>Project instructions : <span class='bluec'><?php echo ($project->instructions == '')?"None":$project->instructions;?></span></h5>
		<div id="projectLog"><?php echo $project->log->show_logs();?></div>
		<h5 id='head5' class='greenc'>To Edit:</h5>

		<div id='editPicsPreview'>
		   <?php
		   		if(is_array($pictures))
		   			foreach($pictures as $picture):
		   	?>
			<div id='imgBox' class='imgBox' data-selected='0' data-id="<?php echo $picture->id;?>">
				<img id='imgThumb' class='imgThumb' src='<?php echo "pictures/projects/project".$project->id."/original/thumbs/".$picture->name;?>' data-pic='<?php echo $picture->name;?>'>
				<div id='blackOverlay' class='blackOverlay greenc'>selected</div>
				<div id='tickSym' class='tickSym greenc'> &#10004;</div>
				<?php if($project->type == 1 && $picture->instructions!=''):?><div class='instrLabel'> INSTRUCTION GIVEN</div><?php endif;?>
				<div id='toSelect' class='toSelect greenc'>Select</div>
				<div id='toUnselect' class='toUnselect greenc'>Unselect</div>
			</div>
			<?php endforeach;?>
			 
			<div class='clearfix20'></div>
		</div>

		<div id='dwnldButton'>
			<button id='dwnldButton1' class='blueb round-corners'>Download Selected</button>
			<button id='dwnldButton2' class='greenb round-corners'>Download All</button>
		</div>

		<div class='clearfix20'></div>

		<h5 id='head5' class='bluec'>Done Editing :</h5>

		<div id='editPicsPreview2'>
			<div id='imgBox2dummy' style='display:none' class='imgBox2'>
				<img id='imgThumb2' class='imgThumb2' src='' data-pic=''>
				<div id='blackOverlay2' class='bluec'>chosen</div>
				<div id='tickSym2' class='tickSym bluec' onclick=""> &#10008;</div>
			</div>
			<?php
		   		if(is_array($donepics))
		   			foreach($donepics as $donepic):
		   	?>
			<div id='imgBox2' class='imgBox2'>
				<img id='imgThumb2' class='imgThumb2' src='<?php echo "pictures/projects/project".$project->id."/done/thumbs/".$donepic->name;?>' data-pic='<?php echo $donepic->name;?>'>
				<?php if($donepic->is_chosen()):?>
				<div id='blackOverlay2' class='bluec'>chosen</div>
				<?php elseif($donepic->editor == $session->logged_in_user()->id):?>
				<div id='tickSym2' class='bluec' onclick="deleteImage(<?php echo $donepic->id;?>);this.parentNode.parentNode.removeChild(this.parentNode);"> &#10008;</div>
				<?php endif;?>
			</div>
			<?php endforeach;?>
		</div>

		<div id='dwnldButton'>
			<form id="projectDetails" enctype="multipart/form-data" method="post">
				<input type="file" form="fileForm" name="fileToUpload[]" id="fileToUpload" accept="image/*" onchange="fileSelected();" multiple style="display:none"/>
				<input type="hidden" name="projid" id="formProjId"/>
			</form>
			<form id="fileForm"></form>
			<label for="fileToUpload"><div id='pushl' class='blueb round-corners' >Add more pictures</div></label> <button id="dropProject" class="greenb">Drop Project</button>
			<div id="uploaddiv" style="visibility:hidden">
				
				<button  class='label_upload2 modalButton blueb round-corners' id="uploadButton2" style="visibility:hidden" onclick="uploadFile()">Upload</button>
				<div class='post_upload' style="margin-top:10px;"></div>
			</div>
			<div class="progressNumber" style='visibility:hidden'>
				<div class='greenbar' style="width:75%;"></div><div class='bluebar' style='width:25%;'></div>
				<div class='uploadper'>25<span style='color:#3399CC'>%</span></div>

			</div>
		</div>

		<div class='clearfix20'></div>
	</div>
		<div style="display:none" id='photoModal1' class='photoModal'>
			<div  class='fullBlackOverlay'></div>
			<div id='prevPic11' class="modalImg" src="./images/dummy.jpg"></div>
			<?php if($project->type == 1):?><div class='instrLabel' onmouseover="this.parentNode.querySelector('.instrText').style.visibility='visible';" onmouseout="this.parentNode.querySelector('.instrText').style.visibility='hidden';"> INSTRUCTION GIVEN</div><div class='instrText'></div><?php endif;?>
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
<script src="js/editMyProjView.js"></script>
<script type="text/javascript">
	function setwidth(){
		var imgDiv=document.getElementById('prevPic21');
		var imgWidth=parseInt(imgDiv.style.width);
		var tempDiv=document.getElementById('photoModal2');
		tempDiv.style.width=((2*imgWidth) + 5) + "px";
		var tempDiv=document.getElementById('lefthalfpic');
		tempDiv.style.width=(imgWidth) + "px";
		var tempDiv=document.getElementById('righthalfpic');
		tempDiv.style.width=(imgWidth) + "px";
		var tempDiv=document.getElementById('prevPic21');
		tempDiv.style.width=(2 * imgWidth) + "px";
		var tempDiv=document.getElementById('prevPic22');
		tempDiv.style.width=(2 * imgWidth) + "px";

	}
</script>
</html>
