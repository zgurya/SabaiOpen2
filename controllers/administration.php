<?php
class Administration extends Controller {
	public function __construct() {
		parent::__construct();
	}
	/*
	public function index() {
		$this->view->template('administration');
	}
	*/
	public function settings() {
		$this->view->title = 'Settings';
		$this->view->template('administration.settings');
	}
	public function upgrade() {
		$this->view->title = 'Upgrade';
		$this->view->template('administration.upgrade');
	}
	public function status() {
		$this->view->title = 'Network: Status';
		$this->view->data = $this->model->get('administration.status');
		$this->view->template('administration.status');
	}
}
?>