<?php
class Network extends Controller {
	public function __construct() {
		parent::__construct();
	}
	# Uncomment this if you need Network index page
	/*
	public function index() {
		$this->view->template('network');
	}
	*/
	public function lan() {
		$this->view->title = 'Network: LAN';
		$this->view->template('network.lan');
	}
	public function wan() {
		$this->view->title = 'Network: WAN';
		$this->view->template('network.wan');
	}
	public function time() {
		$this->view->title = 'Network: Time';
		$this->view->template('network.time');
	}
}
?>