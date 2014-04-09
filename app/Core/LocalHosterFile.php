<?php
abstract class LocalHosterFile {

	// System OS
	protected $OS = null;

	protected $filePath = '';

	protected $fileHandle = null;

	public function __construct ( $values = array('filePath'=>'') ) {

		$this->OS = $this->getOS();

		if(isset($values['filePath'])) {
			$this->filePath = $values['filePath'];
		} else {
			$this->filePath = $this->getSystemDefaultFilePath();
		}
	}

	public function getOS() {
		$os = php_uname();

		if( strstr($os, 'MacBook') )
			return "OSX";
		else if( strstr($os, 'Windows') )
			return "Windows";
		 
		return "Unknown";
	}

	public function setFilePath($filePath) {
		$this->filePath = $filePath;
	}

	public function exists() {
		$bool = self::fileExists( $this->filePath );
		if(!$bool)
			$this->filePath = '';

		return $bool;
	}

	public static function fileExists($filePath) {
		return file_exists( $filePath );
	}

	// Find the access of the file
	public function access($access='write') {
		$file = $this->filePath;

		$exists = $this->exists($file);
		$readable = is_readable($file);

		if($exists && $readable){
			switch($access) {
				case 'read':
					return true;
					break;
				case 'write':
					$writeable = is_writable($file);
					if($writeable)
						return true;
				default:
					return false;

			}

			return false;
		}
	}

	public function copyUserFile() {

	}

	public function getFilePath() {
		return $this->filePath;
	}

	private function getSystemDefaultFilePath() {
		return '';
	}

	protected function getFileLineValue($key, $line) {
		if(substr($line, 0, strlen($key)) === $key)
			return trim( preg_replace(array('/' . $key . '/', '/"/'), "", $line) );

		return false;
	}

	protected function getFileContents($fileValues=array()) {
		$data = array();
		$bool = $this->exists();
		if( $bool ) {
			// Open file
			$handle = fopen($this->filePath, 'r');
			if ($handle) {
				// loop through file and create an array from each line of text
				$currentVhost = false;
			  while (!feof($handle)) {
	      	$line = trim(fgets($handle, 4096) );

	      	foreach($fileValues as $key) {
		       	if($keyResult = $this->getFileLineValue($key, $line) )
		       		$data[$key] = $keyResult;
	       	}
			  }
			  fclose($handle);

			  $this->data = $data;
			}
		}

		return $data;
	}

}