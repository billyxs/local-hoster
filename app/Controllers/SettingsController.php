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
    $this->settings = $this->SettingModel->getUserSettings();


    print_r( $this->SettingModel->getHostsStatus() );
  }

  /**
   * edit - Handles editing of a project, or adding a new project
   *
   */
  public function edit($id) {


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