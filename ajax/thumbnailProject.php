<?php
error_reporting(E_ALL);
	require_once("../includes/init.php");
	if(isset($_GET['id']) && isset($_GET['name']))
	{
		if(!is_dir(UPLOAD_DIR."projects/project".$_GET['id']."/original/thumbs/"))
			mkdir(UPLOAD_DIR."projects/project".$_GET['id']."/original/thumbs/",0777,true);
		if(!is_dir(UPLOAD_DIR."projects/project".$_GET['id']."/original/prev/"))
			mkdir(UPLOAD_DIR."projects/project".$_GET['id']."/original/prev/",0777,true);	
		compress(UPLOAD_DIR."projects/project".$_GET['id']."/original/".$_GET['name'],UPLOAD_DIR."projects/project".$_GET['id']."/original/prev/".$_GET['name']);
		thumbnail(UPLOAD_DIR."projects/project".$_GET['id']."/original/prev/".$_GET['name'],UPLOAD_DIR."projects/project".$_GET['id']."/original/thumbs/".$_GET['name']);
		echo $_GET['name'];
	}
