<?php
class Core {
	static $debug = false;

	public static function autoload() {
		// Autoload Classes
		spl_autoload_register(function ($class) {

				$controller_file 	= CONTROLLER 	. $class . '.php';
				$model_file 			= MODEL 			. $class . '.php';
				$core_file 				= CORE 				. $class . '.php';

				self::debug('autoload');

				if(file_exists($controller_file)) {
					self::debug($controller_file);
					require_once $controller_file;

				} else if(file_exists($model_file)) {
		    	Core::debug($model_file);
					require_once $model_file;

				} else if(file_exists($core_file)) {
		    	self::debug($core_file);
					require_once $core_file;
				}

		});
	}

	public static function debug($value) {

		if(self::$debug) {
			echo $value . BR ;
		}
	}

}