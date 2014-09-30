<?php
	require_once("includes/init.php");
	$session = Session::get_instance();
	$session->require_login();
	$editor = $session->logged_in_user();
	$projects = Project::find_by_sql("SELECT * FROM (SELECT projects.id, projects.name, projects.type, COUNT(donepics.id)  count FROM projects JOIN pictures ON pictures.project = projects.id JOIN donepics ON donepics.original = pictures.id WHERE donepics.editor = ".$session->logged_in_user()->id." AND donepics.editor NOT IN (SELECT editor FROM edit_payout WHERE project = projects.id) AND donepics.chosen = 1) s ORDER BY count;");
	$bankDetError = false;
	if(isset($_POST['resetAc']) || isset($_POST['bankname']) || isset($_POST['ifsc']) || isset($_POST['acname']) || isset($_POST['acno']))
	{
		if(!isset($_POST['resetAc']))
			if(preg_match("/[a-zA-Z\s]+/",trim($_POST['bankname'])) && preg_match("/[a-zA-Z]{4}\d{7}/",$_POST['ifsc']) && preg_match("/[a-zA-Z\s]+/",trim($_POST['acname'])) && preg_match("/\d{5,16}/",$_POST['acno']))
			{
				$editor->bankname = $_POST['bankname'];
				$editor->ifsc = $_POST['ifsc'];
				$editor->acname = $_POST['acname'];
				$editor->acno = $_POST['acno'];
				$editor->save();
			}
			else
				$bankDetError = true;
		else
		{
			$editor->bankname = '';
			$editor->ifsc = '';
			$editor->acname = '';
			$editor->acno = '';
			$editor->save();
		}	
	}
	$invalidVals = false;
	$passMismatch = false;
	$invalidPass = false;
	$incorrectPass = false;
	$changeSuccess = false;
	if(isset($_POST['firstname']) && isset($_POST['email']))
	{
		if(verify_firstname($_POST['firstname']) && (!isset($_POST['lastname']) || verify_lastname($_POST['lastname'])) && verify_email($_POST['email']))
		{
			$editor->firstname = $_POST['firstname'];
			$editor->lastname = $_POST['lastname'];
			$editor->email = $_POST['email'];
			if(isset($_POST['currPass']) && isset($_POST['newPass']) && isset($_POST['repPass']))
				if($editor->password == hashText($_POST['currPass']))
					if(verify_password($_POST['newPass']))
						if($_POST['newPass'] == $_POST['repPass'])
						{
							$editor->password = hashText($_POST['newPass']);
							$changeSuccess = true;
						}
						else
							$passMismatch = true;
					else
						$invalidPass = true;
				else
					$incorrectPass = true;
			$editor->save();
		}
		else
			$invalidVals = true;
	}
?>
 <!DOCTYPE html>

 <html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico" type="image/pp-icon"/>
	<link href="css/style_editor_signin.css" rel="stylesheet">
	<link href="css/reset.css" rel="stylesheet">
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/progressbar.css">
	</head>

<script src="js/jquery-1.11.0.min.js"></script>

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
		<h5 id='wel2' class='greenc'>Pending payouts</h5>
		<div>
			<div>ID</div>
			<div>Name</div>
			<div>Type</div>
			<div>Amount</div>
		</div>
		<div>
			<?php
				$total = 0;
				if(is_array($projects))
					foreach($projects as $project):?>
						<div><?php echo $project->id;?></div>
						<div><?php echo $project->name;?></div>
						<div><?php echo ($project->type == 0)?"Basic":"Advanced";?></div>
						<div><?php 
								if($project->type == 0)
								{
									echo "Rs.".EDITOR_BASIC_PRICE * $project->count."/-";
									$total += EDITOR_BASIC_PRICE * $project->count;
								}
								else
								{
									echo "Rs.".EDITOR_ADVANCED_PRICE * $project->count."/-";
									$total += EDITOR_ADVANCED_PRICE;
}
							?></div><br/>
			<?php endforeach;?>
		</div>             
		<div>Total Due = Rs. <?php echo $total;?> /-</div>
	</div>
	<div>
		<div><?php echo ($bankDetError)?"Invalid values":"";?></div>
		<div>
			Bank Name : <?php echo $editor->bankname;?><br/>
			IFS Code : <?php echo $editor->ifsc;?><br/>
			Name of Account Holder : <?php echo $editor->acname;?><br/>
			Account number : <?php echo str_repeat("*",(strlen($editor->acno)-4>0)?strlen($editor->acno)-4:0).substr($editor->acno,-4);?><br/>
			<button>Edit</button>
		</div>
		<form method = "POST" required>
			Bank Name <input type="text" value="<?php echo $editor->bankname;?>" name="bankname"/><br/>
			IFS Code <input type="text" value="<?php echo $editor->ifsc;?>" name="ifsc"/><br/>
			Name of Account Holder <input type="text" value="<?php echo $editor->acname;?>" name="acname"/><br/>
			Account number <input type="text" value="<?php echo $editor->acno;?>" name="acno"/><br/>
			<input type="submit" value="Save"/>
		</form>
		<form onsubmit="return confirm('All account details will be removed.');" method="POST">
			<input type="hidden" name="resetAc" value=1>
			<input type="submit" value="Unlink account"/>
		</form>
	</div>
	<div>
		<div>
		<?php
			echo ($invalidVals)?"Invalid values":"";
			echo ($incorrectPass)?"Incorrect password":"";
			echo ($invalidPass)?"Invalid new password. Password must be atleast 6 characters long with a speical character and number.":"";
			echo ($passMismatch)?"Passwords mismatch":"";
			echo ($changeSuccess)?"Password changed successfully":"";
		?>
		</div>
		<form method = "POST">
			First name <input type="text" value="<?php echo $editor->firstname;?>" name="firstname"/><br/>
			Last name <input type="text" value="<?php echo $editor->lastname;?>" name="lastname"/><br/>
			Email ID <input type="text" value="<?php echo $editor->email;?>" name="email"/><br/>
			Current Password <input type="password" name="currPass"/><br/>
			New Password <input type="password" name="newPass"/><br/>
			Repeat New Password <input type="password" name="repPass"/><br/>
			<input type="submit" value="Save"/>
		</form>
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
