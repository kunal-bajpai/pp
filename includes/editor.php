<?php
	class Editor extends User {
		protected static $tableName = 'editors',$usernameField='username',$passwordField='password';
		const NOT_WORKED_ON = -1;
		const ONGOING = 0;
		const DROPPED = 1;
		const FAILED = 2;
		const COMPLETED = 3;
		const REMOVED = 4;
		const CANCELLED = 5;
		const PENDING = -2;
		const APPROVED = -4;
		const DISAPPROVED = -3;
		
		public function get_status($project)
		{
			$db = Database::get_instance();
			$status = $db->fetch_array($db->query("SELECT status FROM work WHERE editor = '{$this->id}' AND project = '{$project->id}'"));
			if(!isset($status[0][0]))
				return -1;
			else
				return $status[0][0];
		}
		
		public function drop_project($project)
		{
			$db = Database::get_instance();
			$db->query("UPDATE work SET status = 2, end = ".time()." WHERE editor = {$this->id} AND project = {$project->id}");
		}
		
		public static function find_for($project)
		{
			$db = Database::get_instance();
			$id = $db->fetch_array($db->query("SELECT editor FROM work WHERE project = {$project->id} AND status = 0"));
			if(!isset($id[0][0]))
				return NULL;
			else
				return self::find_by_id($id[0][0]);
		}
	}
