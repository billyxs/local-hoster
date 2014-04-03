<?php
// HTML break tag
define( BR, '<br />');
// Directory separator for cross OS support
define( DS, DIRECTORY_SEPARATOR);

// Server root path for files
define( SERVER_ROOT			, $_SERVER['DOCUMENT_ROOT'] . DS );

// root path for web assets
define( WEB_ASSETS		, SERVER_ROOT . 'assets' . DS);

define( APP_ROOT			, SERVER_ROOT . 'app' . DS);

define( CLASSFILE 		, APP_ROOT . 'Classes' . DS);
define( CONTROLLER 		, APP_ROOT . 'Controllers' . DS);
define( MODEL 				, APP_ROOT . 'Models' . DS);
define( VIEW 					, APP_ROOT . 'Views' . DS);

require_once(CLASSFILE . 'Core.class.php');

$Core = new Core();
$Core->autoload();

