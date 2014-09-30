<?php
	require_once("includes/init.php");
	cust_logout();
	$incUsername = false;
	$incPassword = false;
	$unverified = false;
	if(isset($_POST['login_username']) && isset($_POST['login_password']))
		if(verify_email($_POST['login_username']) || verify_username($_POST['login_username']))
		{
			$editor = Editor::find_by_username($_POST['login_username']);
			if(!isset($editor))
				$editor = Editor::find_by_email($_POST['login_username']);
			if(!isset($editor))
				$incUsername = true;
			else
			{
				$editor->password = hashText($_POST['login_password']);
				if($editor->verify == '')
					if($editor->authenticate())
					{
						$session = new Session();
						$session->login($editor);
						if(isset($_GET['fwd']))
							header("location:".urldecode($_GET['fwd']));
						else
							header("location:editMyProjList.php");
					}
					else
						$incPassword = true;
				else
					$unverified = true;
			}
		}
		else
			echo $incUsername = true;
	if(isset($_GET['verified']))
		echo "Account verified. You may now login.";
	if(Session::get_instance()->is_logged_in())
		header("location:editMyProjList.php");
?>
 <!DOCTYPE html>

 <html lang="en">
<?php
	$allfiles = scandir(SITE_ROOT."pictures/tests"); //get names of required test images
	if(is_array($allfiles))
	{
		$str='';
		foreach($allfiles as $file)
			if($file!='.' && $file!='..')
			{
				$str.='"'.$file.'",';
				$files[] = $file;
			}
		$str=trim($str,',');
	}
	
	if(!isset($_POST['login_username']) && !isset($_POST['login_password']) && sizeof($_POST)>0)
	{
		//cross check posted signup form
		$editor = Editor::find_by_username($_POST['username']);
		$firstname = isset($_POST['firstname']) && verify_firstname($_POST['firstname']);
		$lastname = isset($_POST['lastname']) && verify_lastname($_POST['lastname']);
		$email = isset($_POST['email']) && verify_email($_POST['email']);
		$username = isset($_POST['username']) && verify_username($_POST['username']) && !isset($editor);
		$password = isset($_POST['password']) && verify_password($_POST['password']) &&  $_POST['password'] == $_POST['rep_password'];
		$results = scandir(SITE_ROOT."pictures/tests");
		$files = array();
		$testNames=array();

		if(is_array($results))
		{
			foreach($results as $result)
				if($result!='.' && $result!='..')
					$files[] = $result;
		}
		$tests = File::get_file_array('tests'); //get uploaded test images

		if(is_array($tests))
			foreach($tests as $test)
				if($test->name!='')
					$testNames[] = $test->name; //separate names in another array

		$testFiles = count($testNames) == count($files);
		if(is_array($files) && count($files)>0 && $testFiles)
			foreach($files as $file)
				if(!in_array($file,$testNames)) //check if all required files are among uploaded test images
				{
					$testFiles = false;
					break;
				}
	}		
?>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Editors' Section</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico" type="image/pp-icon"/>
	<link href="css/style_editor_signin.css" rel="stylesheet">
	<link href="css/reset.css" rel="stylesheet">
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/progressbar.css">
	</head>

<script>
	var testImgs = new Array(<?php echo $str;?>);
</script>

<script src="./js/jquery-1.11.0.min.js"></script>

