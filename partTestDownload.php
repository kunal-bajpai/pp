<?php
	require_once("includes/init.php");
	$zip = new ZipArchive;
	$zipname = 'Tests.zip';
	$zip->open($zipname, ZipArchive::CREATE);
	if(is_array($_GET['name']))
		foreach ($_GET['name'] as $name)
		{
			$zip->addFile('pictures/tests/'.$name);
			$zip->renameName('pictures/tests/'.$name,'Tests/'.$name);
		}
	$zip->close();
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zipname);
	header('Content-Length: ' . filesize($zipname));
	readfile($zipname);
	if(file_exists($zipname))
		unlink($zipname);
?>
