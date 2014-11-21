<?php
	require_once("includes/init.php");
	Session::get_instance()->logout();
	$incProjId = false; //flag for incorrect projectID
	$incPass = false; //flag for incorrect pass
	if(isset($_GET['projId']))
   	{
   		$project = Project::find_by_id($_GET['projId']);
   		if(!isset($project))
			$incProjId = true;
		else
			if(isset($_GET['check']) && $_GET['check']!=$project->checkcode)
				die("Unauthorised access");
			else
				if(isset($_POST['password']))
					if(strcmp($project->password,$_POST['password'])==0)
					{
						$_SESSION['custSess'] = $project->checkcode;
						if(isset($_GET['fwd']))
							header("location:".urldecode($_GET['fwd']));
						else
							header("location:custProjView.php?id=".$project->id);
					}
					else
						$incPass = true;
   	}
?>
 <!DOCTYPE html>

 <html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Sign In</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico" type="image/pp-icon"/>
	<link href="css/style_editor_signin.css" rel="stylesheet">
	<link href="css/reset.css" rel="stylesheet">
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/progressbar.css">
	</head>

<script src="./js/jquery-1.11.0.min.js"></script>

<body>

  <div id="logobkg">
	<a href="index.php">
	<!--<p><span id="one">PHOTO</span><span id="two">PUDDLE</span></p>-->
	<img id="instr1" src="images/pp1.png" onmouseover="this.src='images/pp2.png'" onmouseout="this.src='images/pp1.png'"/>
	</a>
	</div>
	 
<!--<div id="nav" >
		<div class='wrap4'>	 
		<div id="lefter">
		<nav id='navleft' class="menu" class='wrap4'>
		<ul>
			<li class="b1  bubble-float-bottom"><a href="edit.php" style="text-decoration: none;">Home</a></li>
			<li class="b1  bubble-float-bottom"><a href="#" style="text-decoration: none;">Hire a Photographer</a></li>
			<li class="b1  bubble-float-bottom"><a href="#" style="text-decoration: none;">About Us</a></li>
			<li class="b1  bubble-float-bottom"><a href="#" style="text-decoration: none;">Contact Us</a></li>
			<li class="b1  active bubble-float-bottom"><a href="editor-signin.php" style="text-decoration: none;">Editor(?)</a></li>
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

	</div></ul>
	</div> -->
	<div id='wrapper-left'>
		<h5 id='wel2' class='greenc'>Sign In :</h5>
		<div id='login1'>
			<form id='signInForm' method="POST">
	   <?php
		echo ($incProjId)?"Incorrect project number<br/>":NULL;
		echo ($incPass)?"Incorrect password<br/>":NULL;
	   ?>
			<?php echo "Project name: <span class='text-bold nocaps'>".$project->name."</span><br/><br/>
			Email: <span class='text-bold nocaps'>".Customer::find_by_id($project->customer)->email."</span><br/><br/>";?>
				<input type="password" name='password' placeholder='Password'/>
				<br />
				<input type="submit" value="&#10137;"><br />
				<label><input type='checkbox'/> Remember Me</label>
			</form>
		</div>			 
	</div>

	<div id='footer'>
		<div id="nav" >
			<div class='wrap4'>  
			<div id="lefter">
				<nav id='navleft' class="menu" class='wrap4'>
				<ul class="block-menu">
					<!--<li class="b1 divider bubble-float-bottom"><a href="#" style="text-decoration: none;">Hire a Photographer</a></li> -->
					<li class="b1 divider"><a href="about.html" class='three-d' style="text-decoration: none;"><div class='underflipmenu'>About</div>
						<span aria-hidden="true" class="three-d-box">
							<span class="front">About</span>
							<span class="back">About</span>
						</span>
					</a></li>
					<li class="b1 divider"><a href="contact.html" class='three-d' style="text-decoration: none;"><div class='underflipmenu'>Contact</div>
						<span aria-hidden="true" class="three-d-box">
							<span class="front">Contact</span>
							<span class="back">Contact</span>
						</span>
					</a></li>
					<li class="b1 divider"><a href="faq.html" class='three-d' style="text-decoration: none;"><div class='underflipmenu'>FAQs</div>
						<span aria-hidden="true" class="three-d-box">
							<span class="front">FAQs</span>
							<span class="back">FAQs</span>
						</span>
					</a></li>
					<li class="b1 divider"><a href="privacypolicy.html" class='three-d' style="text-decoration: none;"><div class='underflipmenu'>Privacy Policy</div>
						<span aria-hidden="true" class="three-d-box">
							<span class="front">Privacy Policy</span>
							<span class="back">Privacy Policy</span>
						</span>
					</a></li>
					<li class="b1 divider"><a href="terms.html" class='three-d' style="text-decoration: none;"><div class='underflipmenu'>Terms and conditions</div>
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
</html>
