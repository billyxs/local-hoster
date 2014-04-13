<?php
require('app/config.php');

$controller = isset($_REQUEST['controller']) ? ucwords($_REQUEST['controller']) . 'Controller' : 'ProjectsController';
$POST = (isset($_POST)) ? $_POST : null;
$GET = (isset($_GET)) ? $_GET : null;
$Controller = new $controller($GET, $POST);