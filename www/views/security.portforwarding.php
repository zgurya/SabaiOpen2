<form action="." method="post" name="security.portforwarding">
	<div class="row">
		<div class="col-lg-12">
			<h2>Port Forwarding</h2>
			<div class="controlBoxContent">
				<div class="row port-fw-buttons">
					<button type="button" name="add-port-fw" class="add-btn">Add</button>
					<button type="button" name="edit-port-fw" class="none-active">Edit</button>
					<button type="button" name="delete-port-fw" class="none-active">Delete</button>
				</div>
				<div class="row">
					<table id='portFWTable' class='listTable sortTable'>
						<tr>
							<th>Status</th>
							<th>Protocol</th>
							<th>Gateway</th>
							<th>Source Address</th>
							<th>Source Port</th>
							<th>Destination Port</th>
							<th>Destination Address</th>
							<th>Description</th>
						</tr>
					</table>
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
<div id="add-port-fw" class="help-popup-block zoom-anim-dialog mfp-hide port-fw-popup">
	<div class="help-popup-title">Add record</div>
	<div class="help-popup-text">
		<div class="text-box">
			<form action="." method="post" name="add-security-portforwarding">
				<div class="row">
					<div class="col-lg-6"><label for="status">Status:</label></div>
					<div class="col-lg-6"><select id="status" name="status"><option value="on">on</option><option value="off">off</option></select></div>
				</div>
				<div class="row">
					<div class="col-lg-6"><label for="protocol">Protocol:</label></div>
					<div class="col-lg-6"><select id="protocol" name="protocol"><option value="on">on</option><option value="off">off</option></select></div>
				</div>
				<div class="row">
					<div class="col-lg-6"><label for="gateway">Gateway:</label></div>
					<div class="col-lg-6"><select id="gateway" name="gateway"><option value="on">on</option><option value="off">off</option></select></div>
				</div>
				<div class="row">
					<div class="col-lg-6"><label for="source-address">Source Address:</label></div>
					<div class="col-lg-6"><input type="text" id="source-address" name="source-address"></div>
				</div>
				<div class="row">
					<div class="col-lg-6"><label for="source-port">Source Port:</label></div>
					<div class="col-lg-6"><input type="text" id="source-port" name="source-port"></div>
				</div>
				<div class="row">
					<div class="col-lg-6"><label for="destination-port">Destination Port:</label></div>
					<div class="col-lg-6"><input type="text" id="destination-port" name="destination-port"></div>
				</div>
				<div class="row">
					<div class="col-lg-6"><label for="destination-address">Destination Address:</label></div>
					<div class="col-lg-6"><input type="text" id="destination-address" name="destination-address"></div>
				</div>
				<div class="row">
					<div class="col-lg-6"><label for="description">Description:</label></div>
					<div class="col-lg-6"><input type="text" id="description" name="description"></div>
				</div>
			</form>
		</div>
	</div>
	<div class="help-popup-footer">
		<button type="button" class="mfp-save-footer">Save</button><button type="button" class="mfp-close-footer">Close</button>
	</div>
</div>