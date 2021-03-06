<?php
	/*	USED ON:Customer and editor project view
		ACCEPTS:GET(project ID)
		ACTION:Checks if logged in editor is working on this project or request is from authorised customer
		RESPONSE:All original and donepics for given project [original:[Picture{}],edited:[DonePic{}]]
	*/	
	require_once("../../includes/init.php");
	$pictures = Picture::find_dets_for_project($_GET['projId']);
	$project = Project::find_by_id($_GET['projId']);
	$session = AdminSession::get_instance();
	if($session->is_logged_in())
	{
		if(is_array($pictures))
		{
			foreach($pictures as $picture)
			{
				unset($picture->fields);
				if($project->type == 0)
					unset($picture->instructions);
			}
			$res['original'] = $pictures;
		}
		$done = DonePic::find_dets_for_project($_GET['projId']);
		if(is_array($done))
		{
			foreach($done as $donepic)
			{
				unset($donepic->fields);
			}
			$res['edited'] = $done;
		}
		echo give_json($res);
	}
?>
