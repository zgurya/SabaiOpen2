<?php 
$vpn_stat=exec("uci get sabai.vpn.status");
if ( ($vpn_stat == 'Connected') && (file_exists('/tmp/resolv.conf.vpn')) && (filesize('/tmp/resolv.conf.vpn') != 0) ) {
	exec("cat /tmp/resolv.conf.vpn | grep nameserver | awk '{print $2}' | tr '\n' ' ' ",$servers);
} else {
	exec("cat /tmp/resolv.conf.auto | grep nameserver | awk '{print $2}' | tr '\n' ' ' ",$servers);
}
print_r($servers);
?>