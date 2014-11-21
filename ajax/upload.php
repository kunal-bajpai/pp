<?php
	/*	USED ON:Project submission page
		ACCEPTS:FILES(Pictures to upload), POST(email, project id, project instructions, project name)
		ACTION:Creates new project if project ID is 0 or updates given project and uploads pictures
		RESPONSE:Project ID and uploaded picture name and id {projectId:int, files:[{name:string,id:int}]} */
	require_once("../includes/init.php");
	$files = File::get_file_array("fileToUpload");
	$customer = Customer::find_by_email($_POST['email']);
	if(!isset($customer))
	{
		$customer = new Customer();
		$customer->email = $_POST['email'];
		$customer->save();
	}
	if($_POST['projid']==0)
	{
		$project = new Project();
		$project->name = $_POST['name'];
		$project->submittime = time();
		$project->type = $_POST['mode'];
		$project->customer = $customer->id;
		$project->instructions = $_POST['instructions'];
		$project->save();
	}
	else
	{
		$project = Project::find_by_id($_POST['projid']);
	}
	if(!isset($project))
		die("Error linking project");
	umask(0);
	if(!is_dir(UPLOAD_DIR."projects/project".$project->id."/original/"))
		mkdir(UPLOAD_DIR."projects/project".$project->id."/original/",0777,true);
	if(is_array($files))
		foreach($files as $file)
		{
			if(!$file->is_image())
				continue;
			$nameArr = explode('.',$file->name);
			$picture = new Picture();
			$picture->project = $project->id;
			$picture->ext = end($nameArr);
			$picture->prefix = prefix();
			$file->name = hashText($picture->prefix."Picture".$picture->id);
			$picture->name = $file->name;
			$picture->save();
			$file->save_file_in(UPLOAD_DIR."projects/project".$project->id."/original/");
			$fileDet['name']=$file->name;
			$fileDet['id']=$picture->id;
			$fileDets[] = $fileDet;
		}
	$resultObject['projectId'] = $project->id;
	if(isset($fileDets))
		$resultObject['files'] = $fileDets;
	else
		$resultObject['files'] = null;
	echo json_encode($resultObject);
?>
