<?php
	/* 	USED ON: Editor my project view
		ACCEPTS: POST(number of photos uploaded, id of project)
		ACTION: Logs into project log
		RESPONSE: None */
	require_once("../includes/init.php");
	if(isset($_POST['id']) && isset($_POST['num']))
	{
		$project = Project::find_by_id($_POST['id']);
		if(Session::is_logged_in() && Session::get_instance()->logged_in_user()->get_status($project) == Editor::ONGOING)
		{
			$project->log->log_action($_POST['num']." pictures uploaded.");
			mail_on_upload(Customer::find_by_id($project->customer),$project,$_POST['num']);
		}
	}
?>
