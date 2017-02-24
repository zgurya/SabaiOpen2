jQuery(function($){
	/*
	 * Magnific Popup Security.Port Forwarding
	 */
	$(document).on('click', '.security-portforwarding #main .port-fw-buttons button', function(e){
		if(!$(this).hasClass('none-active')){
			if($(this).hasClass('add-btn')){
				$('.help-popup-block').addClass('add-port-fw');
				openPopup('port-fw-popup');	
			}
		}
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
			formmodified=1;
			$.magnificPopup.close();
		}
	});
});