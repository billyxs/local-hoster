<?php
require('autoloader.php');
$Config = new Config();

// Set project data
if(isset($_REQUEST['data']) ) {
	unset( $_REQUEST['data']['submit'] );

	$Config->addProject($_REQUEST['data']);
	$Config->save($Config->data);
}

// Delete Project
if(isset($_REQUEST['delete_project_id']) ) {
	// unset( $Config->data['projects'][$_REQUEST['delete_project_id'] ] );
	$Config->deleteProject( $_REQUEST['delete_project_id'] );
	$Config->save($Config->data);
}

$projects = $Config->data['projects'];
$tableKeys = array_keys($projects[0]);
$projectPaths = $Config->data['projects-path'];

if(isset($_REQUEST['id']) ) {
	$content ='includes/nextgen/project-edit.php';
} else {
	$content = 'includes/nextgen/project-list.php';
}

include('includes/nextgen/layout.php');