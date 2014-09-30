<?php
	require_once("includes/init.php");
	$session = Session::get_instance();
	$session->require_login();
	$ongoing = Project::find_ongoing_for_editor($session->logged_in_user());
	$dropped = Project::find_for_status($session->logged_in_user(),Editor::DROPPED);
	$failed = Project::find_for_status($session->logged_in_user(),Editor::FAILED);
	$completed = Project::find_for_status($session->logged_in_user(),Editor::COMPLETED);
	$removed = Project::find_for_status($session->logged_in_user(),Editor::REMOVED);
	$cancelled = Project::find_for_status($session->logged_in_user(),Editor::CANCELLED);
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
	<link rel="stylesheet" href="css/progressbar.css">

	</head>

<body>
	<div id="logobkg">
		<a href="editHome.php">
			<img id="instr1" src="images/pp1.png" onmouseover="this.src='images/pp2.png'" onmouseout="this.src='images/pp1.png'"/>
		</a>
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
	
	<?php include("editHeader.html");?>	

	<div id='wrapper'>
		<h5 id='wel'>Welcome <span class='greenc'><?php echo $session->logged_in_user()->firstname.'!';?></span></h5>
	<div class='pagers'>
		<input type='radio' name='projCategory' id='ongoing' class='projCategory' checked><label for='ongoing'>Ongoing</label>
		<input type='radio' name='projCategory' id='dropped' class='projCategory'><label for='dropped'>Dropped</label>
		<input type='radio' name='projCategory' id='failed' class='projCategory'><label for='failed'>Failed</label>
		<input type='radio' name='projCategory' id='completed' class='projCategory'><label for='completed'>Completed</label>
		<input type='radio' name='projCategory' id='removed' class='projCategory'><label for='removed'>Removed</label>
		<input type='radio' name='projCategory' id='cancelled' class='projCategory'><label for='cancelled'>Cancelled</label>
	</div>
		<div id='ongoingProj'>
			<div id='rowHeader' class='bluec'>
				<div>Project</div>
				<div>Taken on</div>
				<div>Submission Date</div>
				<div>Details</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($ongoing))
				foreach($ongoing as $ongoingProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $ongoingProj->name;?><br/><a href="editMyProjView.php?id=<?php echo $ongoingProj->id;?>" style="text-decoration:none;color:inherit;" class='greenb customButton1'>Click To View</a></div>
				<div class='col2'><?php echo strftime('%d-%m-%Y %H:%M',$ongoingProj->submittime);?></div>
				<div class='col3'><?php echo strftime('%d-%m-%Y %H:%M',$ongoingProj->submittime+(3600*24));?></div>
				<div class='col4'><span class='bluec'><?php echo $ongoingProj->done_pics_count();?></span> of <span class='greenc'><?php echo $ongoingProj->total_pics_count();?></span><br/>photos <br/>edited</div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

		</div>
	
	
	<div id='droppedProj' style='display:none'>
			<div id='rowHeader' class='bluec'>
				<div>Project</div>
				<div>Taken up</div>
				<div>Dropped</div>
				<div>Details</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($dropped))
				foreach($dropped as $droppedProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $droppedProj->name.' ('.$droppedProj->email.')';?><br/></div>
				<div class='col2'><?php echo strftime('%d-%m-%Y %H:%M',$droppedProj->start);?></div>
				<div class='col3'><?php echo strftime('%d-%m-%Y %H:%M',$droppedProj->end);?></div>
				<div class='col4'><span class='bluec'><?php echo $droppedProj->chosen_pics_by_count($session->logged_in_user());?></span> of <span class='greenc'><?php echo $droppedProj->done_pics_by_count($session->logged_in_user());?></span><br/>edited photos <br/>chosen<br/><?php echo $droppedProj->total_pics_count();?> total</div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

		</div>
	
	
	<div id='failedProj' style='display:none'>
			<div id='rowHeader' class='bluec'>
				<div>Project</div>
				<div>Taken up</div>
				<div>Failed</div>
				<div>Details</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($failed))
				foreach($failed as $failedProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $failedProj->name.' ('.$failedProj->email.')';?><br/></div>
				<div class='col2'><?php echo strftime('%d-%m-%Y %H:%M',$failedProj->start);?></div>
				<div class='col3'><?php echo strftime('%d-%m-%Y %H:%M',$failedProj->end);?></div>
				<div class='col4'><span class='bluec'><?php echo $failedProj->total_pics_count();?></span><br/> photos <br/></div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

		</div>
	
	
	<div id='completedProj' style='display:none'>
			<div id='rowHeader' class='bluec'>
				<div>Project</div>
				<div>Taken up</div>
				<div>Completed</div>
				<div>Details</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($completed))
				foreach($completed as $completedProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $completedProj->name.' ('.$completedProj->email.')';?><br/></div>
				<div class='col2'><?php echo strftime('%d-%m-%Y %H:%M',$completedProj->start);?></div>
				<div class='col3'><?php echo strftime('%d-%m-%Y %H:%M',$completedProj->end);?></div>
				<div class='col4'><span class='bluec'><?php echo $completedProj->chosen_pics_by_count($session->logged_in_user());?></span> of <span class='greenc'><?php echo $completedProj->done_pics_by_count($session->logged_in_user());?></span><br/>edited photos <br/>chosen<br/><?php echo $completedProj->total_pics_count();?> total</div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

		</div>
	
	
	<div id='removedProj' style='display:none'>
			<div id='rowHeader' class='bluec'>
				<div>Project</div>
				<div>Taken up</div>
				<div>Removed</div>
				<div>Details</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($removed))
				foreach($removed as $removedProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $removedProj->name.' ('.$removedProj->email.')';?><br/></div>
				<div class='col2'><?php echo strftime('%d-%m-%Y %H:%M',$removedProj->start);?></div>
				<div class='col3'><?php echo strftime('%d-%m-%Y %H:%M',$removedProj->end);?></div>
				<div class='col4'><span class='bluec'><?php echo $removedProj->chosen_pics_by_count($session->logged_in_user());?></span> of <span class='greenc'><?php echo $removedProj->done_pics_by_count($session->logged_in_user());?></span><br/>edited photos <br/>chosen<br/><?php echo $removedProj->total_pics_count();?> total</div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

		</div>
		
		<div id='cancelledProj' style='display:none'>
			<div id='rowHeader' class='bluec'>
				<div>Project</div>
				<div>Taken up</div>
				<div>Cancelled</div>
				<div>Details</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($cancelled))
				foreach($cancelled as $cancelledProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $cancelledProj->name.' ('.$cancelledProj->email.')';?><br/></div>
				<div class='col2'><?php echo strftime('%d-%m-%Y %H:%M',$cancelledProj->start);?></div>
				<div class='col3'><?php echo strftime('%d-%m-%Y %H:%M',$cancelledProj->end);?></div>
				<div class='col4'><span class='bluec'><?php echo $cancelledProj->chosen_pics_by_count($session->logged_in_user());?></span> of <span class='greenc'><?php echo $cancelledProj->done_pics_by_count($session->logged_in_user());?></span><br/>edited photos <br/>chosen<br/><?php echo $cancelledProj->total_pics_count();?> total</div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

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
<script>
	radios = document.getElementsByClassName('projCategory');
	for(var i=0;i<radios.length;i++)
		radios[i].onchange = function() {
			radios = document.getElementsByClassName('projCategory');
			for(var i=0;i<radios.length;i++)
				if(radios[i].checked)
					document.getElementById(radios[i].id+'Proj').style.display='block';
				else
					document.getElementById(radios[i].id+'Proj').style.display='none';
		}
</script>
</html>
