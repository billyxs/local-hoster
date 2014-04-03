<?php
require_once('LocalHosterFile.class.php');

/**
 * Config Class
 * Configuration settings for Local Hoster
 *
 */
class Config extends LocalHosterFile {

	// Config file name
	const FILENAME ='config.json';

	// projects folder path
	protected $projectsPath = array();

	public $data = array();

	public function __construct($values=array()) {
		$values['filePath'] = $this->getConfigFilePath();
		parent::__construct($values);

		$this->setConfig();
	}

	public function getConfigFilePath () {
		return $_SERVER['DOCUMENT_ROOT'] . '/' . self::FILENAME;
	}

	public function deleteProject($id) {
		foreach($this->data['projects'] as $key=>$project) {
			if($project['id'] == $id) {
				unset( $this->data['projects'][$key] );
			}
		}
	}

	/*
	 * addProject
	 *
	 * Adds an array as a project entry
	 * TODO: Should add some validation
	 *
	 * @return (array) - Current Projects in memory
	 */
	public function addProject ($values=array()) {
		// $Config->data['projects'][] = $_REQUEST['data'];

		if(!isset($_REQUEST['data']['id'])) {
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

	/*
	 * getNextProjectId
	 *
	 * Finds an available id for the project
	 *
	 * @return (int)
	 */
	private function getNextProjectId() {
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

	/*
	 * save
	 *
	 * save the array config data to file as JSON
	 *
	 * @param (array) data
	 * @return (type)
	 */
	public function save($data=array()) {
		$file = $this->getConfigFilePath();
		if(empty($data)) {
			echo 'data is empty';
			return;
		}

		if(!is_writable( $file ) ) {
			echo 'not writable';
			return false;
		}

		// If data hasn't been sent in, save the object's stored data
		if(!empty($data))
			$data = $this->data;
		$fh = file_put_contents($this->getConfigFilePath(), json_encode($data) );

		return $fh;
	}

	/*
	 * setConfig
	 *
	 * Pull data from file to set the object
	 *
	 * @return (array)
	 */
	private function setConfig() {

		if( !$this->exists() ) {
			return;
		}

		$configJSON = file_get_contents($this->filePath);
		$this->data = json_decode($configJSON, true);

		return $this->data;
	}

}