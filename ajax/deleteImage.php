<?php
	/*	USED IN:Project submission page
		ACCEPTS:POST(original picture ID)
		ACTION:Delete original picture of given id if project is unconfirmed
		RESPONSE:none */
	require_once("../includes/init.php");
	if(isset($_POST['id']))
	{
		$picture = Picture::find_by_id($_POST['id']);
		if(isset($picture) && Project::find_by_id($picture->project)->status == Project::UNCONFIRMED)
		{
			$project = Project::find_by_id($picture->project);
			unlink(SITE_ROOT."/pictures/projects/project".$project->id."/original/".$picture->name);
			unlink(SITE_ROOT."/pictures/projects/project".$project->id."/original/prev/".$picture->name);
			unlink(SITE_ROOT."/pictures/projects/project".$project->id."/original/thumbs/".$picture->name);
			$picture->delete();
		}
	}
?>
