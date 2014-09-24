<?php
	require_once("includes/init.php");
	$project = Project::find_by_id($_GET['projId']);
	$session = Session::get_instance();
	if(!($session->is_logged_in() && ($session->logged_in_user()->get_status($project) == Editor::ONGOING)))
		die;
	$ids = explode("_",$_GET['ids']);
	$zip = new ZipArchive;
	$zipname = 'Project '.$project->id.'.zip';
	$zip->open($zipname, ZipArchive::CREATE);
	$instr = '';
	if(is_array($ids))
		foreach ($ids as $id)
		{
			$picture = Picture::find_by_id($id);
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
