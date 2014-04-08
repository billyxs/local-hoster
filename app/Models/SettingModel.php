<?php
class SettingModel extends ModelJson {

	public function getUserSettings(){
    $records = $this->records;
    // print_r($records);
		return (!empty($records)) ? $records : null;
	}
}