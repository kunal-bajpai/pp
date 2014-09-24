<?php
	/*	USED ON:List of new projects for editors
		ACCEPTS:GET(type of project ie basic or advanced, base and offset for pagination)
		ACTION:Checks if an editor is logged in
		RESPONSE:Array of projects, current page number and last page number to update requesting page with in case any change in db is made {projects:[Project{}],currentPage:int, endPage:int}*/
	require_once("../includes/init.php");
	if(isset($_GET['type']) && isset($_GET['base']) && isset($_GET['offset']) && Session::get_instance()->is_logged_in())
	{
		$projects = Project::find_free_confirmed($_GET['type'], $_GET['base'], $_GET['offset']);
		if(is_array($projects))
			foreach($projects as $project)
			{
				unset($project->fields);
				$project->start = strftime('%d-%m-%Y %H:%M',$project->submittime);
				$project->end = strftime('%d-%m-%Y %H:%M',$project->submittime+(3600*24));
			}
		$result['projects']=$projects;
		$result['endPage']=ceil(Project::free_confirmed_count($_GET['type']) / $_GET['offset']);
		if($result['endPage'] == 0)
			$result['endPage'] = 1;
		$result['currentPage'] = ceil(($_GET['base'] + 1) / $_GET['offset']);
		echo give_json($result);
	}
?>
