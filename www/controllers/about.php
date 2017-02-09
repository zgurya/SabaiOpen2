<?php
class About extends Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		$this->view->title = 'About';
		$this->view->template('about');
	}
}
?>