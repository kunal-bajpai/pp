<?php
	/*	USED ON:New project view page for editor
		ACCEPTS:GET(Project ID)
		ACTION:Assigns project to editor if project is free and editor is logged in
		RESPONSE:none */
	require_once("../includes/init.php");
	$session = Session::get_instance();
	if(isset($_GET['id']) && $session->is_logged_in())
	{
		$project = Project::find_by_id($_GET['id']);
		if($session->logged_in_user()->status == Editor::PENDING)
			echo -2;
		else
			if($session->logged_in_user()->status == Editor::DISAPPROVED)
				echo -3;
			else
				if($project->is_free())
					if($project->status = Project::CONFIRMED && $session->logged_in_user()->get_status($project) == Editor::NOT_WORKED_ON)
					{
						$project->assign_to($session->logged_in_user());
						$project->log->log_action("Project undertaken");
						echo 0;
					}
					else
						echo $session->logged_in_user()->get_status($project);
				else
					echo -1;
	}
