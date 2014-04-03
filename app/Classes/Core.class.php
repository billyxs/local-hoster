<?php
class Core extends Base {
	static $debug = false;

	public static function autoload() {
		// Autoload Classes
		spl_autoload_register(function ($class) {

				$controller_file 	= CONTROLLER . $class . '.php';
				$model_file 			= MODEL . $class . '.php';
				$class_file 			= CLASSFILE . $class . '.class.php';

				self::debug('autoload');

				if(file_exists($controller_file)) {
					self::debug($controller_file);
					require_once $controller_file;
				}

		    if(file_exists($model_file)) {
		    	Core::debug($model_file);
					require_once $model_file;
				}

		    if(file_exists($class_file)) {
		    	self::debug($class_file);
					require_once $class_file;
				}

		});
	}

	static function debug($value) {

		if(self::$debug) {
			echo $value . BR ;
		}
	}

}