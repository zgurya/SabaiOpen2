<?php 
function get_status($type=null,$param=null){
	if($type){
		if($type=='system'){
			switch ($param){
				case 'name':
					echo exec("hostname");
					break;
				case 'model':
					echo exec("awk '/model name/' /proc/cpuinfo | awk -F: '{print $2}'");
					break;
				case 'version':
					echo exec("cat /etc/sabaiopen_version");
					break;
				case 'time':
					echo exec("date");
					break;
				case 'uptime':
					echo exec("uptime | awk '{print $3,$4}' | sed 's/\,//g'");
					break;
				case 'cpuload':
					echo exec("uptime | awk -F: '{print $5,$6,$7}'");
					break;
				case 'mem':
					echo exec("cat /proc/meminfo |grep MemAvailable| awk '{print $2,$3}'");
					break;
				case 'gateway':
					echo exec("ip route show | grep default | awk '{print $3}'");
					break;
			}
		}
		if($type=='wan'){
			//exec("ifconfig -a eth0",$out);
			
			switch ($param){
				case 'mac':
					exec("ifconfig -a enp3s0",$out);
					echo strtoupper(substr($out[0],-17));
					break;
				case 'connection':
					echo exec("uci get sabai.wan.proto");
					break;
				case 'ip':
					exec("ifconfig -a enp3s0",$out);
					preg_match('/inet addr:(.*?)Bcast:/', $out[1], $match);
					echo trim($match[1]);
					break;
				case 'subnet':
					exec("ifconfig -a enp3s0",$out);
					$mask=strpos($out[1],'Mask:');
					echo substr($out[1],$mask+5,strlen($out[1]));
					break;
				case 'gateway':
					exec("route -n | grep enp3s0 |  awk '{print $2}'",$out);
					echo $out[0];
					break;
				case 'dns':
					$vpn_stat=exec("uci get sabai.vpn.status");
					if ( ($vpn_stat == 'Connected') && (file_exists('/tmp/resolv.conf.vpn')) && (filesize('/tmp/resolv.conf.vpn') != 0) ) {
						exec("cat /tmp/resolv.conf.vpn | grep nameserver | awk '{print $2}' | tr '\n' ' ' ",$servers);
					} else {
						exec("cat /tmp/resolv.conf.auto | grep nameserver | awk '{print $2}' | tr '\n' ' ' ",$servers);
					}
					foreach ($servers as $server){
						$output=$server.'</br>';
					}
					if(!empty($output)) echo $output;
					break;
			}
		}
		if($type=='lan'){
			
		}
		if($type=='Wireless'){
				
		}
		if($type=='vpn'){
				
		}
		if($type=='proxy'){
				
		}
	}else{
		return false;
	}
}
?>