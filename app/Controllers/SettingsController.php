<?php
/**
 * Project Controller Class
 *
 * Manage the CRUD of the Local Hoster Projects
 */
class SettingsController extends Controller {

  public function before() {
    parent::before();

    if($this->action !== 'index') {
      // If settings are not ready, redirect to setup settings
      $this->SettingModel = new SettingModel();
      if(!$this->SettingModel->checkStatus() )
        $this->redirect(array('controller'=>'settings', 'action'=>'index'));
    }
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

    $this->settingStorageStatus = $this->SettingModel->getStorageStatus('settings');
    if(!$this->settingStorageStatus['exists']) {
      $Setting = new SettingModel();
      $this->settingStorageStatus = $this->SettingModel->getStorageStatus('settings');
    }


    $this->projectStorageStatus = $this->SettingModel->getStorageStatus('projects');
    if(!$this->projectStorageStatus['exists']) {
      $Project = new ProjectModel();
      $this->projectStorageStatus = $this->SettingModel->getStorageStatus('projects');
    }

    $this->settings = $this->SettingModel->getUserSettings();
    $this->hostsStatus = $this->SettingModel->getHostsStatus();
    $this->vhostsStatus = $this->SettingModel->getVhostsStatus();

    // print_r($this->projectStorageStatus);
    // print_r($this->settingStorageStatus);

    $this->projectPaths = (is_array($this->settings['projects-path'] ) ) ? $this->settings['projects-path'] : array('/Projects');
  }

  /**
   * edit - Handles editing of a project, or adding a new project
   *
   */
  public function edit() {
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

  public function setupHosts() {
    $this->setupFile('hosts');
  }

  public function setupVhosts() {
    $this->setupFile('vhosts');
  }

  public function setupFile($type) {
    $displayType = ucwords($type);

    if(isset($this->data)) {
      $contents = str_ireplace("\x0D", "", $this->data['FileTemplate']);
      $result = @file_put_contents(STORAGE . $type . '.template' , $contents);

      if($result)
        $this->alertSuccess($displayType . ' file has been saved');
      else
        $this->alertError($displayType . ' could not be saved');
    }

    $this->SettingModel = new SettingModel();
    $this->settings = $this->SettingModel->getUserSettings();
    $fileKey = $type . '-path';
    $this->hostsFile = file_get_contents($this->settings[$fileKey]);

    $this->template = $this->SettingModel->getTemplateFile($type);

    $this->fileType = $displayType;
    $this->view = "setupFile";
  }


}