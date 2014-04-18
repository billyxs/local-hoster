<?php
class Controller extends Core {

	private $sessionName = 'CORE';

	public function __construct($get=null, $post=null) {
		// $this->initializeSession();

		// bind $_POST data to controller
		if(isset($post['data'])) {
			$this->data = $post['data'];
		}

		// set current controller
		$this->controller = str_replace('Controller', '', get_class($this) );

		// set action
		$this->action = (isset($get['action'])) ? $get['action'] : 'index';

		// set view path
		$this->viewpath = strtolower( $this->controller );
		$this->view = $this->action;

		// if there is an id in the params
		$id = (isset($get['id'])) ? $get['id'] : null;

		// before action
		$this->before();

		// initiate action
		$this->{$this->action}($id);
		
		// after action
		$this->after();

		// render action
		$this->render();

		// clear session variables
		$this->clearSession();
	}

	public function before() {

	}

	public function after() {

	}

	public function render() {
		$this->content = VIEW . $this->viewpath . DS . $this->view . '.php';
		include('app/Views/layouts/default.php');
	}

	public function initializeSession() {

		// session_name('CORE');
		session_start();
		$sessionName = $this->sessionName;

		if(!isset($_SESSION[$sessionName])) {
			// echo BR . ' not set ' . BR;
			$_SESSION[$sessionName] = array();
		}

		$this->session = &$_SESSION[$sessionName];

		if(!empty($this->session)) {
			foreach($this->session as $action=>$message) {
				$this->{$action}($message);
				// echo $action . ' ' . $message;
			}
		}

		// print_r($this->session);
	}

	public function clearSession() {
		// echo BR . 'clear' . BR ;
		$this->session = array();
	}

	public function addToSession($key, $value) {
		$this->session[$key] = $value;
	}

	public function getSessionByKey($key) {
		return $this->session[$key];	
	}


	public function redirect($values=array()) {
		// controller route
		$buildLocation = '?controller=' . $values['controller'];
		unset($values['controller']);
		if(!empty($values)) {
			foreach($values as $key=>$val) {
				$buildLocation .= '&' . $key . '=' . $val;
			}
		}

		// redirect
		header("Location: " . $buildLocation);
	}

	public function alertSuccess($message) {
		// $this->addToSession('alertSuccess', $message);
		$this->setAlert($message, 'success');
	}

	public function alertError($message) {
		// $this->addToSession('alertError', $message);
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