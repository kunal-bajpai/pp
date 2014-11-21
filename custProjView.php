<?php
	require_once("includes/init.php");
	$project = Project::find_by_id($_GET['id']);
	cust_require_login($project);
	$pictures = Picture::find_for_project($project);
	$donepics = DonePic::find_for_project($project);
	$customer = Customer::find_by_id($project->customer);
	if($project->status == Project::CANCELLED)
		die("Project cancelled. Email us for further help");
	if($project->status == Project::COMPLETED)
		header("location:custFinalView.php?id=".$project->id);
?>
 <!DOCTYPE html>

 <html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>CUSTOMER'S PAGE</title>
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
	var selectCount = <?php if(is_array($donepics))
			$tot = 0;
			foreach($donepics as $dp)
				if($dp->chosen==1)
					$tot++;
			echo $tot;?>;
</script>

<body>

	<div id="logobkg">
		<a href="editor.php">
			<img id="instr1" src="images/pp1.png" onmouseover="this.src='images/pp2.png'" onmouseout="this.src='images/pp1.png'"/>
		</a>
	</div>
	 
	<a class='logoutbutton' href="custLogout.php" style="text-decoration: none;">Logout</a>

 <div id='mininav' class='wrap3'>

		<div id="lefter">
		<ul id='navleft' class="submenu">
			<li>
				Undertaken Project Details - <?php echo $project->name;?>
			</li>
		</ul>
		</div>
	</div>

	<div id='wrapper' style='margin-top:80px;'>
		<h5 id='wel'><span class='bluec '><?php echo ($project->type == 0)?"Basic editing":"Advanced editing"?></span></h5>
		<h5 class='pushleft' style='display:inline;'>Who is working on this? <span id="currentEditor" class="bluec text-bold"><?php $ed = Editor::find_for($project);echo ($ed==NULL)?"No one":$ed->firstname." ".$ed->lastname;?></span></h5>
		<?php if($ed != NULL):?>
