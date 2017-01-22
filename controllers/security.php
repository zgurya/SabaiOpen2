<?php
class Security extends Controller {
	public function __construct() {
		parent::__construct();
	}
	# Uncomment this if you need Security index page
	/*
	public function index() {
		$this->view->template('security');
	}
	*/
	public function firewall() {
		$this->view->title = 'Security: Firewall';
		$this->view->template('security.firewall');
	}
	public function portforwarding() {
		$this->view->title = 'Security: Port Forwarding';
		$this->view->template('security.portforwarding');
	}
	public function dmz() {
		$this->view->title = 'Security: DMZ';
		$this->view->template('security.dmz');
	}
	public function upnp() {
		$this->view->title = 'Security: UPnP';
		$this->view->template('security.upnp');
	}
}
?>