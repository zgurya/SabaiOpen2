<div class="row">
	<div class="col-lg-12">
		<h2>Current Router Time and Timezone</h2>
		<div class="controlBoxContent">
			<span id="sys_time"><?php echo get_status('system','time');?></span>
			<button type="button" value="synchronize" class="synchronize-btn" name="synchronize">Synchronize</button>
			<span id="synchronize-result"></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2>Current Computer Time and Timezone</h2>
		<div class="controlBoxContent" id="user_time"></div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h2>Time Zone</h2>
		<div class="controlBoxContent">
			<div id="timezone-picker">
				<img id="timezone-image" src="<?php echo SITE_URL;?>/libs/images/world.jpg" width="600" height="300" usemap="#timezone-map" />
				<img class="timezone-pin" src="<?php echo SITE_URL;?>/libs/images/pin.png" style="padding-top: 4px;" />
				<?php include ROOT.'/views/mapdata.php'; ?>
			</div>
		</div>
	</div>
</div>