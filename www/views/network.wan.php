<form action="." method="post" name="network.wan">
	<div class="row">
		<div class="col-lg-12">
			<h2>WAN</h2>
			<div class="controlBoxContent">
				<div class="row result-msg hidden">
					<div class="col-lg-12 col-md-12 col-sm-12">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2 col-md-4 col-sm-4">
					 	<label>WAN proto</label>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 tabs">
						<span id="dhcp" class="selected">DHCP</span><span id="static">Static</span><span id="lan">LAN</span>
					</div>
					<input type="hidden" name="wan_proto" value="<?php echo get_status('wan','connection');?>">
				</div>
				<div class="row wan-proto static hidden">
					<label class="col-lg-2 col-md-4 col-sm-4" for="wan_ip">IP:</label>
					<span class="col-lg-2 col-md-4 col-sm-4 from-field" data-tip="Enter correct data"><input id="wan_ip" name="wan_ip" type="text" value="<?php echo get_status('wan','ip');?>" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$"></span>
				</div>
				<div class="row wan-proto static hidden">
					<label class="col-md-4 col-lg-2 col-sm-4" for="wan_subnet">Network Mask:</label>
					<span class="col-lg-2 col-md-4 col-sm-4 from-field" data-tip="Enter correct data"><input id="wan_subnet" name="wan_subnet" type="text" value="<?php echo get_status('wan','subnet');?>" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$"></span>
				</div>
				<div class="row wan-proto static hidden">
					<label class="col-lg-2 col-md-4 col-sm-4" for="system_gateway">Gateway:</label>
					<span class="col-lg-2 col-md-4 col-sm-4 from-field" data-tip="Enter correct data"><input id="system_gateway" name="system_gateway" type="text" value="<?php echo get_status('system','gateway');?>" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$"></span>
				</div>
				<div class="row wan-proto static dhcp lan">
					<label class="col-md-4 col-lg-2 col-sm-4" for="wan_mtu">MTU:</label>
					<span class="col-lg-2 col-md-4 col-sm-4 from-field" data-tip="Enter correct data"><input id="wan_mtu" name="wan_mtu" type="number" value="" min="576" max="1500" required></span>
				</div>
				<div class="row wan-proto static dhcp lan">
					<label class="col-md-4 col-lg-2 col-sm-4" for="wan_mac">MAC:</label>
					<span class="col-lg-2 col-md-4 col-sm-4 from-field" data-tip="Enter correct data"><input id="wan_mac" name="wan_mac" value="<?php echo get_status('wan','mac');?>" required pattern="^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$"></span>
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
						<?php if(!empty(get_status('wan','dns'))):?>
							<?php $i=1;foreach (get_status('wan','dns') as $dns_server):?>
								<?php if($i==1):?>
									<span class="col-lg-11 col-md-11 col-sm-11 from-field margin" data-tip="Enter correct data"><input name="dns_servers[]" value="<?php echo $dns_server;?>" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$"></span><span class="clear-field col-lg-1 col-md-1 col-sm-1">X</span>
								<?php else:?>
									<span class="col-lg-11 col-md-11 col-sm-11 from-field margin" data-tip="Enter correct data"><input name="dns_servers[]" value="<?php echo $dns_server;?>"></span><span class="clear-field col-lg-1 col-md-1 col-sm-1">X</span>
								<?php endif;?>
							<?php $i++;endforeach;?>
						<?php else:?>
							<span class="col-lg-11 col-md-11 col-sm-11 from-field margin" data-tip="Enter correct data"><input name="dns_servers[]" value="" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$"></span><span class="clear-field col-lg-1 col-md-1 col-sm-1">X</span>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<button type="button" value="save" class="save-form-btn" name="saveResults">Save</button><button type="button" name="cancel">Cancel</button>
		</div>
	</div>
</form>