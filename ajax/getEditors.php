<?php
	/*	USED ON:Project submission page
		ACCEPTS:POST(max number of editors to return,id of editors to be excluded in result)
		ACTION:none
		RESPONSE:num number of editors [Editor{}] */
	require_once("../includes/init.php");
	if(isset($_POST['num']))
	{
		$editors = Editor::find_by_sql("SELECT * FROM editors WHERE id != ".$_POST['not'][0]." AND id!=".$_POST['not'][1]." AND id!=".$_POST['not'][2]." ORDER BY RAND() LIMIT ".$_POST['num']);
		echo json_encode($editors);
	}
?>
