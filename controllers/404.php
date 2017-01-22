<?php
class Not_found extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->title = 'Error: 404';
		$this->view->template('404');
	}
}
?>