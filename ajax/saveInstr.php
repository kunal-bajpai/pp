<?php
	/*	USED ON:Project submission page
		ACCEPTS:Picture ID and instruction
		ACTION:Saves instruction for given picture if project is unconfirmed
		RESPONSE:none */
	require_once("../includes/init.php");
	if(isset($_POST['id']) && isset($_POST['instr']))
	{
		$picture = Picture::find_by_id($_POST['id']);
		if(isset($picture))
		{
			$project = Project::find_by_id($picture->project);
			if(isset($project) && $project->status == Project::UNCONFIRMED)
			{
				$picture->instructions = $_POST['instr'];
				echo $picture->save();
			}
		}
	}
?>
