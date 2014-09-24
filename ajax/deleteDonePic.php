<?php
	/*	USED ON:editor project view
		ACCEPTS:POST(donepic ID)
		ACTION:Deletes donepic of given id
		RESPONSE:none */
	require_once("../includes/init.php");
	if(isset($_POST['id']))
	{
		$picture = DonePic::find_by_id($_POST['id']);
		$session = Session::get_instance();
		if(isset($picture) && $session->logged_in_user()->id == $picture->editor)
		{
			$project = Project::find_by_id(Picture::find_by_id($picture->original)->project);
			unlink(SITE_ROOT."/pictures/projects/project".$project->id."/done/".$picture->name);
			unlink(SITE_ROOT."/pictures/projects/project".$project->id."/wm/".$picture->wmName());
			$project->log->log_action("Picture ".$picture->id." deleted");
			$picture->delete();
		}
	}
?>
