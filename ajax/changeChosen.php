<?php
	/*	USED ON:Customer project view
		ACCEPTS:POST(donepic ID,action)
		ACTION:Sets given donepic's chosen to action
		RESONSE:none
	*/
	require_once("../includes/init.php");
	if(isset($_POST['id']) && isset($_POST['action']))
	{
		$donepic = DonePic::find_by_id($_POST['id']);
		session_start();
		if(isset($donepic) && $_SESSION['custSess'] == Project::find_by_id(Picture::find_by_id($donepic->original)->project)->checkcode)
			if($_POST['action']==0 || $_POST['action']==1)
			{
				$donepic->chosen = $_POST['action'];
				$donepic->save();
			}
	}
?>
