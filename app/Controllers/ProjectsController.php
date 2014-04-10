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

		// $Setup = new SetupModel();
		// if(!$Setup->ready() ) {
		// 	$this->redirect();
		// }
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
		$project = $this->Project->getRecordById($id);

		if(isset($this->data) ) {
			$Project->save($this->data);
		}

		if($project) {
			$this->project = $project;
			$this->tableKeys = array_keys( array_slice($this->project, 0, 1) );
		} else if($id !== 'add') {
			$this->setAlert('Sorry, we could not find your project.');
		}

	}


	/**
	 * delete - Delete project by id
	 *
	 * @param int - project id
	 */
	public function delete($id) {

		$this->Project = new ProjectModel();
		$project = $this->Project->delete($id);


		// Load index values for view
		// TODO: should find a better way to do this, maybe a redirect
		$this->index();
		// Set the view that is needed
		$this->view = 'index';
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

			foreach($this->data as $key=>$value) {
				if($value === "yes") {
					$addProject = $projects[$key];
					$Project->save(array(
							'Name'=>$addProject['ServerName'],
							'DocumentRoot'=>$addProject['DocumentRoot'],
							'ServerName'=>$addProject['ServerName'],
						));
				}
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