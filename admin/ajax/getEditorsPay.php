<?php
	/*	USED ON:Admin list of editors
		ACCEPTS:GET(base and offset for pagination)
		ACTION:Checks if an admin is logged in
		RESPONSE:Array of projects, current page number and last page number to update requesting page with in case any change in db is made {projects:[Project{}],currentPage:int, endPage:int}*/
	require_once("../../includes/init.php");
	if(isset($_GET['base']) && isset($_GET['offset']) && AdminSession::get_instance()->is_logged_in())
	{
		$editors = Editor::find_by_sql("SELECT * FROM (SELECT editors.id, editors.firstname, editors.lastname, COUNT(CASE WHEN projects.type = 0 THEN 1 END) AS count_basic, COUNT(CASE WHEN projects.type = 1 THEN 1 END) AS count_advanced FROM editors JOIN donepics ON donepics.editor = editors.id JOIN pictures ON pictures.id = donepics.original JOIN projects ON projects.id = pictures.project WHERE donepics.chosen = 1 AND donepics.editor NOT IN (SELECT editor FROM edit_payout WHERE project = projects.id) GROUP BY editors.id) s ORDER BY (count_basic + count_advanced) DESC LIMIT ".$_GET['base'].",".$_GET['offset'].";"); 
		if(is_array($editors))
			foreach($editors as $editor)
			{
				$editor->name = $editor->firstname." ".$editor->lastname;
				$editor->total = (EDITOR_BASIC_PRICE * $editor->basic_count) + (EDITOR_ADVANCED_PRICE * $editor->advanced_count);
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
