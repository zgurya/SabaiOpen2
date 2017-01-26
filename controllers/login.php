<?php
class Login extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->title = 'Hello user';
		$this->view->template('login');
	}
}
?>