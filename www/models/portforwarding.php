<?php
// Sabai Technology - Apache v2 licence
// Copyright 2016 Sabai Technology 
function portforwarding(){
	if(isset($_POST['ports_forwarding'])&&!empty($_POST['ports_forwarding'])){
		$ports_forwarding=json_decode($_POST['ports_forwarding']);
		$json_data['aaData']=array();
		$json_tmp=array();
		foreach ($ports_forwarding as $port_forwarding){
			$data=array(
					'status' =>$port_forwarding[0],
					'protocol' =>$port_forwarding[1],
					'gateway' =>$port_forwarding[2],
					'src' =>$port_forwarding[3],
					'ext' =>$port_forwarding[4],
					'int' =>$port_forwarding[5],
					'address' =>$port_forwarding[6],
					'description' =>$port_forwarding[7]
			);
			array_push($json_data['aaData'],$data);
			array_push($json_tmp,$data);
		}
		file_put_contents(ROOT."/libs/data/port_forwarding.json", json_encode($json_data));
		file_put_contents("/tmp/tablejs", json_encode($json_tmp,JSON_FORCE_OBJECT));
		exec(ROOT."/bin/pftable.sh");
		exec(ROOT."/bin/portforwarding.sh 2>&1",$res);
		
		$out = array('sabai' => true, 'msg' => 'Portforwarding apply');
		return json_encode($out,JSON_PRETTY_PRINT);
	}
}
function get_portforwarding(){
	$json = file_get_contents(ROOT."/libs/data/port_forwarding.json");
	return json_decode($json,true);
}

?>