<?php
// Sabai Technology - Apache v2 licence
// Copyright 2016 Sabai Technology
function synchronize_time(){
	$UCI_PATH="";
	$command=ROOT."/bin/time.sh";
	if (isset($_POST['sync'])) {
		$location=$_POST['sync'];
		exec("uci $UCI_PATH set sabai.time.location=\"" . $location . "\"");
		exec("uci $UCI_PATH commit sabai");
		exec("cp -r /etc/config/sabai /configs/");
		exec($command);
		
		// Send completion message back to UI
		$out=array('sabai'=>true,'msg'=>'Time settings applied');
		return json_encode($out,JSON_PRETTY_PRINT);
	}else{
		return 'Error detected current TimeZone';
	}
}
?>
