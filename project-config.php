<?php
require_once('Classes/Config.class.php');

$Config = new Config();

if( isset($_REQUEST['data']) ) {
	$result = $Config->save( $_REQUEST['data']['Config'] );
}

$content = 'includes/nextgen/edit-config.php';
include('includes/nextgen/layout.php');
