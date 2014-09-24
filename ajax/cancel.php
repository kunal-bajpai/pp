<?php
	/*	USED ON: Project submission page
		ACCEPTS: POST(project ID)
		ACTION: Cancels unconfirmed project and deletes all pictures
		REPSONSE: none */
	require_once("../includes/init.php");
	if(isset($_POST['id']))
	{
		$project = Project::find_by_id($_POST['id']);
		if(isset($project) && $project->status == Project::UNCONFIRMED)
		{
			$pictures = Picture::find_for_project($project);
			if(is_array($pictures))
				foreach($pictures as $picture)
				{
					unlink(SITE_ROOT."/pictures/projects/project".$project->id."/original/".$picture->name);
					unlink(SITE_ROOT."/pictures/projects/project".$project->id."/original/thumbs/".$picture->name);
					unlink(SITE_ROOT."/pictures/projects/project".$project->id."/original/prev/".$picture->name);
					$picture->delete();
				}
			rmdir(SITE_ROOT."/pictures/projects/project".$project->id."/original/thumbs");
			rmdir(SITE_ROOT."/pictures/projects/project".$project->id."/original/prev");
			rmdir(SITE_ROOT."/pictures/projects/project".$project->id."/original");
			rmdir(SITE_ROOT."/pictures/projects/project".$project->id);
			$project->delete();
		}
	}
?>
