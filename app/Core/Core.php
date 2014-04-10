<?php
class Core {
	static $debug = false;

	static $OS = null;

	public function getOS() {
		$os = php_uname();

		if( strstr($os, 'MacBook') )
			return "OSX";
		else if( strstr($os, 'Windows') )
			return "Windows";
		else if( strstr($os, 'Linux') )
			return "Linux";

		return "Unknown";
	}

	public static function autoload() {
		// Autoload Classes
		spl_autoload_register(function ($class) {

				$controller_file 	= CONTROLLER 	. $class . '.php';
				$model_file 			= MODEL 			. $class . '.php';
				$core_file 				= CORE 				. $class . '.php';
				$view_file 				= VIEW 				. $class . '.php';

				Core::debug('autoload');

				if(file_exists($controller_file)) {
					Core::debug($controller_file);
					require_once $controller_file;

				} else if(file_exists($model_file)) {
		    	Core::debug($model_file);
					require_once $model_file;

				} else if(file_exists($core_file)) {
		    	Core::debug($core_file);
					require_once $core_file;
				} else if(file_exists($view_file)) {
		    	Core::debug($view_file);
					require_once $view_file;
				}

		});
	}

	public static function debug($value) {

		if(Core::$debug) {
			echo $value . BR ;
		}
	}

}