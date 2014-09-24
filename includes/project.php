<?php
	class Project extends DatabaseObject
	{
		protected static $tableName = 'projects';
		public $log;
		const CONFIRMED = 1, UNCONFIRMED = 0, CANCELLED = 2, COMPLETED = 3;
		
		public static function find_by_sql($query)
		{
			$objs = parent::find_by_sql($query);
			if(is_array($objs))
				foreach($objs as $obj)
					$obj->log = new logProject(SITE_ROOT."/pictures/projects/project".$obj->id."/log");
			return $objs;
		}
		
		public function save()
		{
			parent::save();
			if(!isset($this->log))
				$this->log = new logProject(SITE_ROOT."/pictures/projects/project".$this->id."/log");
		}
		
		public function assign_to($editor)
		{
			$db = Database::get_instance();
			$db->query("INSERT INTO work (editor,project,status,start) VALUES ('{$editor->id}','{$this->id}',0,".time().")");
		}
		
		public function is_free()
		{
			$db = Database::get_instance();
			$res = $db->fetch_array($db->query("SELECT * FROM work WHERE project = '{$this->id}' AND status = 0"));
			return !isset($res);
		}
		
		public static function find_free_confirmed($type, $base, $offset)
		{
			return self::find_by_sql("SELECT projects.id id, projects.name, projects.submittime, customers.email, t1.count total FROM projects JOIN customers ON customers.id = projects.customer JOIN (SELECT COUNT(*) count,project FROM pictures GROUP BY project) t1 ON t1.project = projects.id WHERE status = 1 AND projects.id NOT IN (SELECT DISTINCT project FROM work WHERE status=0) AND projects.type = '{$type}' ORDER BY projects.submittime ASC LIMIT {$base},{$offset};");
		}
		
		public static function free_confirmed_count($type)
		{
			$db = Database::get_instance();
			$num = $db->fetch_array($db->query("SELECT COUNT(*) FROM (SELECT projects.id id FROM projects WHERE status = 1 AND projects.id NOT IN (SELECT DISTINCT project FROM work WHERE status=0) AND projects.type = '{$type}') t1;"));
			return $num[0][0];
		}
		
		public static function find_for_status($editor,$status)
		{
			return self::find_by_sql("SELECT projects.id id, projects.name, projects.type, projects.submittime, customers.email, work.start, work.end FROM work JOIN projects ON projects.id = work.project JOIN customers ON customers.id = projects.customer WHERE work.status = '{$status}' AND editor = '{$editor->id}' ORDER BY work.start DESC");
		}
		
		public static function find_ongoing_for_editor($editor)
		{
			return self::find_by_sql("SELECT projects.id id, projects.name, projects.type, projects.submittime, customers.email, work.start FROM work JOIN projects ON projects.id = work.project JOIN customers ON customers.id = projects.customer WHERE work.status = '0' AND editor = '{$editor->id}' ORDER BY submittime ASC");
		}
		
		public function total_pics_count()
		{
			$db = Database::get_instance();
			$num = $db->fetch_array($db->query("SELECT COUNT(*) FROM pictures WHERE project = '{$this->id}'"));
			return $num[0][0];
		}
		
		public function done_pics_count()
		{
			$db = Database::get_instance();
			$num = $db->fetch_array($db->query("SELECT COUNT(*) FROM (SELECT donepics.id FROM donepics JOIN pictures ON donepics.original = pictures.id WHERE pictures.project = '{$this->id}') t1"));
			return $num[0][0];
		}
		
		public function done_pics_by_count($editor)
		{
			$db = Database::get_instance();
			$num = $db->fetch_array($db->query("SELECT COUNT(*) FROM (SELECT donepics.id, donepics.editor FROM donepics JOIN pictures ON donepics.original = pictures.id WHERE pictures.project = '{$this->id}') t1 WHERE editor = '{$editor->id}'"));
			return $num[0][0];
		}
		
		public function chosen_pics_count()
		{
			$db = Database::get_instance();
			$num = $db->fetch_array($db->query("SELECT COUNT(*) FROM (SELECT donepics.id, donepics.chosen FROM donepics JOIN pictures ON donepics.original = pictures.id WHERE pictures.project = '{$this->id}') t1 WHERE t1.chosen = '1'"));
			return $num[0][0];
		}
		
		public function chosen_pics_by_count($editor)
		{
			$db = Database::get_instance();
			$num = $db->fetch_array($db->query("SELECT COUNT(*) FROM (SELECT donepics.id, donepics.chosen, donepics.editor FROM donepics JOIN pictures ON donepics.original = pictures.id WHERE pictures.project = '{$this->id}') t1 WHERE editor = '{$editor->id}' AND t1.chosen = '1'"));
			return $num[0][0];
		}
	}