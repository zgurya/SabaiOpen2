<?php
class VPN extends Controller {
	public function __construct() {
		parent::__construct();
	}
	# Uncomment this if you need VPN index page
	/*
	public function index() {
		$this->view->template('network');
	}
	*/
	
	# Uncomment this if you need VPN server page
	/*
	public function server() {
		$this->view->title = 'VPN: server';
		$this->view->template('vpn.server');
	}
	*/
	public function openvpnclient() {
		$this->view->title = 'VPN: OpenVPN Client';
		$this->view->template('vpn.openvpnclient');
	}
	public function pptpclient() {
		$this->view->title = 'VPN: PPTP Client';
		$this->view->template('vpn.pptpclient');
	}
	public function tor() {
		$this->view->title = 'VPN: Tor - Anonymity Online';
		$this->view->template('vpn.tor');
	}
	public function gateways() {
		$this->view->title = 'Network: DHCP/Gateways';
		$this->view->template('vpn.gateways');
	}
}
?>