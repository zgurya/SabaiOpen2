<div class="row">
	<div class="col-lg-12">
		<h2>Execute System Commands</h2>
		<div class="controlBoxContent">
			<form action="." method="post" name="diagnostics.console">
				<div class="row">
					<textarea id="cmd" name="cmd" class="col-lg-11 col-md-11 col-sm-11" rows="6"></textarea>
				</div>
				<button type="button" value="console" name="getResults">Execute</button>
			</form>
		</div>
		<div id='results' class='controlBoxContent hidden'>
			<div id='statistics' class='smallText'></div>
		</div>
	</div>
</div>