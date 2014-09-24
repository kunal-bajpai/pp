<?php
	require_once("includes/init.php");
	$allfiles = scandir("/var/www/pp/pictures/tests"); //get names of required test images
	if(is_array($allfiles))
	{
		foreach($allfiles as $file)
			if($file!='.' && $file!='..')
				$files[] = $file;
	}
	$zip = new ZipArchive;
	$zipname = 'Tests.zip';
	$zip->open($zipname, ZipArchive::CREATE);
	foreach ($files as $file)
	{
	 	$zip->addFile('pictures/tests/'.$file);
		$zip->renameName('pictures/tests/'.$file,'Tests/'.$file);
	}
	$zip->close();
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zipname);
	header('Content-Length: ' . filesize($zipname));
	readfile($zipname);
	if(file_exists($zipname))
		unlink($zipname);
?>
