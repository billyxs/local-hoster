<?php
abstract class LocalHosterFile {

	// System OS
	protected $OS = null;

	protected $filePath = '';

	protected $fileHandle = null;

	public function __construct ( $values = array('filePath'=>'') ) {
		$os = php_uname();
		if( strstr($os, 'MacBook') )
			$this->OS = "OSX";

		if(isset($values['filePath'])) {
			$this->filePath = $values['filePath'];
		} else {
			$this->filePath = $this->getSystemDefaultFilePath();
		}
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

	public function getOS() {
		return $this->OS;
	}

	public function getFilePath() {
		return $this->filePath;
	}

	private function getSystemDefaultFilePath() {
		return '';
	}

}