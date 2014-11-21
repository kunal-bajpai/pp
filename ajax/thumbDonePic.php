<?php
	require_once("../includes/init.php");
	if(isset($_GET['id']) && isset($_GET['picId']))
	{
		$donepic = DonePic::find_by_id($_GET['picId']);
		if(!is_dir(UPLOAD_DIR."projects/project".$_GET['id']."/done/thumbs/"))
			mkdir(UPLOAD_DIR."projects/project".$_GET['id']."/done/thumbs/",0777,true);
		if(!is_dir(UPLOAD_DIR."projects/project".$_GET['id']."/wm/thumbs/"))
			mkdir(UPLOAD_DIR."projects/project".$_GET['id']."/wm/thumbs/",0777,true);
		if(!is_dir(UPLOAD_DIR."projects/project".$_GET['id']."/done/prev/"))
			mkdir(UPLOAD_DIR."projects/project".$_GET['id']."/done/prev/",0777,true);
		if(!is_dir(UPLOAD_DIR."projects/project".$_GET['id']."/wm/prev/"))
			mkdir(UPLOAD_DIR."projects/project".$_GET['id']."/wm/prev/",0777,true);
		compress(UPLOAD_DIR."projects/project".$_GET['id']."/done/".$donepic->name,UPLOAD_DIR."projects/project".$_GET['id']."/done/prev/".$donepic->name);
		compress(UPLOAD_DIR."projects/project".$_GET['id']."/wm/".$donepic->wmName(),UPLOAD_DIR."projects/project".$_GET['id']."/wm/prev/".$donepic->wmName());
		thumbnail(UPLOAD_DIR."projects/project".$_GET['id']."/wm/prev/".$donepic->wmName(),UPLOAD_DIR."projects/project".$_GET['id']."/wm/thumbs/".$donepic->wmName());
		thumbnail(UPLOAD_DIR."projects/project".$_GET['id']."/done/prev/".$donepic->name,UPLOAD_DIR."projects/project".$_GET['id']."/done/thumbs/".$donepic->name);
		echo $donepic->name;
	}
