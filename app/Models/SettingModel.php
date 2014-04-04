<?php
class SettingModel extends ModelJson {

	public function getUserSettings(){
		return $this->SettingModel->records[0];
	}
}