<?php
	/*	USED ON:Project submission page
		ACCEPTS:POST(Project id, email, instructions)
		ACTION:Confirms an unconfirmed project and updates details if posted to it. Generates password and checkcode and sends mail to customer
		RESPONSE:none
	*/
	require_once("../includes/init.php");
	if(isset($_POST['id']))
	{
		$project = Project::find_by_id($_POST['id']);
		if(isset($project) && $project->status == Project::UNCONFIRMED)
		{
			$customer = Customer::find_by_email($_POST['email']);
			if(!isset($customer))
			{
				$customer = new Customer();
				$customer->email = $_POST['email'];
				$customer->save();
			}
			$project->customer = $customer->id;
			$project->name = $_POST['name'];
			$project->instructions = $_POST['instructions'];
			$project->password = projectPassword();
			$project->checkcode = checkCode();
			$project->status = 1;
			$project->save();
			$project->log->log_action_anon("Project created");
			mail_on_confirm($customer,$project);
			if(isset($_POST['pref']) && is_array($_POST['pref']))
				foreach($_POST['pref'] as $pref)
					if(is_int($pref))
					{
						$db->query("INSERT INTO prefs (editor,project) VALUES ('{$pref}','{$project->id}')");
						mail_on_pref(Editor::find_by_id($pref),$project);
					}
		}
	}
?>
