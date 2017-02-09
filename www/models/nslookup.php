<?php
function nslookup($lookupAddress=null){
	if(isset($_REQUEST['lookupAddress'])&&!empty($_REQUEST['lookupAddress'])){
		$lookupAddress=$_REQUEST['lookupAddress'];
	}

	if($lookupAddress){
		$filter = array("<", ">","="," (",")",";","/","|");
		$lookupAddress=str_replace ($filter, "#", $lookupAddress);

		exec("nslookup $lookupAddress", $ip);
		$ip=str_replace($lookupAddress, "", $ip);

		return json_encode($ip,JSON_PRETTY_PRINT);

	}else{
		return 'Enter lookup address';
	}
}
?>