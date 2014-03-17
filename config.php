<?php
require_once('Classes/Config.class.php');

$Config = new Config();
if(!$Config->exists()) {
	header('Location: add-config.php');
}

$content = 'includes/config.php';
include('includes/layout.php');
