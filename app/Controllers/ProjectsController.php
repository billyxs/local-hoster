<?php
/**
 * Project Controller Class
 *
 * Manage the CRUD of the Local Hoster Projects
 */
class ProjectsController extends Controller {
	public $models = array('Project');

	public function before() {
		parent::before();

		// If settings are not ready, redirect to setup settings
		$this->SettingModel = new SettingModel();
		echo $this->SettingModel->checkStatus();
		if(!$this->SettingModel->checkStatus() )
			$this->redirect(array('controller'=>'settings', 'action'=>'index'));
	}

	/**
	 * index - Projects List with access to edit and delete each project
	 *
	 */
	public function index() {
		$this->ProjectModel = new ProjectModel();
		$this->projects = $this->ProjectModel->records;

		$this->SettingModel = new SettingModel();
		$this->settings = $this->SettingModel->getUserSettings();

		$this->tableKeys = array_keys( array_slice($this->projects, 0, 1) );
	}

	/**
	 * edit - Handles editing of a project, or adding a new project
	 *
	 */
	public function edit($id) {
		$this->SettingModel = new SettingModel();
		$this->settings = $this->SettingModel->getUserSettings();
		// print_r($this->settings);

		$this->Project = new ProjectModel();
		if(isset($this->data) ) {
			$saved = $this->Project->save($this->data);
			if($saved ) {
				$this->Project->sync();
				$this->alertSuccess("Project saved");
			} else {
				$this->alertError("There was an error. Your project did not save.");
			}
		}

		$project = $this->Project->getRecordById($id);

		if($project) {
			$this->project = $project;
			$this->tableKeys = array_keys( array_slice($this->project, 0, 1) );
		} else if($id !== 'add') {
			$this->alertError('Sorry, we could not find your project.');
		}

	}


	/**
	 * delete - Delete project by id
	 *
	 * @param int - project id
	 */
	public function delete($id=null) {

		if(is_numeric($id)) {
			$this->Project = new ProjectModel();
			if($this->Project->delete($id) ) {
				$this->Project->sync();
				$this->alertSuccess("Deleted project");
			} else {
				$this->alertError("Sorry, we could not delete your project. Please check your settings");
			}
		}

		$this->redirect(array('controller'=>'projects', 'action'=>'index') );
	}


	/**
	 * import - Import existing projects for user
	 *
	 * Loops through hosts and vhosts files to to find existing
	 * projects for user to allow them to import
	 *
	 */
	public function import() {

		$this->SettingModel = new SettingModel();
		$settings = $this->SettingModel->getUserSettings();

		$Hosts = new Hosts(array('filePath'=>$settings['hosts-path']));
		$hosts = $Hosts->findAllHosts();

		$Vhosts = new Vhosts(array('filePath'=>$settings['vhosts-path']));
		$vhosts = $Vhosts->findAllVhosts();

		$projects = array();
		foreach($vhosts as $key=>$values) {
			if(isset($values['ServerName']) ) {

				$ServerName = $values['ServerName'];

				if( isset($hosts[$ServerName] ) ) {
					$vhosts[$key]['ip'] = $hosts[$ServerName];
					$projects[$ServerName] = $vhosts[$key];
				}
			}
		}

		if(isset($this->data) ) {
			// $Config = new Config();
			$Project = new ProjectModel();
			$imported = false;
			foreach($this->data as $key=>$value) {
				if($value === "yes") {
					$imported = true;

					$addProject = $projects[$key];
					$Project->save(array(
							'Group'=>'',
							'Name'=>$addProject['ServerName'],
							'DocumentRoot'=>$addProject['DocumentRoot'],
							'ServerName'=>$addProject['ServerName'],
						));
				}
			}

			$Project->sync();

			if($imported) {
				$this->alertSuccess('Imported projects');
			} else {
				$this->alertError('No projects were imported');
			}
		}

		$this->projects = $projects;
	}


	/**
	 * settings - Manage user settings for paths to hosts, vhosts, and projects
	 *
	 */
	public function settings() {
		$Settings = new Settings();
		$Settings->load();

		if(isset($this->data) ) {
			$data = $_REQUEST['data'];
			foreach($data as $key=>$val) {
				if($key === 'ProjectPaths')
					$val = implode(',', $val);

				$Settings->data[$key] = $val;
			}

			$Settings->save();
		}
	}
}