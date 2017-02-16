<?php 
$arrContextOptions=array(
	"ssl"=>array(
		"cafile" => "/etc/php5/ca-bundle.crt",
		"verify_peer"=>true,
		"verify_peer_name"=>true,
	),
);

$URIfile=exec("uci get sabai.general.updateuri");

if(isset($URIfile)&&!empty($URIfile)){
	$URI=file_exists($URIfile)?file_get_contents($URIfile):'http://ip-api.com/json';
}

if(isset($URI)&&!empty($URI)){
	$get_ip=@file_get_contents($URI, false, stream_context_create($arrContextOptions));
	$ip=str_replace(array("'", " ="),array("", ":"),$get_ip);
	file_put_contents("/etc/sabai/stat/ip",$ip);
}
?>