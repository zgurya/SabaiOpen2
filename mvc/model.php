<?php
class Model {
	function __construct(){
		require_once ROOT.'/models/status.php';
		require_once ROOT.'/models/ping.php';
		require_once ROOT.'/models/trace.php';
	}
}
?>