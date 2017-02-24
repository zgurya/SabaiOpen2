<div class="row">
	<div class="col-lg-12">
		<h2>Traceroute</h2>
		<div class="controlBoxContent">
			<form action="." method="post" name="diagnostics.trace">
				<div class="row">
					<label class="col-lg-2 col-md-4 col-sm-4" for="traceAddress">Address:</label>
					<input id="traceAddress" name="traceAddress" type="text" value="google.com" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row">
					<label class="col-md-4 col-lg-2 col-sm-4" for="maxHops">Ping Count:</label>
					<input id="maxHops" name="maxHops" value="4" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row">
					<label class="col-md-4 col-lg-2 col-sm-4" for="maxWait">Packet Size<span class="smallText"> (bytes)</span>:</label>
					<input id="maxWait" name="maxWait" value="56" class="col-lg-2 col-md-4 col-sm-4">
				</div>
				<div class="row">
					<button type="button" value="trace" name="getResults">Trace</button>
				</div>
			</form>
		</div>
		<div id='results' class='controlBoxContent hidden'>
			<div id='statistics' class='smallText'></div>
			<table id='resultTable' class='listTable sortTable hidden'>
				<tr>
					<th class="icon-sort-default">Hop</th>
					<th class="icon-sort-default">Address</th>
					<th class="icon-sort-default">Time (ms)</th>
					<th class="icon-sort-default">Address 2</th>
					<th class="icon-sort-default">Time (ms)</th>
					<th class="icon-sort-default">Address 3</th>
					<th class="icon-sort-default">Time (ms)</th>
				</tr>
			</table>
		</div>
	</div>
</div>