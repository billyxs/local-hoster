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
		return;
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
	public function save($data = array()) {
		if(empty($data)) {
			echo 'data is empty';
			return;
		}

		$this->records = $this->getRecords();

		if(!isset($data['id']) || empty($this->records)) {
			$data['id'] = $this->getNextId();
			$this->records[] = $data;
			return $this->saveFile();
		} else {
			$data['id']	= intval($data['id']);
			foreach($this->records as $key=>$record) {
				if($record['id'] == $data['id']) {
					$this->records[$key] = $data;
					return $this->saveFile();
				}
			}
		}

		return false;
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
		$this->records = $this->getRecords();
		foreach($this->records as $key=>$record) {
			if($record['id'] == $id) {
				unset($this->records[$key]);
				$this->saveFile();

				return true;
			}
		}

		// could not delete
		return false;
	}

	public function getRecords() {
		$records = (isset($this->records)) ? $this->records : $this->getFileDataAsArray();
		return $records;
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
		$records = $this->getRecords();

		if(!empty($records)) {
			foreach($records as $key=>$record) {
				if(isset($record['id']) ) {
					$pid = $record['id'];
					$ids[$pid] = $pid;
				}
			}
		}

		$nextId = count( $records );
		while(isset($ids[$nextId])) {
			$nextId++;
		}

		return $nextId;
	}
}