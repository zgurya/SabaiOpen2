<?php
class Model {
	function __construct(){
		require_once ROOT.'/models/status.php';
		require_once ROOT.'/models/ping.php';
		require_once ROOT.'/models/trace.php';
		require_once ROOT.'/models/nslookup.php';
		require_once ROOT.'/models/route.php';
		require_once ROOT.'/models/logs.php';
		require_once ROOT.'/models/console.php';
		require_once ROOT.'/models/wan.php';
		require_once ROOT.'/models/network_time.php';
		require_once ROOT.'/models/portforwarding.php';
		require_once ROOT.'/models/dhcp.php';
	}
}
?>