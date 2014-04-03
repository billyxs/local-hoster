<?php
class ProjectsController extends Controller {

	public function index() {
		$Config = new Config();

		$this->projects = $Config->data['projects'];
		$this->tableKeys = array_keys( array_slice($this->projects, 0, 1) );
		$this->projectPaths = $Config->data['projects-path'];
	}

	public function edit($id) {
		$this->id = is_numeric( $id ) ? intval($id) : null;

		$Config = new Config();

		$projects = $Config->data['projects'];
		$this->tableKeys = array_keys( array_slice($projects, 0, 1) );
		$this->projectPaths = $Config->data['projects-path'];

		// save data
		if(isset($this->data) ) {
			$Config->addProject($_REQUEST['data']);
			$Config->save($Config->data);
		}

		$this->buttonText = "Add";
		if( is_int($id) && array_key_exists($id, $projects) ) {
			$this->project = $projects[$id];
			$this->buttonText = "Edit";
		}

		$this->projects = $projects;
	}

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