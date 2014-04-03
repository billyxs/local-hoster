<?php
require('autoloader.php');
$Settings = new Settings();
$Settings->load();
if(isset($_REQUEST['data']) ) {
	$data = $_REQUEST['data'];
	foreach($data as $key=>$val) {
		if($key === 'ProjectPaths')
			$val = implode(',', $val);

		$Settings->data[$key] = $val;
	}

	$Settings->save();
}


$content = 'includes/settings.php';
include('includes/nextgen/layout.php');
