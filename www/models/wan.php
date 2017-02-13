<?php 
function wan($proto=null, $ip=null, $mask=null, $gateway=null, $mac=null, $mtu=null, $dns=null){
	if(isset($_REQUEST['wan_proto'])&&!empty($_REQUEST['wan_proto'])){
		$proto=$_REQUEST['wan_proto'];
	}
	if(isset($_REQUEST['wan_ip'])&&!empty($_REQUEST['wan_ip'])){
		$ip=$_REQUEST['wan_ip'];
	}
	if(isset($_REQUEST['wan_mask'])&&!empty($_REQUEST['wan_mask'])){
		$mask=$_REQUEST['wan_mask'];
	}
	if(isset($_REQUEST['wan_gateway'])&&!empty($_REQUEST['wan_gateway'])){
		$gateway=$_REQUEST['wan_gateway'];
	}
	if(isset($_REQUEST['wan_mac'])&&!empty($_REQUEST['wan_mac'])){
		$mac=$_REQUEST['wan_mac'];
	}
	if(isset($_REQUEST['wan_mtu'])&&!empty($_REQUEST['wan_mtu'])){
		$mtu=$_REQUEST['wan_mtu'];
	}
	if(isset($_REQUEST['dns_servers'])&&!empty($_REQUEST['dns_servers'])){
		$dns=implode(" ", $_REQUEST["dns_servers"]);
	}
	
	
	
	if($proto){
		$UCI_PATH="";
		exec("uci $UCI_PATH set sabai.wan.proto=\"" . $proto . "\"");
		
		if($ip) exec("uci $UCI_PATH set sabai.wan.ipaddr=\"" . $ip . "\"");
		if($mask) exec("uci $UCI_PATH set sabai.wan.netmask=\"" . $mask . "\"");
		if($gateway) exec("uci $UCI_PATH set sabai.wan.gateway=\"" . $gateway . "\"");
		if($mac) exec("uci $UCI_PATH set sabai.wan.macaddr=\"" . $mac . "\"");
		if($mtu)exec("uci $UCI_PATH set sabai.wan.mtu=\"" . $mtu . "\"");
		if($dns)exec("uci $UCI_PATH set sabai.wan.dns=\"" . $dns . "\"");
		
		exec("uci $UCI_PATH commit sabai");
		exec("cp -r /etc/config/sabai /configs/");
		exec("sh ".ROOT."/bin/wan.sh " . $proto);
		//exec("/etc/init.d/network restart");
		$out = array('sabai' => true, 'msg' => 'WAN settings applied');
		return json_encode($out,JSON_PRETTY_PRINT);
	}else{
		$out = array('sabai' => false, 'msg' => 'WAN settings error');
		return json_encode($out,JSON_PRETTY_PRINT);
	}
}
?>