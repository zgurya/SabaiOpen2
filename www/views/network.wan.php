<form action="." method="post" name="network.wan">
	<div class="row">
		<div class="col-lg-12">
			<h2>WAN</h2>
			<div class="controlBoxContent">
				<div class="row">
					<div class="col-lg-2 col-md-4 col-sm-4">
					 	<label>WAN proto</label>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 tabs">
						<span id="dhcp" class="selected">DHCP</span><span id="static">Static</span><span id="lan">LAN</span>
					</div>
				</div>
				<div class="row wan-proto static hidden">
					<label class="col-lg-2 col-md-4 col-sm-4" for="wan_ip">IP:</label>
					<input id="wan_ip" name="wan_ip" type="text" value="<?php echo get_status('wan','ip');?>" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row wan-proto static hidden">
					<label class="col-md-4 col-lg-2 col-sm-4" for="wan_subnet">Network Mask:</label>
					<input id="wan_subnet" name="wan_subnet" value="<?php echo get_status('wan','subnet');?>" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row wan-proto static hidden">
					<label class="col-lg-2 col-md-4 col-sm-4" for="system_gateway">Gateway:</label>
					<input id="system_gateway" name="system_gateway" type="text" value="<?php echo get_status('system','gateway');?>" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row wan-proto static dhcp lan">
					<label class="col-md-4 col-lg-2 col-sm-4" for="wan_mtu">MTU:</label>
					<input id="wan_mtu" name="wan_mtu" value="" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row wan-proto static dhcp lan">
					<label class="col-md-4 col-lg-2 col-sm-4" for="wan_mac">MAC:</label>
					<input id="wan_mac" name="wan_mac" value="<?php echo get_status('wan','mac');?>" class="col-lg-2 col-md-4 col-sm-4">
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<h2>DNS</h2>
			<div class="controlBoxContent">
				<div class="row">
					<div class="col-lg-2 col-md-4 col-sm-4">
						<label>DNS Servers</label>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 dns_servers">
						<input name="dns_server1" value="" class="col-lg-11 col-md-11 col-sm-11"><span class="clear-field col-lg-1 col-md-1 col-sm-1">X</span>
						<input name="dns_server2" value="" class="col-lg-11 col-md-11 col-sm-11"><span class="clear-field col-lg-1 col-md-1 col-sm-1">X</span>
						<input name="dns_server3" value="" class="col-lg-11 col-md-11 col-sm-11"><span class="clear-field col-lg-1 col-md-1 col-sm-1">X</span>
						<input name="dns_server4" value="" class="col-lg-11 col-md-11 col-sm-11"><span class="clear-field col-lg-1 col-md-1 col-sm-1">X</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button type="button" value="save" name="saveResults">Save</button><button type="button" value="cancel" name="cancelResults">Cancel</button>
		</div>
	</div>
</form>
	