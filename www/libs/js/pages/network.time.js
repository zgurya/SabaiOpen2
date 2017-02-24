jQuery(function($){

	/*
	 * Document.Ready - init action
	 */
	$(document).ready(function() {
		window.setInterval(function(){
	    	get_ajax_data('status','system','time','#sys_time');
	    	$('#user_time').text(Date());
	    }, 1000);
		
		/* Network.Time - Current Computer Time and Timezone */
		if($('body.network-time').length) $('#user_time').text(Date());
		
		/* Network.Time - NTP */		
		$.getJSON( location.protocol+'//'+document.domain+':'+location.port+'/libs/data/network.time.json', function( data ) {
			$.each( data.aaData, function( key, val ) {
				$('#ntpTable').append('<tr class="dataRow"><td data-ntp="'+val.ntp_server+'">'+val.ntp_server+'</td></tr>');
				$('.network-time #main .ntp-buttons').append('<input type="hidden" name="ntp_server[]" value="'+val.ntp_server+'">');
				//console.log(val);
			});
		});
		
		/* Network.Time - TimeZone Picker image */
		if ($('#timezone-image').length){
			$('#timezone-image').timezonePicker({
		        target: '#edit-date-default-timezone',
		        countryTarget: '#edit-site-default-country'
		    });
			$('#edit-date-default-timezone').val($('#edit-date-default-timezone').data('default'));

			// Optionally an auto-detect button to trigger JavaScript geolocation.
			$('#timezone-detect').click(function() {
				var currTZ = jstz.determine();
				$('#edit-date-default-timezone').val(currTZ.name());
				$('#timezone-image').timezonePicker({
			        target: '#edit-date-default-timezone',
			        countryTarget: '#edit-site-default-country'
			    });
			});
		}
	})
	
	/*
	 * Network.Time - Synchronize
	 */
	$(document).on('click', '.network-time button[name="synchronize"]', function(e){
		$('.overlay').show();
		$('body').css('cursor','wait');
		$('.overlay .content').text('Synchronization in process...');
		var currTZ = jstz.determine();
		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {
				action: 'network_time',
				sync: currTZ.name()
			},
			success: function(response){
				if(response!=""){
					setTimeout(function() {
						$('.overlay').hide();
						$('body').css('cursor','default');
						var json=$.parseJSON(response);
						$('#synchronize-result').text(json.msg);
					}, 3000);
				};
			},
			error: function(xhr, desc, err) {
				$('.overlay').hide();
				$('body').css('cursor','default');
				console.log(xhr + "\n" + err);
			}
		});
		$('#edit-date-default-timezone').val(currTZ.name());
		$('#timezone-image').timezonePicker({
	        target: '#edit-date-default-timezone',
	        countryTarget: '#edit-site-default-country'
	    });
	});
	
	/*
	 * Network.Time save changes
	 */
	$(document).on('click', '.network-time button[name="saveResults"]', function(e){
		var form=$(this).closest('form');
		$('.overlay').show();
		$('body').css('cursor','wait');
		$('.overlay .content').text('Applying settings...');
		var data=form.serialize()+'&action=network_time';
		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: data,
			success: function(response){
				if(response!=""){
					setTimeout(function() {
						$('.overlay').hide();
						$('body').css('cursor','default');
						var json=$.parseJSON(response);
						$('#result-msg').text(json.msg);
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
	
	/*
	 * Network.Time select NTP server row
	 */
	$(document).on('click', '.network-time #main #ntpTable tr.dataRow', function(e){
		var selectNTP=$(this).find('td').data('ntp');
		$(this).parent().find('tr.clicked').removeClass('clicked');
		$('.network-time #main .ntp-buttons').find('input.clicked').removeClass('clicked');
		$(this).addClass('clicked');
		$('.network-time #main .ntp-buttons input').each(function(){
			if($(this).val()==selectNTP){
				$(this).addClass('clicked');
			}
		});
		$(this).parents('.controlBoxContent').find('.none-active').removeClass('none-active');
	});
	
	/*
	 * Magnific Popup Network.Time init
	 */
	$(document).on('click', '.network-time #main .ntp-buttons button', function(e){
		if(!$(this).hasClass('none-active')){
			if($(this).attr('name')=='delete-ntp'){
				e.preventDefault();
		        if (window.confirm("Are you sure?")) {
		            //location.href = window.location.href;
		        	var selectNTP=$('.network-time #main #ntpTable tr.clicked').find('td').data('ntp');
		        	$('.network-time #main #ntpTable tr.clicked').remove();
		        	$('.network-time #main .ntp-buttons input').each(function(){
		        		if($(this).val()==selectNTP){
		        			$(this).remove();
		        		}
		        	});
		        	$(this).parents('.controlBoxContent').find('button[name="edit-ntp"]').addClass('none-active');
		        	$(this).parents('.controlBoxContent').find('button[name="delete-ntp"]').addClass('none-active');
		        }
			}else{
				openPopup($(this).attr('name'));
				if($(this).attr('name')=='edit-ntp'){
					$('#edit-ntp input[name="edit-ntp"]').val($('.network-time #main #ntpTable tr.clicked').find('td').data('ntp'));
				}
			}
		}
	});
	
	/*
	 * Magnific Popup Network.Time save data
	 */
	$(document).on( 'click', '.ntp-popup .mfp-save-footer', function() {
		if($(this).parents('.help-popup-block').attr('id')=='add-ntp'){
			$('#ntpTable').append('<tr class="dataRow"><td data-ntp="'+$(this).parents('.help-popup-block').find('input[name="add-ntp"]').val()+'">'+$(this).parents('.help-popup-block').find('input[name="add-ntp"]').val()+'</td></tr>');
			$('.network-time #main .ntp-buttons').append('<input type="hidden" name="ntp_server[]" value="'+$(this).parents('.help-popup-block').find('input[name="add-ntp"]').val()+'">');
		}else{
			$('.network-time #main #ntpTable tr.clicked').find('td').text($(this).parents('.help-popup-block').find('input[name="edit-ntp"]').val());
			$('.network-time #main .ntp-buttons').find('input.clicked').val($(this).parents('.help-popup-block').find('input[name="edit-ntp"]').val());
		}
		$.magnificPopup.close();
	});
})