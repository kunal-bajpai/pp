<?php
	class LogProject {
		protected $logFile;
		function __construct($logFile)
		{
			$this->logFile = $logFile;
		}

		public function log_action($action)
		{
			$session=Session::get_instance();
			$user=$session->logged_in_user();
			file_put_contents($this->logFile,strftime("%Y/%d/%m %H:%M:%S",time())." ".$user->username.": ".$action."<br/><br/>\r\n",FILE_APPEND);
		}
		
		public function log_action_anon($action)
		{
			file_put_contents($this->logFile,strftime("%Y/%d/%m %H:%M:%S",time())." : ".$action."<br/><br/>\r\n",FILE_APPEND);
		}

		public function show_logs()
		{
			if(file_exists($this->logFile))
				return file_get_contents($this->logFile);
			else
				return;
		}
	}
