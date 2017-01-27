<div class="row">
	<div class="col-12">
		<h2>System</h2>
		<div class="controlBoxContent">
			<table class="controlTable">
				<tbody class="smallText">
					<tr>
						<td class="statusCellName"><b>Name</b></td>
						<td class="statusCellContent" id="sys_name"><?php get_status('system','name');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Model</b></td>
						<td class="statusCellContent" id="sys_model"><?php get_status('system','model');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Version Build</b></td>
						<td class="statusCellContent" id="sys_version"><?php get_status('system','version');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Time</b></td>
						<td class="statusCellContent" id="sys_time"><?php get_status('system','time');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Uptime</b></td>
						<td class="statusCellContent" id="sys_uptime"><?php get_status('system','uptime');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>CPU Load</b></td>
						<td class="statusCellContent" id="sys_cpuload"><?php get_status('system','cpuload');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Free Mem</b></td>
						<td class="statusCellContent" id="sys_mem"><?php get_status('system','mem');?></td>
					</tr>
					<tr>
						<td class="statusCellName"><b>Sys Gateway</b></td>
						<td class="statusCellContent" id="sys_gateway"><?php get_status('system','gateway');?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<h2>WAN</h2>
		<div class="controlBoxContent">
			<div class="row">
				<div class="col-6">
					<table class="controlTable">
						<tbody class="smallText">
							<tr>
								<td class="statusCellName"><b>MAC Address</b></td>
								<td class="statusCellContent" id="wan_mac"><?php get_status('wan','mac');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Connection</b></td>
								<td class="statusCellContent" id="wan_connection"><?php get_status('wan','connection');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>IP Address</b></td>
								<td class="statusCellContent" id="wan_ip"><?php get_status('wan','ip');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Subnet Mask</b></td>
								<td class="statusCellContent" id="wan_subnet"><?php get_status('wan','subnet');?></td>
							</tr>
							<tr>
								<td class="statusCellName"><b>Gateway</b></td>
								<td class="statusCellContent" id="wan_gateway"><?php get_status('wan','gateway');?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-6">
					<table class="controlTable">
						<tbody class="smallText">
							<tr>
								<td class="statusCellName"><b>DNS Servers</b></td>
								<td class="statusCellContent" id="wan_dns"><?php get_status('wan','dns');?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

