<?php
class Vhosts extends LocalHosterFile {
	// File path of system hosts file
	protected $filePath = '';

	protected $templateFilename = 'vhosts.txt';

	protected $fileHandle = null;

	// public function __construct($values=array()) {
	// 	parent::__construct($values);
	// }

	public function addDomainBatch($values = array() ) {
		if(empty($values)) {
			return;
		}

		foreach($values as $key=>$project) {
			$this->addDomain($project);
		}

	}

	public function findAllVhosts() {
		$vhosts = array();

		// Open file
		$handle = fopen($this->filePath, 'r');
		if ($handle) {
			// loop through file and create an array from each line of text
			$currentVhost = false;
		  while (!feof($handle)) {
       $line = trim(fgets($handle, 4096) );

       if(substr($line, 0, 14) === '</VirtualHost>') {
       	if(is_array($currentVhost)) {
       		array_push($vhosts, $currentVhost);
       	}
				$currentVhost = false;
       }

       if(is_array($currentVhost) ) {
				if(substr($line, 0, 12) === 'DocumentRoot') {
					$currentVhost['DocumentRoot'] = trim( preg_replace(array('/DocumentRoot/', '/"/'), "", $line) );
				}

				if(substr($line, 0, 10) === 'ServerName') {
					$currentVhost['ServerName'] = trim( str_replace('ServerName', '', $line) );
				}
       }

       // Start a vhost entry
       if(substr($line, 0, 12) === '<VirtualHost') {
       	$currentVhost = array();
       }
		  }
		  fclose($handle);
		}

		return $vhosts;
	}

	public function addDomain($values=array()) {

		if(!isset($values['domainName'], $values['domainPath']))
			return false;

		if( !$this->exists($this->filePath) )
			return false;

		// Add domain to vhosts file
		$vhostHandle = fopen($this->filePath, 'a');
		if($vhostHandle) {
			$addVhost = $this->buildVhostEntry();
			fwrite($vhostHandle, $addVhost);
			fclose($vhostHandle);
			echo $addVhost;
			return true;
		}

		return false;
	}

	public function buildVhostEntry() {
		$docRoot = $values['domainPath'];
		$serverName = $values['domainName'];
		$vhostEntry = "<VirtualHost *:80>\n"
					. "\tDocumentRoot $docRoot\n"
					. "\tServerName $serverName\n"
					. "</VirtualHost>\n"
					;

		return $vhostEntry;
	}

	private function getSystemDefaultFilePath() {
		switch ($this->OS) {
			case "OSX":
			case "Linux":
				return '/etc/apache2/extra/httpd-vhosts.conf';
				break;
			case "Windows":
				return 'C:/apache/conf/extra/httpd-vhosts.conf';
				break;
			default:
				return '';
				break;
		}
	}


}