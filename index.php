<?php
require('app/config.php');

$controller = "ProjectsController";
$controller_view = 'projects';
$action = "index";
$param = null;
if(isset($_REQUEST['controller'])) {
	$params = $_REQUEST;

	if(isset($params['controller'])) {
		$controller = ucwords($params['controller']) . 'Controller';
		$controller_view = $params['controller'];

		if(isset($params['action'])) {
			$action = $params['action'];

			if(isset($params['id'])) {
				$param = $params['id'];
			}
		}
	}
}

$Controller = new $controller();
if(isset($_POST['data']) ) {
	$Controller->data = $_POST['data'];
}
$Controller->$action($param);

// If the controller sets the view, use it, otherwise use the named action
$view = (isset($Controller->view)) ? $Controller->view : $action;


$content = VIEW . $controller_view . DS . $view . '.php';
include('app/Views/layouts/default.php');