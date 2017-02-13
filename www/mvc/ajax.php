<?php
define('ROOT', dirname(__DIR__));
if(isset($_REQUEST['action'])&&!empty($_REQUEST['action'])){
	if($_REQUEST['action']=='status'){
		require_once ROOT.'/models/status.php';
	}else{
		require_once ROOT.'/models/'.$_REQUEST['action'].'.php';
		echo call_user_func($_REQUEST['action']);
	}
}
die();
?>