<?php 
	/*
	 * This class is for creating LogFiles easier.
	 */
	class LogFile {
		
		private $logData;
		private $parentfile;
		
		function __construct($file) {
			$this->logData = "";
			$this->parentfile = $file;
		}
		
		public function addMsg($string) {
			$time = date("<H:i:s> ", time());
			$this->logData = @$this->logData.@$time.@$string."\n";
		}
		
		public function addWarning($string) {
			$this->addMsg("WARNING: ".@$string);
		}
		
		public function addError($string) {
			$this->addMsg("ERROR: ".@$string);
		}
		
		public function save() {
			if (!$this->logData == "") {
				$time = date("Y.m.d-H.i.s", time());
				$filename = $time."_".@$this->parentfile.".log";
				$logFile = fopen("./logs/".$filename, "w");
				fwrite($logFile, @$this->logData);
				fclose($logFile);
			}
		}
		
	}
	
	$log = new LogFile('ajf');
 ?>