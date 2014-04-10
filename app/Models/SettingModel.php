<?php
class SettingModel extends ModelJson {

	public function getUserSettings(){
    $records = $this->records;
    // print_r($records);
		return (!empty($records)) ? $records[0] : null;
	}

  public function getHostsStatus() {
    return $this->getFileStatus('hosts-path');
  }

  public function getVhostsStatus() {
    return $this->getFileStatus('vhosts-path');
  }

  public function getProjectsStatus() {
    return $this->getFileStatus('projects-path');
  }

  public function getFileStatus($filename="") {
    $result = array(
      'status'=>'fix',
      'exists'=>null,
      'writable'=>null,
      'message'=>'File has not been defined'
    );

    $settings = $this->getUserSettings();

    $filePath = @$settings[$filename];
    if(isset($settings['hosts-path']) && strlen( $filePath ) > 1) {
      if(file_exists($filePath) ) {
        $result['exists'] = true;
      } else {
        $result['exists'] = false;
        $result['message'] = 'File does not exist. Please Current set filepath: ' . $filePath;

      }

      if(is_writable($filePath) ) {
        $result['writable'] = true;
        $result['status'] = 'good';
        unset($result['message']);
      } else if($result['exists']) {
        $result['writable'] = false;
        $result['message'] = 'File is not writable. Current set filepath: ' . $filePath;
      }
    }

    return $result;
  }

}