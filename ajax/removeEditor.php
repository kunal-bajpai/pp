<?php
	/*	USED ON: Customer project view
		ACCEPTS: POST(project id)
		ACTION: Removes editor from project
		RESPONSE: None */
	require_once("../includes/init.php");
	session_start();
	if(isset($_POST['projId']))
	{
		$project = Project::find_by_id($_POST['projId']);
		if($_SESSION['custSess'] != $project->checkcode)
			die;
		$db = Database::get_instance();
		$status = $db->fetch_array($db->query("SELECT status FROM work WHERE project = {$project->id}"));
		if(isset($status[0][0]) && $status[0][0] == Editor::ONGOING)
		{
			$db->query("UPDATE work SET status = ".Editor::REMOVED.", end = ".time()." WHERE project = {$project->id}");
		}
	}
?>
