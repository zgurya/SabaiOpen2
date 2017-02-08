<div class="row">
	<div class="col-lg-12">
		<h2>System</h2>
		<div class="controlBoxContent">
			<table class="controlTable">
				<tbody class="smallText">
					<tr>
						<td class="statusCellName"><b>Name</b></td>
						<td class="statusCellContent" id="sys_name"><?php echo get_status('system','name');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Model</b></td>
						<td class="statusCellContent" id="sys_model"><?php echo get_status('system','model');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Version Build</b></td>
						<td class="statusCellContent" id="sys_version"><?php echo get_status('system','version');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Time</b></td>
						<td class="statusCellContent" id="sys_time"><?php echo get_status('system','time');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Uptime</b></td>
						<td class="statusCellContent" id="sys_uptime"><?php echo get_status('system','uptime');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>CPU Load</b></td>
						<td class="statusCellContent" id="sys_cpuload"><?php echo get_status('system','cpuload');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Free Mem</b></td>
						<td class="statusCellContent" id="sys_mem"><?php echo get_status('system','mem');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Sys Gateway</b></td>
						<td class="statusCellContent" id="sys_gateway"><?php echo get_status('system','gateway');?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2>WAN</h2>
		<div class="controlBoxContent">
			<div class="row">
				<div class="col-lg-6">
					<table class="controlTable">
						<tbody class="smallText">
							<tr>
								<td class="statusCellName"><b>MAC Address</b></td>
								<td class="statusCellContent" id="wan_mac"><?php echo get_status('wan','mac');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Connection</b></td>
								<td class="statusCellContent" id="wan_connection"><?php echo get_status('wan','connection');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>IP Address</b></td>
								<td class="statusCellContent" id="wan_ip"><?php echo get_status('wan','ip');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Subnet Mask</b></td>
								<td class="statusCellContent" id="wan_subnet"><?php echo get_status('wan','subnet');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Gateway</b></td>
								<td class="statusCellContent" id="wan_gateway"><?php echo get_status('wan','gateway');?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6">
					<table class="controlTable">
						<tbody class="smallText">
							<tr>
								<td class="statusCellName"><b>DNS Servers</b></td>
								<td class="statusCellContent" id="wan_dns"><?php echo get_status('wan','dns');?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2>LAN</h2>
		<div class="controlBoxContent">
			<table class="controlTable">
				<tbody class="smallText">
					<tr>
						<td class="statusCellName"><b>MAC Address</b></td>
						<td class="statusCellContent" id="lan_mac"><?php echo get_status('lan','mac');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>IP Address</b></td>
						<td class="statusCellContent" id="lan_ip"><?php echo get_status('lan','ip');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Subnet Mask</b></td>
						<td class="statusCellContent" id="lan_subnet"><?php echo get_status('lan','subnet');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>DHCP</b></td>
						<td class="statusCellContent" id="lan_dhcp"><?php echo get_status('lan','dhcp');?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2>Wireless</h2>
		<div class="controlBoxContent">
			<div class="row">
				<div class="col-lg-6">
					<table class="controlTable">
						<tbody class="smallText">
							<tr>
								<td class="statusCellName"><b>SSID</b></td>
								<td class="statusCellContent" id="wl0_ssid"><?php echo get_status('wl0','ssid');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Wireless Mode</b></td>
								<td class="statusCellContent" id="wl0_mode"><?php echo get_status('wl0','mode');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Security</b></td>
								<td class="statusCellContent" id="wl0_security"><?php echo get_status('wl0','security');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Channel</b></td>
								<td class="statusCellContent" id="wl0_channel"><?php echo get_status('wl0','channel');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Channel Width</b></td>
								<td class="statusCellContent" id="wl0_width"><?php echo get_status('wl0','width');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>MAC Address</b></td>
								<td class="statusCellContent" id="wl0_mac"><?php echo get_status('wl0','mac');?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6">
					<table class="controlTable">
						<tbody class="smallText">
							<tr>
								<td class="statusCellName"><b>SSID</b></td>
								<td class="statusCellContent" id="wl1_ssid"><?php echo get_status('wl1','ssid');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Wireless Mode</b></td>
								<td class="statusCellContent" id="wl1_mode"><?php echo get_status('wl1','mode');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Security</b></td>
								<td class="statusCellContent" id="wl1_security"><?php echo get_status('wl1','security');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Channel</b></td>
								<td class="statusCellContent" id="wl1_channel"><?php echo get_status('wl1','channel');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Channel Width</b></td>
								<td class="statusCellContent" id="wl1_width"><?php echo get_status('wl1','width');?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2>VPN</h2>
		<div class="controlBoxContent">
			<table class="controlTable">
				<tbody class="smallText">
					<tr>
						<td class="statusCellName"><b>Type</b></td>
						<td class="statusCellContent" id="vpn_type"><?php echo get_status('vpn','type');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Status</b></td>
						<td class="statusCellContent" id="vpn_status"><?php echo get_status('vpn','status');?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2>Proxy</h2>
		<div class="controlBoxContent">
			<table class="controlTable">
				<tbody class="smallText">
					<tr>
						<td class="statusCellName"><b>Proxy Status</b></td>
						<td class="statusCellContent" id="proxy_status"><?php echo get_status('proxy','status');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Proxy Port</b></td>
						<td class="statusCellContent" id="proxy_port"><?php echo get_status('proxy','port');?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>