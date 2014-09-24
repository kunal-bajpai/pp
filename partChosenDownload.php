<?php
	require_once("includes/init.php");
	$project = Project::find_by_id($_GET['projId']);
	session_start();
	if($SESSION['custSess']!=$project->checkcode))
		die;
	$ids = explode("_",$_GET['ids']);
	$zip = new ZipArchive;
	$zipname = 'Project '.$project->id.'.zip';
	$zip->open($zipname, ZipArchive::CREATE);
	$instr = '';
	if(is_array($ids))
		foreach ($ids as $id)
		{
			$picture = Donepic::find_by_id($id);
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
