<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<title>SabaiOpen<?php if(isset($this->title)&&!empty($this->title)) echo' - '.$this->title;?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>/libs/css/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>/libs/css/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>/libs/css/main.css">
	
	<script type="text/javascript" src="<?php echo SITE_URL;?>/libs/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/libs/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/libs/js/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/libs/js/jquery.sortElements.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>/libs/js/main.js"></script>
</head>
<body class="<?php echo str_replace('.','-',$this->tmplf);?>">
<?php if($this->tmplf!='login'):?>
	<div class="container">
		<div class="row">
			<div id="menu" class="col-lg-2">
				<a href="<?php echo SITE_URL;?>"><img alt="Logo" src="<?php echo SITE_URL;?>/libs/images/logo.png"></a>
				<ul id="main-menu">
					<li>
						<a href="#" class="parent-menu">Network</a>
						<ul id="submenu_network" class="sub-menu">
							<li><a id="menu_network-wan" href="<?php echo SITE_URL;?>/network/wan/">WAN</a></li>
					 		<li><a id="menu_network-lan" href="<?php echo SITE_URL;?>/network/lan/">LAN</a></li>
					 		<li><a id="menu_network-time" href="<?php echo SITE_URL;?>/network/time/">Time</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="parent-menu">Wireless</a>
						<ul id="submenu_wireless" class="sub-menu">
							<li><a id="menu_wireless-radio" href="<?php echo SITE_URL;?>/wireless/radio/">Radio</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="parent-menu">VPN</a>
						<ul id="submenu_vpn" class="sub-menu">
							<li><a id="menu_vpn-openvpnserver" href="<?php echo SITE_URL;?>/vpn/openvpnserver/">Server</a></li>
							<li><a id="menu_vpn-openvpnclient" href="<?php echo SITE_URL;?>/vpn/openvpnclient/">OpenVPN Client</a></li>
							<li><a id="menu_vpn-pptpclient" href="<?php echo SITE_URL;?>/vpn/pptpclient/">PPTP Client</a></li>
							<li><a id="menu_vpn-tor" href="<?php echo SITE_URL;?>/vpn/tor/">Tor</a></li>
							<li><a id="menu_vpn-gateways" href="<?php echo SITE_URL;?>/vpn/gateways/">Gateways</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="parent-menu">Diagnostics</a>
						<ul id="submenu_diagnostics" class="sub-menu">
							<li><a id="menu_diagnostics-ping" href="<?php echo SITE_URL;?>/diagnostics/ping/">Ping</a></li>
							<li><a id="menu_diagnostics-trace" href="<?php echo SITE_URL;?>/diagnostics/trace/">Trace</a></li>
							<li><a id="menu_diagnostics-nslookup" href="<?php echo SITE_URL;?>/diagnostics/nslookup/">NS Lookup</a></li>
							<li><a id="menu_diagnostics-route" href="<?php echo SITE_URL;?>/diagnostics/route/">Route</a></li>
							<li><a id="menu_diagnostics-logs" href="<?php echo SITE_URL;?>/diagnostics/logs/">Logs</a></li>
							<li><a id="menu_diagnostics-console" href="<?php echo SITE_URL;?>/diagnostics/console/">Console</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="parent-menu">Security</a>
						<ul id="submenu_security" class="sub-menu">
							<li><a id="menu_security-firewall" href="<?php echo SITE_URL;?>/security/firewall/">Firewall</a></li>
							<li><a id="menu_security-portforwarding" href="<?php echo SITE_URL;?>/security/portforwarding/">Port Forwarding</a></li>
							<li><a id="menu_security-dmz" href="<?php echo SITE_URL;?>/security/dmz/">DMZ</a></li>
							<li><a id="menu_security-upnp" href="<?php echo SITE_URL;?>/security/upnp/">UPnP</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="parent-menu">Administration</a>
						<ul id="submenu_administration" class="sub-menu">
							<li><a id="menu_administration-settings" href="<?php echo SITE_URL;?>/administration/settings/">Settings</a></li>
							<li><a id="menu_administration-upgrade" href="<?php echo SITE_URL;?>/administration/upgrade/">Upgrade</a></li>
							<li><a id="menu_administration-status" href="<?php echo SITE_URL;?>/administration/status/">Status</a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo SITE_URL;?>/about/">About</a>
					</li>
				</ul>
			</div>
			<div class="col-lg-10">
				<div id="top-panel" class="row">
					<div class="col-lg-8">
						<a href="<?php echo '#'.str_replace('.', '-', $this->tmplf);?>" class="help-popup">
							<img alt="help" src="<?php echo SITE_URL;?>/libs/images/help.png" class="help">
						</a>
						<?php if(isset($this->title)):?>
							<h1><?php echo $this->title;?></h1>
						<?php endif;?>
					</div>
					<div class="col-lg-4" id="stats">
						<div class="row">
							<div class="col-lg-4" id="locstats">
								<div id="locquery">5.53.119.222</div>
								<div id="loccity">Kiev</div>
								<div id="loccountry">Ukraine</div>
							</div>
							<div class="col-lg-4" id="vpnstats">
								<div id="vpntype">VPN</div>
								<div id="vpnstatus">-</div>
								<div id="vpnip">-</div>
							</div>
							<div class="col-lg-4" id="torstats">
								<div id="tor_proxy">TOR proxy</div>
								<div id="tor_status">-</div> 
								<div id="tor_port">-</div> 
							</div>
						</div>
					</div>
				</div>
				<div id="main" class="row">
					<div class="col-lg-12">
						<?php require_once $this->tmplf.'.php';?>
					</div>
				</div>
			</div>
		</div>
		<div id="footer" class="row">
			<div class="offset-lg-2 col-lg-10">
				Copyright &copy; <?php echo date('Y');?> Sabai Technology, LLC
			</div>
		</div>
	</div>
<?php else:?>
	<div class="bg-overlay"></div>
	<div class="container">
		<div class="row">
			<?php require_once $this->tmplf.'.php';?>
		</div>
	</div>
<?php endif;?>
<?php require_once 'help.php';?>
</body>
</html>