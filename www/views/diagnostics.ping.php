<div class="row">
	<div class="col-lg-12">
		<h2>VPN</h2>
		<div class="controlBoxContent">
			<form action="." method="post" name="diagnostics.ping">
				<div class="row">
					<label class="col-lg-2 col-md-4 col-sm-4" for="pingAddress">Address:</label>
					<input id="pingAddress" name="pingAddress" type="text" value="google.com" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row">
					<label class="col-md-4 col-lg-2 col-sm-4" for="pingCount">Ping Count:</label>
					<input id="pingCount" name="pingCount" value="4" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row">
					<label class="col-md-4 col-lg-2 col-sm-4" for="pingSize">Packet Size<span class="smallText"> (bytes)</span>:</label>
					<input id="pingSize" name="pingSize" value="56" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row">
					<button type="button" value="ping" name="getResults">Ping</button>
				</div>
			</form>
		</div>
		<div id='results' class='controlBoxContent hidden'>
			<div id='statistics' class='smallText'></div>
			<table id='resultTable' class='listTable hidden'>
				<tr>
					<th>Count</th>
					<th>Bytes</th>
					<th>TTL</th>
					<th>Time</th>
				</tr>
			</table>
		</div>
	</div>
</div>