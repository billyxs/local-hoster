<?php
class Controller extends Core {
	public function __construct() {

	}

	public function before() {

	}

	public function alertSuccess($message) {

	}

	public function setAlert($message = '', $status='error') {
		$class = $this->getAlertClass($status);

		$this->alert = array(
			'message'=>$message,
			'status'=>$status,
			'class'=>$class
		);
	}

	public function getAlertClass($status) {

		switch($status) {
			case 'success':
				return 'success';
			case 'warning':
				return 'warning';

			case 'error':
			default:
				return 'danger';

		}
	}
}