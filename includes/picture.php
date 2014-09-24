<?php
	class Picture extends DatabaseObject {
		protected static $tableName = 'pictures';
		
		public static function find_for_project($project)
		{
			return self::find_by_sql("SELECT * FROM ".static::$tableName." WHERE project = '{$project->id}'");
		}
		
		public static function find_dets_for_project($projId)
		{
			return self::find_by_sql("SELECT name,instructions FROM ".static::$tableName." WHERE project = '{$projId}'");
		}
		
		public static function find_chosen_dets_for_project($projId)
		{
			return self::find_by_sql("SELECT ".self::$tableName.".name,instructions FROM ".static::$tableName." JOIN donepics ON donepics.original = ".self::$tableName.".id WHERE project = '{$projId}' AND chosen=1");
		}
	}
