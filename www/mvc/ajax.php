<?php
define('ROOT', dirname(__DIR__));
if(isset($_POST['action'])&&!empty($_POST['action'])){
	require_once ROOT.'/models/'.$_POST['action'].'.php';
	echo call_user_func($_POST['action']);
}
die();
?>