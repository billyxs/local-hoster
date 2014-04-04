<?php
class ModelJson extends Model {

	public function __construct() {
		parent::__construct();
		$this->records = $this->getFileDataAsArray();
	}

	public function getStorageFilename() {
		return strtolower( str_replace('Model', '', $this->name) ) . 's.json';
	}

	public function getStoragePath(){
		return STORAGE . $this->getStorageFilename();
	}

	public function getFileData() {
		$file_data = @file_get_contents( $this->getStoragePath() );
		if(!$file_data) {
			return $this->initializeStorage();
		} else {
			return $file_data;
		}
	}

	public function getFileDataAsArray() {
		return json_decode($this->getFileData(), true );
	}

	public function initializeStorage() {
		$this->records = array();
		$this->saveFile();
		return $json;
	}

	public function saveFile() {
		$fh = fopen($this->getStoragePath(), 'w+');
		$json = json_encode($this->records);
		if($fh) {
			fwrite($fh, $json);
			fclose($fh);
		}
		return $fh;
	}

	public function getRecordById($id) {
		if(is_numeric($id)) {
			$id = intval($id);
			foreach($this->records as $key=>$values) {
				if($values['id'] == $id) {
					return $values;
				}
			}
		}

		return false;
	}

	/*
	 * save
	 *
	 * save the array config data to file as JSON
	 *
	 * @param (array) data
	 * @return (type)
	 */
	public function save() {
		// $file = $this->getConfigFilePath();
		// if(empty($data)) {
		// 	echo 'data is empty';
		// 	return;
		// }

		// if(!is_writable( $file ) ) {
		// 	echo 'not writable';
		// 	return false;
		// }

		// // If data hasn't been sent in, save the object's stored data
		// if(!empty($data))
		// 	$data = $this->data;
		// $fh = file_put_contents($this->getConfigFilePath(), json_encode($data) );

		// return $fh;
	}

	/*
	 * add
	 *
	 * Adds an array as a project entry
	 * TODO: Should add some validation
	 *
	 * @return (array) - Current Projects in memory
	 */
	public function add ($values=array()) {
		// $Config->data['projects'][] = $_REQUEST['data'];

		if(!isset($values['id'])) {
			$values['id'] = $this->getNextProjectId();
			$this->data['projects'][] = $values;
		} else {
			$values['id']	= intval($values['id']);
			foreach($this->data['projects'] as $key=>$project) {
				if($project['id'] == $values['id']) {
					$this->data['projects'][$key] = $values;
				}
			}
		}

		return $this->data['projects'];
	}

	public function delete($id) {
		foreach($this->data['projects'] as $key=>$project) {
			if($project['id'] == $id) {
				unset( $this->data['projects'][$key] );
			}
		}
	}

	/*
	 * getNextId
	 *
	 * Finds an available id for model
	 *
	 * @return (int)
	 */
	private function getNextId() {
		$ids = array();
		foreach($this->data['projects'] as $key=>$project) {
			if(isset($project['id']) ) {
				$pid = $project['id'];
				$ids[$pid] = $pid;
			}
		}
		$nextId = count( $this->data['projects'] );
		while($ids[$nextId]) {
			$nextId++;
		}
		echo 'next id ' . $nextId;
		return $nextId;
	}
}