<body>

  <div id="logobkg">
    <a href="index.php">
    <!--<p><span id="one">PHOTO</span><span id="two">PUDDLE</span></p>-->
    <img id="instr1" src="images/pp1.png" onmouseover="this.src='images/pp2.png'" onmouseout="this.src='images/pp1.png'"/>
    </a>
    </div>


	<div id='wrapper-left'>
		<h5 id='wel2' class='greenc'>Sign In :</h5>
		<br />
			   
		<div id='login1'>
			<?php
			if($incUsername)
				echo "Incorrect username";
			if($incPassword)
				echo "Incorrect password";
			if($unverified)
				echo "User unverified. Please verify email before logging in";?>
			<form id='signInForm' method="POST">
				<input type='text' name='login_username' placeholder='Username/Email'/><br />
				<input type="password" name='login_password' placeholder='Password'/>
				<input type="submit" value="&#10137;"><br />
				<br><br />
				Want to work with us? <a class='showsignup'>Sign&nbsp;Up!</a>
				
			</form>
		</div>

	</div>


	<div id='signupcomplete'  style='display:none;'>
	<h5 id='wel3' class='bluec'>Sign Up !</h5>
	<div id='signupsection'>

		<?php
	if(!isset($_POST['login_username']) && !isset($_POST['login_password']) && sizeof($_POST)>0)
	{
		$msg = ''; //Compile error message
		if(!$firstname)
			$msg.=' Only alphabets allowed in first name.';
		if(!$lastname)
			$msg.=' Only alphabets allowed in last name.';
		if(!$email)
			$msg.=' Invalid email id.';
		if(!$username)
			$msg.=' Invalid or unavailable username.';
		if(!$password)
			$msg.=' Invalid password.';
		if(!$testFiles)
			$msg.=' Missing test files.';
		if($firstname && $lastname && $email && $username && $password && $testFiles) //If all is well then create editor
		{
			$editor = new Editor();
			$editor->firstname = $_POST['firstname'];
			$editor->lastname = $_POST['lastname'];
			$editor->email = $_POST['email'];
			$editor->username = $_POST['username'];
			$editor->password = hashText($_POST['password']);
			$editor->signuptime = time();
			$editor->verify = random_double();
			$editor->save();
			umask(0);
			mkdir(SITE_ROOT.'/pictures/editors/editor'.$editor->id);
			mkdir(SITE_ROOT.'/pictures/editors/editor'.$editor->id.'/prev');
			mkdir(SITE_ROOT.'/pictures/editors/editor'.$editor->id.'/thumbs');
			foreach($tests as $test) //save test files
			{
				$test->save_file_in(SITE_ROOT.'/pictures/editors/editor'.$editor->id.'/');
				compress(SITE_ROOT.'/pictures/editors/editor'.$editor->id.'/'.$test->name, SITE_ROOT.'/pictures/editors/editor'.$editor->id.'/prev/'.$test->name);
				thumbnail(SITE_ROOT.'/pictures/editors/editor'.$editor->id.'/prev/'.$test->name, SITE_ROOT.'/pictures/editors/editor'.$editor->id.'/thumbs/'.$test->name);
			}
		}
		else
			echo $msg." Please sign up again.";
	}
?>
		<div id='login2'>		   <!--er-error, su-signup. -->
			<form id='signUpForm'  enctype='multipart/form-data' method='POST'>
				<input type='text' maxlength='30' id='su_firstname' name='firstname' placeholder='First Name'/><br />
				<p id='er_su_firstname' class="er_su_style" style='display:none'>First name should only contain alphabets!</p>
				<input type='text' maxlength='30' id='su_lastname' name='lastname' placeholder='Last Name'/><br />
				<p id='er_su_lastname' class="er_su_style" style='display:none'>Last name should only contain alphabets!</p>
				<input type='email' maxlength='30' id='su_email' name='email' placeholder='Email'/><br />
				<p id='er_su_email' class="er_su_style" style='display:none'>Please enter a valid email.</p>
				<input type='text' maxlength='15' id='su_username' name='username' placeholder='Choose a Username'/>
				<p style='display:none' id='usernamestatus'></p><br />
				<input type="password" maxlength='20' id='su_password' name='password' placeholder='Password'/><br>
				<p id='er_su_password' class="er_su_style" style='display:none'>Password must be 6-14 characters long with a number and a special character!</p>
				<input type="password" maxlength='20' id='su_rep_password' name='rep_password' placeholder=' Repeat Password'/><br>
				<p id='er_su_rep_password' class="er_su_style" style='display:none'>Passwords do not match!</p>
				<input type="file" id='su_tests' name="tests[]" accept="image/*" multiple/>
				<p id='er_su_tests' class="er_su_style" style='display:none'>Please upload all tests with same names</p>
				<div class="DTI-style round-corners">
				<a href="testDload.php" target="_blank" style="text-decoration:none; color:inherit;">Download Test Images</a><br/>
				</div>
			   
			</form>
			
			<input type="submit" form="signUpForm" class="round-corners2" id='su_submit' value="Sign Up"><br />	
				<br />
				Already Registered with us? <a class='showsignup'>Sign&nbsp;In!</a>
		</div>
	</div>

	<div id="wrapper-right">
		  	<h1>Sign Up Instructions!</h1>
		  	<ul class='wrap3 zfix' >
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
					<li>Donec tempus tellus id fringilla euismod.</li>
					<li>Nulla sed risus nec dolor laoreet adipiscing.</li>
					<li>Aenean sit amet dolor lobortis, blandit nibh vitae, vulputate felis.</li>
					<li>Praesent ut ipsum a leo consectetur bibendum.</li>
					<li>Praesent blandit lorem et elit molestie fringilla.</li>
			</ul>
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
	        <a href='index.php' class='footerlogo'/></a>
	         <p id="copyright">&copy; PhotoPuddle 2014<p>
	    </div>

</body>
<script src='js/editSignin.js'></script>
<script src="js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript">
		$(function()
			{
				$('.showsignup').click(function(){
				  $('#wrapper-left').slideToggle();
				  $('#signupcomplete').slideToggle();
				});
			});
		</script>
</html>