<div>Unhappy with the photos? Too slow to edit?</div>
<button class='toggleeditor' style='margin-left:10px' id="removeEditor">Remove editor</button><div class='ibox'>Bans editor from taking up this project and opens it up for other editors. Photos edited by this editor will still be available for you to pick.</div>
		<?php endif;?>
		<div class='clearfix20'></div>
		<h5 class='pushleft'>Project instructions : <span class='bluec'><?php echo ($project->instructions == '')?"None":$project->instructions;?></span></h5>
		<div class='togglelog pushleft'>Project history</div>
		<div id="projectLog" class='pushleft'><?php echo $project->log->show_logs();?></div>
		
	<div class='twobutton'>
		<?php if(is_array($donepics) && count($donepics)>0):?>
		<div><b>Like the photos so far and want more?</b> Please "select" the photos you like to let the editor know. Your preferences will be saved. You may login later to check for new photos.<br/><b>Got what you wanted?</b> Just "select" the photos you want to pay for and proceed to payment.</div>
		<?php else:?>
		<div>Please wait for some photos to be uploaded. We will let you know by email as soon as they are.</div>
		<?php endif;?>
		<button onclick="if(selectCount==0) alert('Please select the pictures you want to pay for.'); else window.location.href='custSummary.php?id=<?php echo $project->id;?>'" class='greenb buttonset1'>Proceed to payment</button>
		<button id="cancelProject" class='redb buttonset1'>Cancel Project</button>
	</div>
	
		<div class='halfpagesec'>
			<h5 id='head5' class='greenc'>Original</h5>

			<div id='editPicsPreview'>
			   <?php
			   		if(is_array($pictures))
			   			foreach($pictures as $picture):
			   	?>
				<div id='imgBox' class='imgBox' data-selected='0' data-id="<?php echo $picture->id;?>">
					<div id='imgThumb' class='imgThumb' style='background-image:url(<?php echo "pictures/projects/project".$project->id."/original/thumbs/".$picture->name;?>)' data-pic='<?php echo $picture->name;?>'></div>
					<?php if($project->type == 1 && $picture->instructions!=''):?><div class='instrLabel'>INSTRUCTION GIVEN</div><?php endif;?>
				</div>
				<?php endforeach;?>
				 
				<div class='clearfix20'></div>
			</div>

		</div>

		<div class='halfpagesec'>
			<h5 id='head5' class='bluec'>Done Editing :</h5>

			<div id='editPicsPreview2'>
				<?php
			   		if(is_array($donepics))
			   			foreach($donepics as $donepic):
			   	?>
				<div id='imgBox2' class='imgBox2' data-selected='<?php echo $donepic->chosen;?>' data-id='<?php echo $donepic->id;?>'>
					<div id='imgThumb2' class='imgThumb2' style='background-image:url(<?php echo "pictures/projects/project".$project->id."/wm/thumbs/".$donepic->wmName();?>)' data-pic='<?php echo $donepic->wmName();?>'></div>
					<div id='blackOverlay' <?php if($donepic->chosen==1) {echo 'style="display:block; height:100%; position:absolute; top:0; left:0; width:100%"';}?> class='blackOverlay greenc'>selected</div>
					<div id='tickSym' <?php if($donepic->chosen==1) {echo 'style="display:inline"';}?> class='tickSym greenc'> &#10004;</div>
					<div id='toSelect' <?php if($donepic->chosen==0) {echo 'style="display:block"';}?> class='toSelect greenc'>Select</div>
					<div id='toUnselect' <?php if($donepic->chosen==1) {echo 'style="display:block"';}?> class='toUnselect greenc'>Unselect</div>
				</div>
				<?php endforeach;?>
			</div>
		</div>

		<div class='clearfix20'></div>


		
		<div id='photoModal1' class='photoModal' style="display:none">
			<div class='fullBlackOverlay'></div>

			<div id='prevPic11' class="modalImg fixthisimg"></div>
			<?php if($project->type == 1):?><div class='instrLabel' ></div><?php endif;?>
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
	</div>
				<div id='footer'>
					<div id="nav" >
						<div class='wrap4'>	 
						<div id="lefter">
							<nav id='navleft' class="menu" class='wrap4'>
							<ul class="block-menu">
								<!--<li class="b1 divider bubble-float-bottom"><a href="#" style="text-decoration: none;">Hire a Photographer</a></li> -->
								<li class="b1 divider"><a href="about.html" class='three-d' style="text-decoration: none;"><div class='fullheight underflipmenu'>About</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">About</span>
										<span class="back">About</span>
									</span>
								</a></li>
								<li class="b1 divider"><a href="contact.html" class='three-d' style="text-decoration: none;"><div class=' fullheight underflipmenu'>Contact</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Contact</span>
										<span class="back">Contact</span>
									</span>
								</a></li>
								<li class="b1 divider"><a href="faq.html" class='three-d' style="text-decoration: none;"><div class='fullheight underflipmenu'>FAQs</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">FAQs</span>
										<span class="back">FAQs</span>
									</span>
								</a></li>
								<li class="b1 divider"><a href="privacypolicy.html" class='three-d' style="text-decoration: none;"><div class='fullheight underflipmenu'>Privacy Policy</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Privacy Policy</span>
										<span class="back">Privacy Policy</span>
									</span>
								</a></li>
								<li class="b1 divider"><a href="terms.html" class='three-d' style="text-decoration: none;"><div class='fullheight underflipmenu'>Terms and conditions</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Terms and conditions</span>
										<span class="back">Terms and conditions</span>
									</span>
								</a></li>
							  <!-- <li class="b1 divider"><a href="editsignin.php" style="text-decoration: none;">Editor(?)</a></li>-->
							</ul>
							</nav>
						</div>
			
						</div>
					</div>
					<a href='www.photopuddle.com/index.php' class='footerlogo'/></a>
		 			 <p id="copyright">&copy; PhotoPuddle 2014<p>
				</div>
</body>
<script src="js/carousel.js"></script>
<script src="js/dualCarousel.js"></script>
<script src="js/custProjView.js"></script>
<script src="js/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
		$(function()
			{
				$('.togglelog').click(function(){
				  $('#projectLog').slideToggle();
				});
			});
</script>

</html>
