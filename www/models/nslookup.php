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
		$addrs = count($ip);
		
		for ($i = 0 ; $i < $addrs ; $i++) echo($ip[$i] . "<br>");
		
	}else{
		echo 'Enter lookup address';
	}
}
?>