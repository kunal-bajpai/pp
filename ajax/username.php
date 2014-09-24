<?php
	/*	USED ON:Editor signup page
		ACCEPTS:POST(username)
		ACTION:Checks if username is available
		RESPONSE:1 if available else 0 */
	require_once("../includes/init.php");
	if(isset($_POST['username']))
	{
		$editor = Editor::find_by_username($_POST['username']);
		if(!isset($editor))
			echo 1;
		else
			echo 0;
	}
	else
		echo 0;
?>
