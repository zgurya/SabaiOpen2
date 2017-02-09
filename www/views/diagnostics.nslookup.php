<div class="row">
	<div class="col-lg-12">
		<h2>NS Lookup</h2>
		<div class="controlBoxContent">
			<form action="." method="post" name="diagnostics.nslookup">
				<div class="row">
					<label class="col-lg-2 col-md-4 col-sm-4" for="lookupAddress">Address:</label>
					<input id="lookupAddress" name="lookupAddress" type="text" value="google.com" class="col-lg-4 col-md-6 col-sm-6">
					<button type="button" value="nslookup" class="col-lg-1 col-md-2 col-sm-2" name="getResults">Lookup</button>
				</div>
			</form>
		</div>
		<div id='results' class='controlBoxContent hidden'>
			<div id='statistics' class='smallText'></div>
		</div>
	</div>
</div>