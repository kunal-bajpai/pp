<?php
	/*	USED ON: Editor my project view
		ACCEPTS: POST(project id)
		ACTION: Drops project for logged in editor
		RESPONSE: None */
	require_once("includes/init.php");
	$session = Session::get_instance();
	if(isset($_POST['id']) && $session->is_logged_in())
	{
		$project = Project::find_by_id($_POST['id']);
		if($session->logged_in_user()->get_status($project) == Editor::ONGOING)
		{
			$session->logged_in_user()->drop_project($project);
			$project->log->log_action("Project dropped");
		}
	}
?>
