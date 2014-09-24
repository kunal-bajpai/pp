<?php
	class Payout extends DatabaseObject {
		protected static $tableName = 'payouts';
		
		public function addTo($editor,$projectIds)
		{
			$db = Database::get_instance();
			if(is_array($projectIds))
			{
				$values = '';
				foreach($projectIds as $projectId)
					$values.=' ('.$editor->id.','.$this->id.','.$projectId.') ';
				$db->query("INSERT INTO edit_payout (editor,payout,project) VALUES".$values.";");
			}
		}
	}
