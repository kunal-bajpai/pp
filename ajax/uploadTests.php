<?php
	/*	USED ON:Take test page
		ACCEPTS:FILES(Pictures to upload)
		ACTION:Adds test image to editor profile by matching name with original picture
		RESPONSE:None*/
	require_once("../includes/init.php");
	$session = Session::get_instance();
	if($session->is_logged_in())
		$editor = $session->logged_in_user();
	else
		die("-1");
	$files = File::get_file_array("fileToUpload");
	$testFiles = scandir(SITE_ROOT."pictures/tests");
	$tests = array();
	if(is_array($testFiles))
	{
		foreach($testFiles as $testFile)
			if($testFile!='.' && $testFile!='..')
				$tests[] = $testFile;
	}
	umask(0);
	if(!is_dir(UPLOAD_DIR."editors/editor".$editor->id."/"))
		mkdir(UPLOAD_DIR."editors/editor".$editor->id."/",0777,true);
	if(is_array($files))
	{
		foreach($files as $file)
		{
			if(!$file->is_image())
				continue;
			if(in_array($file->name,$tests))
				$file->save_file_in(UPLOAD_DIR."editors/editor".$editor->id."/");
		}
		$editor->status = Editor::PENDING;
		$editor->save();
	}
?>
