<?php
class Settings extends LocalHosterFile {

	// Config file name
	const FILENAME = '.lh-settings';

	public function __construct($values=array()) {
		parent::__construct($values);
		$this->filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . self::FILENAME;
	}

	public function load() {
		$fileValues = array('HostsPath', 'VirtualHostsPath', 'ProjectPaths');
		$data = $this->getFileContents($fileValues);
		// $data['ProjectPaths'] = explode(',', $data['ProjectPaths']);

		$this->data = $data;

		return $data;
	}

	public function saveField($field, $value) {
		$bool = $this->exists();
		if( $bool ) {
			// Open file
			$handle = fopen($this->filePath, 'w+');
			if ($handle) {
				// loop through file and create an array from each line of text
				$currentVhost = false;
				$lines = array();
			  while (!feof($handle)) {
	      	$line = trim(fgets($handle, 4096) );

	       	if($keyResult = $this->getFileLineValue($key, $line) ) {
	       		$line = $field . ' ' . $value;
	       	}

	       	$lines[] = $line;
			  }

			  foreach($lines as $entry) {
			  	fwrite($handle, $entry);
			  }
			  fclose($handle);

			  $this->data = $data;
			}
		}
	}

	public function save() {
		$file = $this->filePath;

		if(!is_writable( $file ) ) {
			echo 'not writable';
			return false;
		}

		$fileData = "# Local Hoster Settings\n";
		foreach($this->data as $key=>$val) {
			$fileData .= $key . " " . $val . "\n";
		}

		$fh = file_put_contents($file, $fileData);

	}

}