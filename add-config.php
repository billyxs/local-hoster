<?php
require_once('Classes/Config.class.php');

$Config = new Config();

if( isset($_REQUEST['data']) ) {
	$result = $Config->save( $_REQUEST['data']['Config'] );
}

$content = 'includes/edit-config.php';
include('includes/layout.php');
