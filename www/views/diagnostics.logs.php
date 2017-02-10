<div class="row">
	<div class="col-lg-12">
		<h2>Logs</h2>
		<div class="controlBoxContent">
			<form action="." method="post" name="diagnostics.logs">
			<div class="row enter-values row">
				<select id="log" class="col-lg-2 col-md-2 col-sm-2" name="log">
					<option value="messages" selected>System log</option>
					<option value="privoxy">Privoxy log</option>
					<option value="kernel">Kernel log</option>
				</select>
				<select id="act" name="act" class="col-lg-2 col-md-2 col-sm-2">
					<option value="all">View all</option>
					<option value="head">View first</option>
					<option value="tail" selected>View last</option>
					<option value="grep">Search for</option>
					<option value="download">Download file</option>
				</select>
				<input type="text" name="detail" id="detail" class="col-lg-2 col-md-2 col-sm-2" value="25"><span id="detailSuffix">lines</span>
			</div>
			<div class="row">
					<button type="button" value="logs" class="col-lg-1 col-md-2 col-sm-2" name="getResults">Show</button>
				</div>
			</form>
			<div id="results" class="controlBoxContent hidden row">
				<div id="statistics" class="smallText col-lg-12 col-md-12 col-sm-12"></div>
			</div>
		</div>
	</div>
</div>