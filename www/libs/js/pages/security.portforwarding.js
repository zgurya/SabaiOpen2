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
});