<?php
	require_once("../includes/init.php");
	if(isset($_GET['editorId'] && isset($_GET['name'])
	{
		if(!is_dir(UPLOAD_DIR."editors/editor".$_GET['editorId']."/prev/"))
			mkdir(UPLOAD_DIR."editors/editor".$_GET['editorId']."/prev/",0777,true);
		if(!is_dir(UPLOAD_DIR."editors/editor".$_GET['editorId']."/thumbs/"))
			mkdir(UPLOAD_DIR."editors/editor".$_GET['editorId']."/thumbs/",0777,true);
		if(file_exists(UPLOAD_DIR."editors/editor".$_GET['editorId']."/prev/".$_GET['name'])
			unlink(UPLOAD_DIR."editors/editor".$_GET['editorId']."/prev/".$_GET['name']);
		if(file_exists(UPLOAD_DIR."editors/editor".$_GET['editorId']."/thumbs/".$_GET['name'])
			unlink(UPLOAD_DIR."editors/editor".$_GET['editorId']."/thumbs/".$_GET['name']);
		compress(UPLOAD_DIR."editors/editor".$_GET['editorId']."/".$_GET['name'],UPLOAD_DIR."editors/editor".$_GET['editorId']."/prev/".$_GET['name']);
		thumbnail(UPLOAD_DIR."editors/editor".$_GET['editorId']."/prev/".$_GET['name'],UPLOAD_DIR."editors/editor".$_GET['editorId']."/thumbs/".$_GET['name']);
		echo $_GET['name'];
	}
