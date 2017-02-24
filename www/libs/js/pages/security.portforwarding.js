jQuery(function($){
	/*
	 * Magnific Popup Security.Port Forwarding
	 */
	$(document).on('click', '.security-portforwarding #main .port-fw-buttons button', function(e){
		if(!$(this).hasClass('none-active')){
			if($(this).attr('name')=='add-port-fw'){
				openPopup($(this).attr('name'));
			}
		}
	});
	
	/*
	 * Magnific Popup save data
	 */
	$(document).on( 'click', '.port-fw-popup .mfp-save-footer', function() {
		var popup=$(this).closest('.help-popup-block');
		var validForm=true;
		popup.find('input').each(function(){
			if(!$(this)[0].checkValidity()){
				$(this).parent().addClass('error');
				validForm=false;
			}
		});
		if(validForm){
			if(popup.attr('id')=='add-port-fw'){
				$('#portFWTable').append('<tr></tr>');
				$.each(popup.find('form').serializeArray(),function(key,value){
					$('#portFWTable tr').last().append('<td>'+value.value+'</td>');
				});
			}
			formmodified=1;
			$.magnificPopup.close();
		}
	});
});