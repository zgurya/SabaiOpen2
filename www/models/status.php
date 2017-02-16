<?php
function get_status($type=null,$param=null){
	if($type){
		if($type=='system'){
				
			if(file_exists('/etc/sabai/stat/ip')){
				$get_ip=file_get_contents('/etc/sabai/stat/ip', false, stream_context_create($arrContextOptions));
				$data=str_replace(array("'", " ="),array("", ":"),$get_ip);
				$ip=json_decode($data);
			}
				
			switch ($param){
				case 'name':
					return exec("hostname");
					break;
				case 'model':
					return exec("awk '/model name/' /proc/cpuinfo | awk -F: '{print $2}'");
					break;
				case 'version':
					return exec("cat /etc/sabaiopen_version");
					break;
				case 'time':
					return exec("date");
					break;
				case 'uptime':
					return exec("uptime | awk '{print $3,$4}' | sed 's/\,//g'");
					break;
				case 'cpuload':
					return exec("uptime | awk -F: '{print $5,$6,$7}'");
					break;
				case 'mem':
					return exec("cat /proc/meminfo |grep MemAvailable| awk '{print $2,$3}'");
					break;
				case 'gateway':
					return exec("ip route show | grep default | awk '{print $3}'");
					break;
				case 'remote_ip':
					return (isset($ip)&&!empty($ip))?$ip->query:'-';
					break;
				case 'remote_city':
					return (isset($ip)&&!empty($ip))?$ip->city:'-';
					break;
				case 'remote_country':
					return (isset($ip)&&!empty($ip))?$ip->country:'-';
					break;
			}
		}
		if($type=='wan'){
			exec("/sbin/ifconfig eth0 | egrep -o \"HWaddr [A-Fa-f0-9:]*|inet addr:[0-9:.]*|UP BROADCAST RUNNING MULTICAST\"",$out);
			switch ($param){
				case 'mac':
					return strtoupper(str_replace("HWaddr ","", ( array_key_exists(0,$out)? "$out[0]" : "-" ) ));
					break;
				case 'connection':
					return exec("uci get sabai.wan.proto");
					break;
				case 'ip':
					return str_replace("inet addr:","", ( array_key_exists(1,$out)? "$out[1]" : "-" ) );
					break;
				case 'subnet':
					return exec("ifconfig eth0 | grep Mask | awk '{print $4}' |sed 's/Mask://g'");
					break;
				case 'gateway':
					return exec("route -n | grep eth0 | grep UGH | awk '{print $2}'");
					break;
				case 'mtu':
					return exec("uci get sabai.wan.mtu");
					break;
				case 'dns':
					$vpn_stat=exec("uci get sabai.vpn.status");
					if ( ($vpn_stat == 'Connected') && (file_exists('/tmp/resolv.conf.vpn')) && (filesize('/tmp/resolv.conf.vpn') != 0) ) {
						exec("cat /tmp/resolv.conf.vpn | grep nameserver | awk '{print $2}' | tr '\n' ' ' ",$servers);
					} else {
						exec("cat /tmp/resolv.conf.auto | sed -n -e '/wan/,\$p'| grep nameserver | awk '{print $2}' | tr '\n' ' ' ",$servers);
					}
					if(isset($servers[0])){
						$output=explode(' ',$servers[0]);
					}
					if(isset($output) && !empty($output)) return $output;
					break;
			}
		}
		if($type=='lan'){
			exec("/sbin/ifconfig br-lan | egrep -o \"HWaddr [A-Fa-f0-9:]*|inet addr:[0-9:.]*|UP BROADCAST RUNNING MULTICAST\"",$out);
			switch ($param){
				case 'mac':
					return strtoupper(str_replace("HWaddr ","", ( array_key_exists(0,$out)? "$out[0]" : "-" ) ));
					break;
				case 'ip':
					return str_replace("inet addr:","", ( array_key_exists(1,$out)? "$out[1]" : "-" ) );
					break;
				case 'subnet':
					return exec("ifconfig br-lan | grep Mask | awk '{print $4}' |sed 's/Mask://g'");
					break;
				case 'dhcp':
					return exec("if [ $(uci -p /var/state get sabai.dhcp.lan) = 'yes' ]; then echo 'server'; else echo 'off'; fi");
					break;
			}
				
		}
		if($type=='wl0'){
			exec("/sbin/ifconfig wlan0 | egrep -o \"HWaddr [A-Fa-f0-9:]*|inet addr:[0-9:.]*|UP BROADCAST RUNNING MULTICAST\"",$out);
			switch ($param){
				case 'ssid':
					return exec("uci get sabai.wlradio0.ssid");
					break;
				case 'mode':
					return exec("iw wlan0 info | grep type | awk '{print $2}'");
					break;
				case 'security':
					return exec("uci get sabai.wlradio0.encryption");
					break;
				case 'channel':
					return exec("iw wlan0 info | grep channel | awk '{print $2}'");
					break;
				case 'width':
					return exec("iw wlan0 info | grep channel | awk '{print $6,$7}' | sed 's/,//g'");
					break;
				case 'mac':
					return strtoupper(str_replace("HWaddr ","", ( array_key_exists(0,$out)? "$out[0]" : "-" ) ));
					break;
			}
		}
		if($type=='wl1'){
			switch ($param){
				case 'ssid':
					return exec("uci get sabai.wlradio1.ssid");
					break;
				case 'mode':
					return exec("iw wlan1 info | grep type | awk '{print $2}'");
					break;
				case 'security':
					return exec("uci get sabai.wlradio1.encryption");
					break;
				case 'channel':
					return exec("iw wlan1 info | grep channel | awk '{print $2}'");
					break;
				case 'width':
					return exec("iw wlan1 info | grep channel | awk '{print $6,$7}' | sed 's/,//g'");
					break;
			}
		}
		if($type=='vpn'){
			switch ($param){
				case 'type':
					return exec("uci get sabai.vpn.proto");
					break;
				case 'status':
					return exec("uci get sabai.vpn.status");
					break;
			}
		}
		if($type=='proxy'){
			switch ($param){
				case 'status':
					return exec("uci get sabai.proxy.status");
					break;
				case 'port':
					return exec("cat /etc/privoxy/config | grep listen-address | awk -F: '{print $2}'");
					break;
			}
		}
	}else{
		return false;
	}
}
?>