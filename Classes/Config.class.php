<?php
require_once('LocalHosterFile.class.php');

/**
 * Config Class
 * Configuration settings for Local Hoster
 *
 */
class Config extends LocalHosterFile {

	// Config file name
	const CONFIG_FILE_PATH ='config.json';

	// projects folder path
	protected $projectsPath = array();

	protected $data = array();

	public function getConfigFile() {
		$this->setConfig();
	}

	public function getConfigFilePath () {
		return $_SERVER['DOCUMENT_ROOT'] . '/' . self::CONFIG_FILE_PATH;
	}

	public function save($data=array()) {
		$file = $this->getConfigFilePath();
		if(!is_writable( $file ) ) {
			echo 'not writable';
			return false;
		}
		echo 'good';

		$fh = file_put_contents($this->getConfigFilePath(), json_encode($data) );

	}

	private function setConfig() {
		if( !$this->exists() ) {
			return;
		}

		$configJSON = file_get_contents($this->filePath);
		$this->data = json_decode($configJSON, true);

		return $this->data;
	}

}