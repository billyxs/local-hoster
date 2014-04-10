<?php
class Hosts extends LocalHosterFile {
	// File path of system hosts file

	protected $templateFilename = 'hosts.txt';

	protected $defaultIP = '127.0.0.1';

	protected $fileHandle = null;

	public function __construct($values=array()) {
		parent::__construct($values);
		$this->filePath = $this->getSystemDefaultFilePath();
	}

	public function addDomainBatch($values = array() ) {
		if(empty($values)) {
			return;
		}

		foreach($values as $key=>$project) {
			$this->addDomain($project);
		}

	}

	public function findAllHosts() {
		$hosts = array();

		// Open file
		$handle = fopen($this->filePath, 'r');
		if ($handle) {
			// loop through file and create an array from each line of text
		  while (!feof($handle)) {
		       $lines[] = fgets($handle, 4096);
		  }
		  fclose($handle);
		}

		// loop through the lines of text in file
		foreach($lines as $key=>$val) {
			// explode the text on the tab separation
			$line = preg_split("/[\s,]+/", $val);
			$line = array_diff($line, array(""));

			if(is_array($line) && !empty($line)) {
				if(strpos($line[0], '127.0.0.1') === false ) {
				} else {
					$hosts[ $line[1] ] = $line[0];
				}
			}
		}

		return $hosts;

	}

	public function addDomain($values=array()) {

		if(!isset($values['domainName']))
			return false;

		if( !$this->exists($this->filePath) )
			return false;

		$values['ip'] = (!isset($values['ip'])) ? $this->defaultIP : $values['ip'];

		// Add new domain to hosts file
		$hostHandle = fopen($this->filePath, 'a');
		if($hostHandle) {
			$addHost = $this->buildHostEntry($values);
			fwrite($hostHandle, $addHost);
			fclose($hostHandle);
			return true;
		}

		return false;
	}

	public function buildHostEntry($values=array()) {
		$addHost = $ip . "\t" . $values['domainName'] . "\n";
	}

	private function getSystemDefaultFilePath() {
		switch ($this->OS) {
			case "OSX":
			case "Linux":
				return '/etc/hosts';
				break;
			case "Windows":
				return 'C:/Windows/System32/drivers/etc/hosts';
				break;
			default:
				return '';
				break;
		}
	}


}