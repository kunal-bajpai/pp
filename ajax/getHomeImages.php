<?php
	/*	USED ON:Home page
		ACCEPTS:none
		ACTION:none
		RESPONSE:Names of all home page images */
	$files = scandir("../pictures/home/before");
	$result = array();
	if(is_array($files))
	{
		foreach($files as $file)
			if($file!='.' && $file!='..')
			{
				$obj['name'] = $file;
				$result[] = $obj;
			}
	}
	echo json_encode($result);
?>
