jQuery(function($){
	/*
	 * Login form
	 */
	$(document).on('click', 'body.login form input[type="submit"]', function(e){
		e.preventDefault(e);
		$('body.login form .error-msg').hide();
		var formValid=true;
		$('body.login form input').each(function(){
			if($(this).val().length===0){
				formValid=false;
				$(this).attr("placeholder", "Please fill this field");
			}
		});
		if(formValid==true) $('body.login form').submit();
	});
	
	$('form input').focus(function() {
		$(this).attr("placeholder", "");
	});
});