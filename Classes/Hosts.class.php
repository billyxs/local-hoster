<?php
require_once('LocalHosterFile.class.php');

class Hosts extends LocalHosterFile {
	// File path of system hosts file
	protected $filePath = '';

	protected $templateFilename = 'hosts.txt';

	protected $defaultIP = '127.0.0.1';

	protected $fileHandle = null;

	public function __construct($values=array()) {
		parent::__construct($values);
	}

	public function addDomainBatch($values = array() ) {
		if(empty($values)) {
			return;
		}

		foreach($values as $key=>$project) {
			$this->addDomain($project);
		}

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
				return '/etc/hosts';
				break;
			default:
				return '';
				break;
		}
	}


}