<?php
	function give_json($obj)
	{
	  return json_encode($obj);
	}

	function random_double()
	{
	  $num=0;
	  for($i=6;$i>0;$i--)
	  	$num=($num*10)+rand(1,9);
	  return $num;
	}
	
	function prefix()
	{
	  return random_double();
	}
	
	function checkCode()
	{
		return random_double();
	}
	
	function projectPassword()
	{
		return random_double();
	}	
	
	function hashText($text)
	{
		return md5($text);
	}
	
	function verify_email($email)
	{
		return preg_match('/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$email);
	}
	
	function verify_username($username)
	{
		return preg_match('/^(?=[^\._]+[\._]?[^\._]+$)[\w\.]{6,15}$/',$username);
	}
	
	function verify_password($password)
	{
		return preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,15}$/',$password);
	}

	function verify_firstname($firstname)
	{
		return preg_match('/^[a-zA-Z]+$/',$firstname);
	}

	function verify_lastname($lastname)
	{
		return preg_match('/^[a-zA-Z]+$/',$lastname) || $lastname == '';
	}

	function mail_on_confirm($customer, $project)
	{
		if(file_exists(SITE_ROOT."/mails/onConfirm"))
		{
			$mail = file_get_contents(SITE_ROOT."/mails/onConfirm");
			$mail = str_replace("//PROJECT_NAME//", $project->name, $mail);
			$mail = str_replace("//PROJECT_ID//", $project->id, $mail);
			$mail = str_replace("//PROJECT_CODE//", $project->checkcode, $mail);
			$mail = str_replace("//PROJECT_PASSWORD//", $project->password, $mail);
			mail($customer->email, "Project #".$project->id." ".$project->name, $mail, "From: Photo Puddle <admin@photopuddle.com");
		}
	}
	
	function mail_on_pref($editor, $project)
	{
		if(file_exists(SITE_ROOT."/mails/onPref"))
		{
			$mail = file_get_contents(SITE_ROOT."/mails/onPref");
			$mail = str_replace("//PROJECT_NAME//", $project->name, $mail);
			$mail = str_replace("//PROJECT_ID//", $project->id, $mail);
			mail($editor->email, "Project #".$project->id." ".$project->name, $mail, "From: Photo Puddle <admin@photopuddle.com");
		}
	}
	
	function mail_on_upload($customer, $project, $num)
	{
		if(file_exists(SITE_ROOT."/mails/onUpload"))
		{
			$mail = file_get_contents(SITE_ROOT."/mails/onUpload");
			$mail = str_replace("//PROJECT_NAME//", $project->name, $mail);
			$mail = str_replace("//PROJECT_ID//", $project->id, $mail);
			$mail = str_replace("//PROJECT_CODE//", $project->checkcode, $mail);
			$mail = str_replace("//PROJECT_PASSWORD//", $project->password, $mail);
			$mail = str_replace("//NUM_IMAGES//", $num, $mail);
			mail($customer->email, "Project #".$project->id." ".$project->name, $mail, "From: Photo Puddle <admin@photopuddle.com");
		}
	}
	
	function cust_require_login($project)
	{
		if ( php_sapi_name() !== 'cli' ){
				if ( version_compare(phpversion(), '5.4.0', '>=') ) {
					if(session_status() !== PHP_SESSION_ACTIVE)
						session_start();
				} else
					if(session_id() === '')
						session_start();
		}
		if($_SESSION['custSess'] != $project->checkcode)
			die("Unauthorised access. Please use the link and password sent to your email to login.");
	}
	
	function cust_logout()
	{
		if ( php_sapi_name() !== 'cli' ){
				if ( version_compare(phpversion(), '5.4.0', '>=') ) {
					if(session_status() !== PHP_SESSION_ACTIVE)
						session_start();
				} else
					if(session_id() === '')
						session_start();
		}
		unset($_SESSION['custSess']);
	}
	
	function watermarkImage ($src, $dest) { 		
		$image = new Imagick();
		$image->readImage($src);
		 
		$watermark = new Imagick();
		$watermark->readImage(SITE_ROOT."/watermark.png");
		 
		// how big are the images?
		$iWidth = $image->getImageWidth();
		$iHeight = $image->getImageHeight();
		$wWidth = $watermark->getImageWidth();
		$wHeight = $watermark->getImageHeight();
		 
		if ($iHeight < $wHeight || $iWidth < $wWidth) {
			// resize the watermark
			$watermark->scaleImage($iWidth, $iHeight);
		 
			// get new size
			$wWidth = $watermark->getImageWidth();
			$wHeight = $watermark->getImageHeight();
		}
		 
		// calculate the position
		$x = ($iWidth - $wWidth) / 2;
		$y = ($iHeight - $wHeight) / 2;
		 
		$image->compositeImage($watermark, imagick::COMPOSITE_OVER, $x, $y);
		$image->writeImage($dest);
		$image->destroy();
	};
	
	function thumbnail($src,$dest)
	{
		$im = new Imagick($src);
		$im->setFormat('jpeg');
		$im->thumbnailImage(300,300,true);
		$im->writeImage($dest);
		$im->clear();
		$im->destroy();
	}
	
	function compress($src, $dest) 
	{
		$im = new imagick($src);
		$im->setFormat('jpeg');
		$width = $im->getImageWidth();
		$height = $im->getImageHeight();
		if($width > $height)
			$im->resizeImage(1500, 0, imagick::FILTER_LANCZOS, 1); 
		else 
			$im->resizeImage(0 , 1500, imagick::FILTER_LANCZOS, 1);
		$im->writeImage($dest); 
		$im->clear(); 
		$im->destroy();	
	}
