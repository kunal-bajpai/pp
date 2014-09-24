<?php
	require_once("includes/init.php");
	if(isset($_GET['username']) && isset($_GET['verify']))
   	{
   			$editor = Editor::find_by_username($_GET['username']);
   			if(isset($editor) && $editor->verify == $_GET['verify'])
   			{
   				$editor->verify = '';
   				$editor->save();
   				header("location:".EDITOR_LOGIN_PAGE."?verified");
   			}
   			else
   				echo "Incorrect verification code.";
   	}
