<form action="." method="post" name="security.portforwarding">
	<div class="row">
		<div class="col-lg-12">
			<h2>Port Forwarding</h2>
			<div class="controlBoxContent">
				<div class="row port-fw-buttons">
					<button type="button" name="add-port-fw" class="add-btn">Add</button>
					<button type="button" name="edit-port-fw" class="edit-btn none-active">Edit</button>
					<button type="button" name="delete-port-fw" class="delete-btn none-active">Delete</button>
				</div>
				<div class="row">
					<table id='portFWTable' class='listTable sortTable'>
						<tr>
							<th class="icon-sort-default">Status</th>
							<th class="icon-sort-default">Protocol</th>
							<th class="icon-sort-default">Gateway</th>
							<th class="icon-sort-default">Source Address</th>
							<th class="icon-sort-default">Source Port</th>
							<th class="icon-sort-default">Destination Port</th>
							<th class="icon-sort-default">Destination Address</th>
							<th class="icon-sort-default">Description</th>
						</tr>
						<?php $ports_forwarding=get_portforwarding();?>
						<?php if(!empty($ports_forwarding)):?>
							<?php foreach ($ports_forwarding['aaData'] as $port_forwarding):?>
								<tr class="dataRow">
									<td><?php echo $port_forwarding['status']?></td>
									<td><?php echo $port_forwarding['protocol']?></td>
									<td><?php echo $port_forwarding['gateway']?></td>
									<td><?php echo $port_forwarding['src']?></td>
									<td><?php echo $port_forwarding['ext']?></td>
									<td><?php echo $port_forwarding['int']?></td>
									<td><?php echo $port_forwarding['address']?></td>
									<td><?php echo $port_forwarding['description']?></td>
									
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
					<div><b>Protocol</b> - Which protocol (tcp or udp) to forward.</div>
			        <div><b>VPN</b> - Forward ports through the normal internet connection (WAN) or through the tunnel (VPN), or both. Note that the Gateways feature may result in may result in undefined behavior when devices routed through an interface have ports forwarded through a different interface. Additionally, ports will only be forwarded through the VPN when the VPN service is active.</div>
			        <div><b>Src. Address</b> - (optional) - Forward only if from this address. Ex: "25.25.25.25".</div>
			        <div><b>Src. Ports</b> - The port(s) to be forwarded, as seen from the WAN. Ex: "2345", "6112:6120".</div>
			        <div><b>Dest. Port</b> - The destination port(s) inside the LAN. Ex: "80", "27015:27060".</div>
			        <div><b>Dest. Address</b> - (optional) - The destination address inside the LAN.</div>
			        <div><b>Description</b> - (optional) - Characters allowed: A-z, 0-9, underscore(_) and dash(-)</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div id="port-fw-popup" class="help-popup-block zoom-anim-dialog mfp-hide">
	<div class="help-popup-title">Add record</div>
	<div class="help-popup-text">
		<div class="text-box">
			<form action="." method="post" name="add-security-portforwarding">
				<div class="row">
					<div class="col-lg-5 label"><label for="status">Status:</label></div>
					<div class="col-lg-7 field"><select id="status" name="status"><option value="on">on</option><option value="off">off</option></select></div>
				</div>
				<div class="row">
					<div class="col-lg-5 label"><label for="protocol">Protocol:</label></div>
					<div class="col-lg-7 field"><select id="protocol" name="protocol"><option value="UDP">UDP</option><option value="TCP">TCP</option><option value="Both">Both</option></select></div>
				</div>
				<div class="row">
					<div class="col-lg-5 label"><label for="gateway">Gateway:</label></div>
					<div class="col-lg-7 field"><select id="gateway" name="gateway"><option value="LAN">LAN</option><option value="WAN">WAN</option><option value="PPTP">PPTP</option><option value="OVPN">OVPN</option></select></div>
				</div>
				<div class="row">
					<div class="col-lg-5 label"><label for="source-address">Source Address:</label></div>
					<div class="col-lg-7 field"><input type="text" id="source-address" name="source-address"" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" autocomplete="on"><p>*Invalid address - Enter valid ip.</p></div>
				</div>
				<div class="row">
					<div class="col-lg-5 label"><label for="source-port">Source Port:</label></div>
					<div class="col-lg-7 field"><input type="text" id="source-port" name="source-port" required pattern="^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])|([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5]):([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$" autocomplete="on"><p>*Invalid port - Enter valid port or range.</p></div>
				</div>
				<div class="row">
					<div class="col-lg-5 label"><label for="destination-port">Destination Port:</label></div>
					<div class="col-lg-7 field"><input type="text" id="destination-port" name="destination-port" required pattern="^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])|([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5]):([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$" autocomplete="on"><p>*Invalid port - Enter valid port or range.</p></div>
				</div>
				<div class="row">
					<div class="col-lg-5 label"><label for="destination-address">Destination Address:</label></div>
					<div class="col-lg-7 field"><input type="text" id="destination-address" name="destination-address" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" autocomplete="on"><p>*Invalid address - Enter valid ip.</p></div>
				</div>
				<div class="row">
					<div class="col-lg-5 label"><label for="description">Description:</label></div>
					<div class="col-lg-7 field"><input type="text" id="description" name="description" autocomplete="on"></div>
				</div>
			</form>
		</div>
	</div>
	<div class="help-popup-footer">
		<button type="button" class="mfp-save-footer">Save</button><button type="button" class="mfp-close-footer">Close</button>
	</div>
</div>