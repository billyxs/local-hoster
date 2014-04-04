<?php
/**
 * Project Controller Class
 *
 * Manage the CRUD of the Local Hoster Projects
 */
class ProjectsController extends Controller {
	public $models = array('Project');

	/**
	 * index - Projects List with access to edit and delete each project
	 *
	 */
	public function index() {
		$model = new ProjectModel();
		// $projects = $model->findAll();
		// print_r($projects);
		// $Config = new Config();

		// $this->projects = $Config->data['projects'];
		// $this->tableKeys = array_keys( array_slice($this->projects, 0, 1) );
		// $this->projectPaths = $Config->data['projects-path'];

	}

	/**
	 * edit - Handles editing of a project, or adding a new project
	 *
	 */
	public function edit($id) {
		$this->id = is_numeric( $id ) ? intval($id) : null;

		$Config = new Config();

		$projects = $Config->data['projects'];
		$this->tableKeys = array_keys( array_slice($projects, 0, 1) );
		$this->projectPaths = $Config->data['projects-path'];

		$this->config = $Config->data;

		// save data
		if(isset($this->data) ) {
			$Config->addProject($this->data);
			$Config->save($Config->data);
		}

		if( array_key_exists($this->id, $projects) ) {
			$this->project = $projects[$id];
		}

		$this->projects = $projects;
	}


	/**
	 * delete - Delete project by id
	 *
	 * @param int - project id
	 */
	public function delete($id) {

		$Config = new Config();
		$Config->deleteProject( $id );
		$Config->save($Config->data);

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

		$Hosts = new Hosts();
		$hosts = $Hosts->findAllHosts();

		$Vhosts = new Vhosts();
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
			$Config = new Config();

			foreach($this->data as $key=>$value) {
				if($value === "yes") {
					$addProject = $projects[$key];
					$Config->addProject(array(
							'Name'=>$addProject['ServerName'],
							'DocumentRoot'=>$addProject['DocumentRoot'],
							'ServerName'=>$addProject['ServerName'],
						));
				}
			}

			$Config->save($Config->data);
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