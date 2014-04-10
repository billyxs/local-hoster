<?php
/**
 * Project Controller Class
 *
 * Manage the CRUD of the Local Hoster Projects
 */
class SettingsController extends Controller {

  public function before() {
    parent::before();
  }

  /**
   * index - Projects List with access to edit and delete each project
   *
   */
  public function index() {
    $this->SettingModel = new SettingModel();

    if(isset($this->data) ) {
      $this->data['id'] = 0;
      $this->SettingModel->save($this->data);
    }

    $this->settings = $this->SettingModel->getUserSettings();
    $this->hostsStatus = $this->SettingModel->getHostsStatus();
    $this->vhostsStatus = $this->SettingModel->getVhostsStatus();
    $this->projectPaths = (is_array($this->settings['projects-path'] ) ) ? $this->settings['projects-path'] : array('/Projects');
  }

  /**
   * edit - Handles editing of a project, or adding a new project
   *
   */
  public function edit($id) {
    $this->SettingModel = new SettingModel();
    $this->settings = $this->SettingModel->getUserSettings();

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

    $Config = new Config();
    $Config->deleteProject( $id );
    $Config->save($Config->data);

    // Load index values for view
    // TODO: should find a better way to do this, maybe a redirect
    $this->index();
    // Set the view that is needed
    $this->view = 'index';
  }

}