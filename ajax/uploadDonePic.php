<?php
	/*	USED ON:Editor project view page
		ACCEPTS:FILES(Pictures to upload), POST(Project ID)
		ACTION:Adds donepic to project by matching name with original picture
		RESPONSE:Original pic name, donepic name and id [{name:string,original:string,id:int}] */
	require_once("../includes/init.php");
	$files = File::get_file_array("fileToUpload");
	$project = Project::find_by_id($_POST['projid']);
	if(!isset($project) || !(Session::get_instance()->is_logged_in() && Session::get_instance()->logged_in_user()->get_status($project) == Editor::ONGOING))
		die("-1");
	umask(0);
	if(!is_dir(UPLOAD_DIR."projects/project".$project->id."/done/"))
		mkdir(UPLOAD_DIR."projects/project".$project->id."/done/",0777,true);
	if(!is_dir(UPLOAD_DIR."projects/project".$project->id."/wm/"))
		mkdir(UPLOAD_DIR."projects/project".$project->id."/wm/",0777,true);
		if(is_array($files))
		foreach($files as $file)
		{
			if(!$file->is_image())
				continue;
			$nameArr = explode('.',$file->name);
			$donepic = new DonePic();
			$file->name = str_replace(" ","",$file->name);
			if(!preg_match("/^[Pp]icture([0-9]+)([(][0-9]{1,}[)]){0,1}[.][a-zA-Z]{3,}$/", $file->name, $output))
				continue;
			$picture = Picture::find_by_id($output[1]);
			if(!isset($picture))
				continue;
			if(count($nameArr) > 1)
				$donepic->ext = end($nameArr);
			else
				continue;
			$donepic->original = $picture->id;
			$donepic->prefix = prefix();
			$donepic->editor = Session::get_instance()->logged_in_user()->id;
			$file->name = hashText($donepic->prefix."Picture".$picture->id).".".$donepic->ext;
			$donepic->name = $file->name;
			$donepic->save();
			$file->save_file_in(UPLOAD_DIR."projects/project".$project->id."/done/");
			watermarkImage(UPLOAD_DIR."projects/project".$project->id."/done/".$donepic->name,UPLOAD_DIR."projects/project".$project->id."/wm/".$donepic->wmName());
			$fileDet['name']=$file->name;
			$fileDet['original']=$picture->name;
			$fileDet['id']=$donepic->id;
			$fileDets[] = $fileDet;
		}
	if(isset($fileDets))
		$resultObject = $fileDets;
	else
		$resultObject = null;
	echo json_encode($resultObject);
?>
