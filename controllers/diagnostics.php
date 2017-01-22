<?php
class Diagnostics extends Controller {
	public function __construct() {
		parent::__construct();
	}
	# Uncomment this if you need Diagnostics index page
	/*
	public function index() {
		$this->view->template('diagnostics');
	}
	*/
	public function ping() {
		$this->view->title = 'Diagnostics: Ping';
		$this->view->template('diagnostics.ping');
	}
	public function trace() {
		$this->view->title = 'Diagnostics: Trace';
		$this->view->template('diagnostics.trace');
	}
	public function nslookup() {
		$this->view->title = 'Diagnostics: NS Lookup';
		$this->view->template('diagnostics.nslookup');
	}
	public function route() {
		$this->view->title = 'Diagnostics: Route';
		$this->view->template('diagnostics.route');
	}
	public function logs() {
		$this->view->title = 'Diagnostics: Logs';
		$this->view->template('diagnostics.logs');
	}
	public function console() {
		$this->view->title = 'Diagnostics: Console';
		$this->view->template('diagnostics.console');
	}
}
?>