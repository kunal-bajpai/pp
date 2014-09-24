<?php
	//Zips and downloads all original pictures of project
	require_once("includes/init.php");
	$project = Project::find_by_id($_GET['projId']);
	$session = Session::get_instance();
	if(!($session->is_logged_in() && ($session->logged_in_user()->get_status($project) == Editor::ONGOING)))
		die;
	$pictures = Picture::find_for_project($project);
	$zip = new ZipArchive;
	$zipname = 'Project '.$project->id.'.zip';
	$zip->open($zipname, ZipArchive::CREATE);
	$instr = '';
	if(is_array($pictures))
		foreach ($pictures as $picture)
		{
		 	$zip->addFile('pictures/projects/project'.$project->id.'/original/'.$picture->name);
			$zip->renameName('pictures/projects/project'.$project->id.'/original/'.$picture->name,'Project '.$project->id.'/picture'.$picture->id.'.'.$picture->ext);
			if($picture->instructions!='')
				$instr = 'Picture '.$picture->id.': '.$picture->instructions."\n";
		}
	if($instr!='')
		$zip->addFromString("Project ".$project->id."/instructions.txt",$instr);
	$zip->close();
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zipname);
	header('Content-Length: ' . filesize($zipname));
	readfile($zipname);
	if(file_exists($zipname))
		unlink($zipname);
?>
