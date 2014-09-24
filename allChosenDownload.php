<?php
	//Zips and downloads all original pictures of project
	require_once("includes/init.php");
	$project = Project::find_by_id($_GET['projId']);
	session_start();
	if($_SESSION['custSess']!=$project->checkcode))
		die("Unauthorised access");
	$pictures = Donepic::find_chosen_for_project($project);
	$zip = new ZipArchive;
	$zipname = 'Project '.$project->id.'.zip';
	$zip->open($zipname, ZipArchive::CREATE);
	$instr = '';
	if(is_array($pictures))
		foreach ($pictures as $picture)
		{
		 	$zip->addFile('pictures/projects/project'.$project->id.'/done/'.$picture->name);
			$zip->renameName('pictures/projects/project'.$project->id.'/done/'.$picture->name,'Project '.$project->id.'/picture'.$picture->id.'.'.$picture->ext);
		}
	$zip->close();
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zipname);
	header('Content-Length: ' . filesize($zipname));
	readfile($zipname);
	if(file_exists($zipname))
		unlink($zipname);
?>
