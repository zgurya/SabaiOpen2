jQuery(function($){
	/*
	 * Magnific Popup Security.Port Forwarding
	 */
	$(document).on('click', '.security-portforwarding #main .port-fw-buttons button', function(e){
		if(!$(this).hasClass('none-active')){
			if($(this).hasClass('add-btn')){
				$('.help-popup-block').addClass('add-port-fw');
				$('.help-popup-block').removeClass('edit-port-fw');
				clearForm('add-security-portforwarding');
				openPopup('port-fw-popup');	
			}
			if($(this).hasClass('edit-btn')){
				$('.help-popup-block').addClass('edit-port-fw');
				$('.help-popup-block').removeClass('add-port-fw');
				var tdValues = [];
				$('.security-portforwarding #main #portFWTable tr.dataRow.clicked').each(function(index, tr) {
				    var lines = $('td', tr).map(function(index, td) {
				    	tdValues.push($(td).text());
				    });
				});
				$('#port-fw-popup select[name="status"]').val(tdValues[0]);
				$('#port-fw-popup select[name="protocol"]').val(tdValues[1]);
				$('#port-fw-popup select[name="gateway"]').val(tdValues[2]);
				$('#port-fw-popup input[name="source-address"]').val(tdValues[3]);
				$('#port-fw-popup input[name="source-port"]').val(tdValues[4]);
				$('#port-fw-popup input[name="destination-port"]').val(tdValues[5]);
				$('#port-fw-popup input[name="destination-address"]').val(tdValues[6]);
				$('#port-fw-popup input[name="description"]').val(tdValues[7]);
				openPopup('port-fw-popup');
			}
			if($(this).hasClass('delete-btn')){
				e.preventDefault();
		        if (window.confirm("Are you sure?")) {
		        	$('#portFWTable tr.clicked').remove();
		        }
			}
		}
	});
	
	$(document).on('click', '.security-portforwarding #main #portFWTable tr.dataRow', function(e){
		$(this).parent().find('tr.clicked').removeClass('clicked');
		$(this).addClass('clicked');
		$(this).parents('.controlBoxContent').find('.none-active').removeClass('none-active');
	});
	
	/*
	 * Magnific Popup save data
	 */
	$(document).on( 'click', '.help-popup-block .mfp-save-footer', function() {
		var popup=$(this).closest('.help-popup-block');
		popup.find('.error').each(function(){
			$(this).removeClass('error');
		})
		var validForm=true;
		popup.find('input').each(function(){
			if(!$(this)[0].checkValidity()){
				$(this).parent().addClass('error');
				validForm=false;
			}
		});
		if(validForm){
			if(popup.hasClass('add-port-fw')){
				$('#portFWTable').append('<tr class="dataRow"></tr>');
				$.each(popup.find('form').serializeArray(),function(key,value){
					$('#portFWTable tr').last().append('<td>'+value.value+'</td>');
				});
			}
			if(popup.hasClass('edit-port-fw')){
				$('#portFWTable tr.clicked').html('');
				$.each(popup.find('form').serializeArray(),function(key,value){
					$('#portFWTable tr.clicked').append('<td>'+value.value+'</td>');
				});
			}
			formmodified=1;
			$.magnificPopup.close();
		}
	});
	
	/*
	 * Save changes
	 */
	$(document).on('click', '.security-portforwarding button[name="saveResults"]', function(e){
		$('.overlay').show();
		$('body').css('cursor','wait');
		$('.overlay .content').text('Applying settings...');
		
		var tableValues = [];
		$('.security-portforwarding #main #portFWTable tr.dataRow').each(function(index, tr) {
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
				ports_forwarding: JSON.stringify(tableValues),
				action: 'portforwarding'
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