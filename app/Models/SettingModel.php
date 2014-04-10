<?php
class SettingModel extends ModelJson {

	public function getUserSettings(){
    $records = $this->records;
    // print_r($records);
		return (!empty($records)) ? $records[0] : null;
	}

  public function getHostsStatus() {
    $result = array(
      'status'=>'fix',
      'exists'=>null,
      'writable'=>null,
      'message'=>'Hosts file has not been defined'
    );

    $settings = $this->getUserSettings();

    $hostsPath = $settings['hosts-path'];
    if(isset($settings['host-path']) && strlen( $hostsPath ) > 1) {
      if(!file_exists($hostsPath) ) {
        $result['exists'] = false;
        $result['message'] = 'Hosts file does not exist. Current set filepath: ' . $hostsPath;
      } else {
        $result['exists'] = true;
      }

      if(!is_writable($hostsPath) ) {
        $result['writable'] = false;
        $result['message'] = 'Hosts file is not writable. Current set filepath: ' . $hostsPath;
      } else {
        $result['writable'] = true;
      }
    }

    return $result;
  }

}