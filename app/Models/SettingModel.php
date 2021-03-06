<?php
class SettingModel extends ModelJson {

	public function getUserSettings(){
    $records = $this->records;
    // print_r($records);
		return (!empty($records)) ? $records[0] : null;
	}



  public function getTemplatePath($filename) {
    return STORAGE . $filename . '.template';
  }

  public function getTemplateFile($name) {
    return @file_get_contents( $this->getTemplatePath($name) );
  }


  public function checkStatus() {
    $settingStatus = $this->getStorageStatus('settings');
    if($settingStatus['status'] !== 'good')
      return false;

    $projectStatus = $this->getStorageStatus('projects');
    if($projectStatus['status'] !== 'good')
      return false;

    $vhostStatus = $this->getVhostsStatus();
    if($vhostStatus['status'] !== 'good')
      return false;

    $hostStatus = $this->getHostsStatus();
    if($hostStatus['status'] !== 'good')
      return false;


    return true;

  }


  public function getHostsStatus() {
    return $this->getSettingFileStatus('hosts-path');
  }

  public function getVhostsStatus() {
    return $this->getSettingFileStatus('vhosts-path');
  }

  public function getStorageStatus($modelName) {
    $storagePath = STORAGE . $modelName . '.json';
    return $this->getFileStatus($storagePath);
  }

  public function getProjectsStatus() {
    return $this->getFileStatus('projects-path');
  }

  public function getSettingFileStatus($filename="") {
    $settings = $this->getUserSettings();

    $filepath = @$settings[$filename];
    $result = $this->getFileStatus($filepath);

    return $result;
  }


  public function getFileStatus($filepath='') {
    $result = array(
      'status'=>'fix',
      'exists'=>null,
      'writable'=>null,
      'message'=>'File has not been defined'
    );

    if(strlen( $filepath ) > 1) {
      if(file_exists($filepath) ) {
        $result['exists'] = true;
      } else {
        $result['exists'] = false;
        $result['message'] = 'File does not exist. Current set filepath: ' . $filepath;

      }

      if(is_writable($filepath) ) {
        $result['writable'] = true;
        $result['status'] = 'good';
        unset($result['message']);
      } else if($result['exists']) {
        $result['writable'] = false;
        $result['message'] = 'File is not writable. Current set filepath: ' . $filepath;
      }
    }

    return $result;
  }

}