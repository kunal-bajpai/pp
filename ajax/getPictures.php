<?php
	/*	USED ON:New project view for editor
		ACCEPTS:GET(project ID)
		ACTION:Checks if project is not taken
		RESPONSE:Array of original pictures [Picture{}] */
	require_once("../includes/init.php");
	$pictures = Picture::find_dets_for_project($_GET['projId']);
	$project = Project::find_by_id($_GET['projId']);
	if(isset($project) && $project->is_free())
	{
		if(is_array($pictures))
			foreach($pictures as $picture)
			{
				unset($picture->fields);
				if($project->type == 0)
					unset($picture->instructions);
			}
		echo give_json($pictures);
	}
?>
