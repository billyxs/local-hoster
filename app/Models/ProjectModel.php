<?php
class ProjectModel extends ModelJson {

  public function getRecordById($id) {
    $project = parent::getRecordById($id);
    if($project && !isset($project['Group']))
      $project['Group'] = 'System';

    return $project;
  }

  public function sync() {
    $projects = $this->getRecordsByGroup();
    // echo json_encode($projects);


    if(!empty($projects)) {
      $settings = new SettingModel();
      $userSettings = $settings->getUserSettings();

      $hostsHandle = fopen($userSettings['hosts-path'], 'w+');
      $vhostsHandle = fopen($userSettings['vhosts-path'], 'w+');

      fwrite($hostsHandle, file_get_contents(STORAGE . 'hosts.template'));
      fwrite($vhostsHandle, file_get_contents(STORAGE . 'vhosts.template'));
      foreach($projects as $group=>$groupProjects) {
        $groupHeader = "\n# "  . $group . "\n";
        fwrite($hostsHandle, $groupHeader);
        fwrite($vhostsHandle, $groupHeader);

        foreach($groupProjects as $key=>$project) {
          $DocumentRoot = $project['DocumentRoot'];
          $ServerName = $project['ServerName'];

          $hostEntry = "127.0.0.1\t" . $ServerName . "\n";
          $vhostEntry = "<VirtualHost *:80>\n"
            . "\tDocumentRoot $DocumentRoot\n"
            . "\tServerName $ServerName\n"
            . "</VirtualHost>\n\n"
            ;

          fwrite($hostsHandle, $hostEntry);
          fwrite($vhostsHandle, $vhostEntry);
        }

      }

    }
  }

  public function getRecordsByGroup() {
    $projects = array();
    $records = $this->getRecords();
    if(!empty($records)) {
      foreach( $records as $key=>$record ) {
        $group = isset($record['Group']) ? $record['Group'] : '# Local Hoster';
        if(!isset($projects[ $group ] )) {
          $projects[$group] = array();
        }

        $projects[$group][] = $record;
      }

    }

    return $projects;
  }

}