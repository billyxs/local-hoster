<?php
class ProjectModel extends ModelJson {

  public function isReady() {
    $Settings = new SettingModel();
    $setup = $Settings->getUserSettings();
  }

}