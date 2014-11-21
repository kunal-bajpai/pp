<?php
	require_once("../includes/init.php");
	session_start();
	if(isset($_POST['id']))
	{
		$project = Project::find_by_id($_POST['id']);
		if($_SESSION['custSess'] == $project->checkcode)
		{
			$project->status = 2;
			$project->endtime = time();
			$project->save();
			$project->log->log_action_anon("Project cancelled");
			$editor = Editor::find_for($project);
			if($editor != NULL)
				Database::get_instance()->query("UPDATE work SET end = ".time().", status = ".Editor::CANCELLED." WHERE project = ".$project->id." AND editor = ".$editor->id);
		}
	}
