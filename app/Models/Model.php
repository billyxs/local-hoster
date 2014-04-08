<?php
class Model extends Core {

	public function __construct() {
		$this->name = get_class($this);
	}
}