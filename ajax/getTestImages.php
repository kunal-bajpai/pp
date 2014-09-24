<?php
	/*	USED ON:Sign up page for editors to cross check names with submitted test images
		ACCEPTS:none
		ACTION:none
		RESPONSE:Names of all test images */
	if(!is_dir("../pictures/tests"))
		mkdir("../pictures/tests",0777,true);
	$files = scandir("../pictures/tests");
	$result = array();
	if(is_array($files))
	{
		foreach($files as $file)
			if($file!='.' && $file!='..')
				$result[] = $file;
	}
	echo json_encode($result);
?>
