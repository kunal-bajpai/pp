<?php
	/*	USED ON:List of new projects for editors
		ACCEPTS:GET(type of project ie basic or advanced, base and offset for pagination)
		ACTION:Checks if an editor is logged in
		RESPONSE:Array of projects, current page number and last page number to update requesting page with in case any change in db is made {projects:[Project{}],currentPage:int, endPage:int}*/
	require_once("../../includes/init.php");
	if(isset($_GET['type']) && isset($_GET['base']) && isset($_GET['offset']) && AdminSession::get_instance()->is_logged_in())
	{
		switch($_GET['type'])
		{
			case 0:
				$projects = Project::find_by_sql("SELECT id, name, type, submittime FROM projects WHERE status = '".Project::CONFIRMED."' ORDER BY id DESC LIMIT {$_GET['base']},{$_GET['offset']}");
				if(is_array($projects))
					foreach($projects as $project)
					{
						$project->submittime = strftime('%d-%m-%Y %H:%M',$project->submittime);
						if(!$project->is_free()) 
							$editor = Editor::find_for($project); 
						$project->editor = (!isset($editor))?"none":"<a href='editorProfile.php?id=".$editor->id."'>".$editor->username."</a>";
						$project->type = ($project->type == 0)?"Basic":"Advanced";
						unset($project->log);
						unset($project->fields);
					}
				$db = Database::get_instance();
				$count = $db->num_rows($db->query("SELECT id FROM projects WHERE status = ".Project::CONFIRMED));
				break;
			case 1:
				$projects = Project::find_by_sql("SELECT id, name, type, submittime FROM projects WHERE status = '".Project::UNCONFIRMED."' ORDER BY id DESC LIMIT {$_GET['base']},{$_GET['offset']}");
				if(is_array($projects))
					foreach($projects as $project)
					{
						$project->type = ($project->type == 0)?"Basic":"Advanced";
						unset($project->fields);
						unset($project->log);
					}
				$db = Database::get_instance();
				$count = $db->num_rows($db->query("SELECT id FROM projects WHERE status = ".Project::UNCONFIRMED));
				break;
			case 2:
				$projects = Project::find_by_sql("SELECT projects.id id, projects.name name,projects.endtime completetime, COUNT(*) total FROM projects JOIN pictures ON pictures.project = projects.id JOIN donepics ON donepics.original = pictures.id WHERE projects.status = '".Project::COMPLETED."' AND donepics.chosen = 1 GROUP BY projects.id ORDER BY id DESC LIMIT {$_GET['base']},{$_GET['offset']}");
				if(is_array($projects))
					foreach($projects as $project)
					{
						unset($project->fields);
						unset($project->log);
					}
				$db = Database::get_instance();
				$count = $db->num_rows($db->query("SELECT id FROM projects WHERE status = ".Project::COMPLETED));
				break;
			case 3:
				$projects = Project::find_by_sql("SELECT id, name, type, submittime FROM projects WHERE status = '".Project::CANCELLED."' ORDER BY id DESC LIMIT {$_GET['base']},{$_GET['offset']}");
				if(is_array($projects))
					foreach($projects as $project)
					{
						unset($project->fields);
						unset($project->log);
					}
				$db = Database::get_instance();
				$count = $db->num_rows($db->query("SELECT id FROM projects WHERE status = ".Project::CANCELLED));
				break;
		}
		$result['projects']=$projects;
		$result['table'] = $_GET['type'];
		$result['endPage']=ceil($count / $_GET['offset']);
		if($result['endPage'] == 0)
			$result['endPage'] = 1;
		$result['currentPage'] = ceil(($_GET['base'] + 1) / $_GET['offset']);
		echo give_json($result);
	}
?>
