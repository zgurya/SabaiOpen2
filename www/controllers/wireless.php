<?php
class Wireless extends Controller {
	public function __construct() {
		parent::__construct();
	}
	# Uncomment this if you need Wireless index page
	/*
	public function index() {
		$this->view->render('network');
	}
	*/
	public function radio() {
		$this->view->title = 'Wireless: Radio';
		$this->view->template('wireless.radio');
	}
}
?>