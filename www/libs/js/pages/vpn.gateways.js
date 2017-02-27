jQuery(function($){
	/*
	 * Save changes
	 */
	$(document).on('click', '.vpn-gateways button[name="saveResults"]', function(e){
		$('.overlay').show();
		$('body').css('cursor','wait');
		$('.overlay .content').text('Applying settings...');
		
		var tableValues = [];
		$('.vpn-gateways #main #dhcp tr.dataRow').each(function(index, tr) {
			var tableRow = [];
		    var lines = $('td', tr).map(function(index, td) {
		    	tableRow.push($(td).text());
		    });
		    tableValues.push(tableRow);
		});
		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {
				dhcp: JSON.stringify(tableValues),
				action: 'dhcp'
			},
			success: function(response){
				if(response!=""){
					setTimeout(function() {
						$('.overlay').hide();
						$('body').css('cursor','default');
						var json=$.parseJSON(response);
						$('.result-msg .col-lg-12').text(json.msg);
					}, 3000);
				};
			},
			error: function(xhr, desc, err) {
				$('.overlay').hide();
				$('body').css('cursor','default');
				console.log(xhr + "\n" + err);
			}
		});
	});
});