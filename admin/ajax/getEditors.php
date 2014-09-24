<?php
	/*	USED ON:Admin list of editors
		ACCEPTS:GET(base and offset for pagination)
		ACTION:Checks if an admin is logged in
		RESPONSE:Array of projects, current page number and last page number to update requesting page with in case any change in db is made {projects:[Project{}],currentPage:int, endPage:int}*/
	require_once("../../includes/init.php");
	if(isset($_GET['base']) && isset($_GET['offset']) && isset($_GET['status']) && AdminSession::get_instance()->is_logged_in())
	{
		if($_GET['status'] == -5)
			$editors = Editor::find_by_sql("SELECT id,firstname,lastname FROM editors LIMIT ".$_GET['base'].",".$_GET['offset'].";"); 
		else
			$editors = Editor::find_by_sql("SELECT id,firstname,lastname FROM editors WHERE status = ".$_GET['status']." LIMIT ".$_GET['base'].",".$_GET['offset'].";"); 
		if(is_array($editors))
			foreach($editors as $editor)
			{
				$editor->name = $editor->firstname." ".$editor->lastname;
				unset($editor->fields);
			}
		$result['editors']=$editors;
		$result['endPage']=ceil(count($editors) / $_GET['offset']);
		if($result['endPage'] == 0)
			$result['endPage'] = 1;
		$result['currentPage'] = ceil(($_GET['base'] + 1) / $_GET['offset']);
		echo give_json($result);
	}
?>
