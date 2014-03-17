<?php
require_once('LocalHosterFile.class.php');

class Vhosts extends LocalHosterFile {
	// File path of system hosts file
	protected $filePath = '';

	protected $templateFilename = 'vhosts.txt';

	protected $fileHandle = null;

	public function addDomainBatch($values = array() ) {
		if(empty($values)) {
			return;
		}

		foreach($values as $key=>$project) {
			$this->addDomain($project);
		}

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
				return '/etc/apache2/extra/httpd-vhosts.conf';
				break;
			default:
				return '';
				break;
		}
	}


}