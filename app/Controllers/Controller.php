<?php
class Controller extends Core {

	public function __construct($get=null, $post=null) {
		if(isset($post['data'])) {
			$this->data = $post['data'];
		}

		$this->controller = str_replace('Controller', '', get_class($this) );

		$this->action = (isset($get['action'])) ? $get['action'] : 'index';

		$this->viewpath = $this->controller;
		$this->view = $this->action;

		$id = (isset($get['id'])) ? $get['id'] : null;

		$this->before();

		$this->{$this->action}($id);
		$this->after();
		$this->render();

	}

	public function before() {

	}

	public function after() {

	}

	public function render() {
		$content = VIEW . $this->viewpath . DS . $this->view . '.php';
		include('app/Views/layouts/default.php');
	}

	public function redirect($values=array()) {
		header("Location: ?controller=" . $values['controller'] . "&action=" . $values['action']);
	}

	public function alertSuccess($message) {
		$this->setAlert($message, 'success');
	}

	public function alertError($message) {
		$this->setAlert($message, 'error');
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