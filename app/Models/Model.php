<?php
class Model {

	public function __construct() {
		$this->name = get_class($this);
	}
}