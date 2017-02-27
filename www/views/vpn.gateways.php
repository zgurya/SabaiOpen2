<form action="." method="post" name="security.portforwarding">
	<div class="row">
		<div class="col-lg-12">
			<h2>Summary</h2>
			<div class="controlBoxContent">
				<div class="row">Default setting:</div>
				<div class="row tabs">
					<button type="button" name="none">None</button>
					<button type="button" name="local">Local</button>
					<button type="button" name="vpn_only">VPN</button>
					<button type="button" name="accelerator">Accelerator</button>
				</div>
				<div class="row">
					<table id='dhcp' class='listTable sortTable'>
						<tr>
							<th class="icon-sort-default">IP address</th>
							<th class="icon-sort-default">Mac</th>
							<th class="icon-sort-default">Name</th>
							<th class="icon-sort-default">Static</th>
							<th class="icon-sort-default">Expiration time</th>
						</tr>
						<?php $dhcp=get_dhcp();?>
						<?php if(!empty($dhcp)):?>
							<?php foreach ($dhcp['aaData'] as $dhcp_data):?>
								<tr class="dataRow">
									<td><?php echo $dhcp_data['ip']?></td>
									<td><?php echo $dhcp_data['mac']?></td>
									<td><?php echo $dhcp_data['name']?></td>
									<td><?php echo $dhcp_data['static']?></td>
									<td><?php echo $dhcp_data['time']?></td>
								</tr>
							<?php endforeach;?>
						<?php endif;?>
					</table>
				</div>
				<div class="row result-msg">
					<div class="col-lg-12 col-md-12 col-sm-12"></div>
				</div>
				<div class="row">
					<div class="col-lg-12">	
						<button type="button" value="save" class="save-form-btn" name="saveResults">Save</button><button type="button" name="cancel">Cancel</button>
					</div>
				</div>
				<div class="row smallText">
					<div><b>Click a device entry and click Edit to adjust the information provided:</b></div> 
					<div><b>IP Address:</b> The IP address assigned to the device. You can click in this field and change the IP address.</div> 
					<div><b>MAC:</b> The hardware address of the unit. This is hardcoded into the device.</div> 
					<div><b>Name:</b> The name of the device. You can click in this field and change the name.</div> 
					<div><b>Static:</b> Choose "on" to make lease permanent.</div> 
					<div><b>Expiration time:</b> The time when the lease expires.</div> 
					<div><b>Status:</b> Current status of the device.</div> 
					<div><b>Routing option:</b> Choose the default route for this device. "vpn_fallback" will continue access through internet if VPN is down.</div>
				</div>
			</div>
		</div>
	</div>
</form>