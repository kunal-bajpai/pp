<?php
	/*	USED ON:Edit home page
		ACCEPTS:none
		ACTION:none
		RESPONSE:Names of all sample images */
	$files = scandir("../pictures/sample/basic/before");
	$result = array();
	if(is_array($files))
	{
		foreach($files as $file)
			if($file!='.' && $file!='..')
			{
				$obj['name'] = $file;
				$result['basic'][] = $obj;
			}
	}
	$files = scandir("../pictures/sample/advanced/before");
	if(is_array($files))
	{
		foreach($files as $file)
			if($file!='.' && $file!='..')
			{
				$obj['name'] = $file;
				$result['advanced'][] = $obj;
			}
	}
	echo json_encode($result);
?>
