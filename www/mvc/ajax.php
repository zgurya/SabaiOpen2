<?php
define('ROOT', dirname(__DIR__));
if(isset($_REQUEST['action'])&&!empty($_REQUEST['action'])){
	if($_REQUEST['action']=='status'){
		require_once ROOT.'/models/status.php';
		$type=(isset($_REQUEST['type'])&&!empty($_REQUEST['type']))?$_REQUEST['type']:'';
		$param=(isset($_REQUEST['param'])&&!empty($_REQUEST['param']))?$_REQUEST['param']:'';
		echo call_user_func_array('get_status', array($type, $param));
	}else{
		require_once ROOT.'/models/'.$_REQUEST['action'].'.php';
		echo call_user_func($_REQUEST['action']);
	}
}
die();
?>