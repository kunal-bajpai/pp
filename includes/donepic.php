<?php
	class DonePic extends DatabaseObject
	{
		protected static $tableName = 'donepics';
		
		public static function find_for_project($project)
		{
			return self::find_by_sql("SELECT donepics.id id, original, chosen, donepics.editor editor, donepics.prefix, donepics.name name FROM donepics JOIN pictures ON donepics.original = pictures.id WHERE pictures.project = '{$project->id}'");
		}
		
		public static function find_chosen_for_project($project)
		{
			return self::find_by_sql("SELECT donepics.id id, donepics.ext ext, original, chosen, donepics.editor editor, donepics.prefix, donepics.name name FROM donepics JOIN pictures ON donepics.original = pictures.id WHERE pictures.project = '{$project->id}' AND chosen=1");
		}
		
		public static function find_dets_for_project($projId)
		{
			return self::find_by_sql("SELECT ".static::$tableName.".id id,".static::$tableName.".name name,pictures.name original FROM ".static::$tableName." JOIN pictures on ".static::$tableName.".original = pictures.id WHERE pictures.project = '{$projId}' ");
		}
		
		public static function find_chosen_dets_for_project($projId)
		{
			return self::find_by_sql("SELECT ".static::$tableName.".id id,".static::$tableName.".name name,pictures.name original FROM ".static::$tableName." JOIN pictures on ".static::$tableName.".original = pictures.id WHERE pictures.project = '{$projId}' AND chosen=1");
		}
		
		public function wmName()
		{
			$donepic = self::find_by_id($this->id);
			return hashText("wm".$donepic->prefix."Picture".$donepic->id);
		}
		
		public function is_chosen()
		{
			$db = Database::get_instance();
			$res = $db->fetch_array($db->query("SELECT chosen FROM donepics WHERE id = '{$this->id}'"));
			if($res[0][0] == '0')
				return false;
			else
				if($res[0][0] == '1')
					return true;
		}
	}
