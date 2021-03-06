<?php
	require_once("../includes/init.php");
	$session = AdminSession::get_instance();
	$session->require_login();
	$userTaken = false; //flag for unavailable username
	$mismatchPass = false; //flag for mismatched password and repeat password
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repPass']))
   	{
   		if(Admin::find_by_username($_POST['username']) == null)
	   		if($_POST['password'] == $_POST['repPass'])
	   		{
		   		$admin = new Admin();
		   		$admin->username = $_POST['username'];
		   		$admin->password = hashText($_POST['password']);
		   		$admin->save();
		   	}
		   	else
		   		$mismatchPass = true;
		else
			$userTaken = true;
   	}
   	if(is_array($_POST['admin']))
   		foreach($_POST['admin'] as $admin)
   			$admin->delete();
   	$admins = Admin::find_all();
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
	<link rel="icon" href="../images/favicon.ico" type="image/pp-icon"/>
	<link href="../css/style_editor_signin.css" rel="stylesheet">
	<link href="../css/reset.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/modal.css">
	<link rel="stylesheet" href="../css/progressbar.css">
	</head>

<script src="../js/jquery-1.11.0.min.js"></script>

<body>

  <div id="logobkg">
	<a href="../index.php">
	<!--<p><span id="one">PHOTO</span><span id="two">PUDDLE</span></p>-->
	<img id="instr1" src="../images/pp1.png" onmouseover="this.src='../images/pp2.png'" onmouseout="this.src='../images/pp1.png'"/>
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
		<h5 id='wel2' class='greenc'>Manage admins :</h5>
		<div id='login1'>
   <?php
		echo ($userTaken)?"Username unavailable":NULL;
		echo ($mismatchPass)?"Passwords mismatch":NULL;
   ?>
   			<form id='signInForm' method="POST">
   			Existing admins:<br/>
		    	<?php
		    		if(is_array($admins))
		    			foreach($admins as $admin)
		    				if(/*$admin->id != $session->logged_in_user()->id*/1):?>
		    	<input type="checkbox" name="admin[]" value="<?php echo $admin->id;?>" id="admin<?php echo $admin->id;?>"/><label for="admin<?php echo $admin->id;?>"><?php echo $admin->username;?></label><br/>
		    	<?php endif;?>
		    Add new admin:
			    <input type="text" name='username' placeholder='Username'/><br/>
		        <input type="password" name='password' placeholder='Password'/><br/>
		        <input type="password" name='repPass' placeholder='Repeat Password'/>
		        <br />
		        <input type="submit" value="&#10137;"><br />
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
