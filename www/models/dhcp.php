<?php
// Sabai Technology - Apache v2 licence
// Copyright 2016 Sabai Technology 
function dhcp(){
	if(isset($_POST['dhcp'])&&!empty($_POST['dhcp'])){
		$dhcp=json_decode($_POST['dhcp']);
		$json_data['aaData']=array();
		$json_tmp=array();
		foreach ($dhcp as $dhcp_data){
			$data=array(
					'ip' =>$dhcp_data[0],
					'mac' =>$dhcp_data[1],
					'name' =>$dhcp_data[2],
					'static' =>$dhcp_data[3],
					'time' =>$dhcp_data[4]
			);
			array_push($json_data['aaData'],$data);
			array_push($json_tmp,$data);
		}
		file_put_contents(ROOT."/libs/data/dhcp.json", json_encode($json_data));
		file_put_contents("/tmp/tablejs", json_encode($json_tmp,JSON_FORCE_OBJECT));
		//file_put_contents("/tmp/defSetting", $default);
		exec(ROOT."/bin/dhcp.sh json");
		exec("sh ".ROOT."/bin/dhcp.sh save 2>&1");
		
		$out = array('sabai' => true, 'msg' => 'DHCP settings apply');
		return json_encode($out,JSON_PRETTY_PRINT);
	}
}
function get_dhcp(){
	$json = file_get_contents(ROOT."/libs/data/dhcp.json");
	return json_decode($json,true);
}

?>