<?php
	require_once("includes/init.php");
	$session = Session::get_instance();
	//$session->require_login();
?><!DOCTYPE html>

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

<body>


	<div id="logobkg">
		<a href="editor.php">
			<img id="instr1" src="images/pp1.png" onmouseover="this.src='images/pp2.png'" onmouseout="this.src='images/pp1.png'"/>
		</a>
	</div>
	 
	<?php include("editHeader.html");?>

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
		<h5 id='wel'>Welcome <span class='greenc'><?php echo $session->logged_in_user()->firstname;?>!</span></h5>
		<div class='pagers' id='pagerHeader'>
			<input type='radio' class='typeRadio' name='type1' id='basicRadio1' value='0' checked/><label for='basicRadio1'>Basic</label>
			<input type='radio' class='typeRadio' name='type1' id='advRadio1' value='1'/><label for='advRadio1'>Advanced</label><br/>
			<button onclick="prev()" class='pagbuttons'>< Prev</button> <p class='startPage'></p> Page <input type='text' class='currentPage'> of <p class='endPage'></p> <button onclick="next()" class='pagbuttons'>Next ></button>
			<br>Results per page : <select class="resultPerPage"><option selected>3</option><option>5</option><option>10</option><option>20</option></select><br/>
			<p class="refreshing"></p>
		</div>

		<div id='editorTable'>
			<div id='rowHeader' class='bluec'>
				<div>Project By</div>
				<div>Uploaded on</div>
				<div>Submission Date</div>
				<div>Details</div>
			</div>

			<div class='tableHR'></div>
			<div id="dummyDiv" style='display:none'>
				<div class='rowElement'>
					<div class='col1'><div class='name'>Avinash Singh</div><a class='greenb round-corners customButton1' href="editNewProjView.php" style="text-decoration:none;color:inherit;">Click To View</a></div>
					<div class='col2'>29-05-2013</div>
					<div class='col3'>06-06-2014</div>
					<div class='col4m'><span class='greenc'>35</span> photos</div>
				</div>
				<div class='tableHR'></div>
			</div>
		</div>

		<div class='pagers' id='pagerFooter'>
			<input type='radio' class='typeRadio' name='type2' id='basicRadio2' value='0' checked/><label for='basicRadio2'>Basic</label>
			<input type='radio' class='typeRadio' name='type2' id='advRadio2' value='1'/><label for='advRadio2'>Advanced</label><br/>
			<button onclick="prev()" class='pagbuttons'>< Prev</button> <p class='startPage'></p> Page <input type='text' class='currentPage'> of <p class='endPage'></p> <button class='pagbuttons' onclick="next()">Next ></button>
			<br>Results per page : <select class="resultPerPage"><option selected>3</option><option>5</option><option>10</option><option>20</option></select><br/>
			<p class="refreshing"></p>
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
<script src='js/editNewProjList.js'></script>
</html>
