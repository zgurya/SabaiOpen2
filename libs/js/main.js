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
	
	$('body.login form input').focus(function() {
		$(this).attr("placeholder", "");
	});
	
	/*
	 * Toggle main menu
	 */
	$(document).on('click', '#main-menu .parent-menu', function(e){
		e.preventDefault(e);
		$(this).parent('li').find('.sub-menu').stop().slideToggle(600);
	});
	
	/*
	 * Save toggle main menu at current page
	 */
	$(document).ready(function() {
		if ( window.location.pathname != '/' ){
			if($('.help-popup').length){
				var helpID=$('.help-popup').attr('href').substring(1);
				var menuID='menu_'+helpID;
			    $('#'+menuID).addClass('current-item');
			    $('#'+menuID).parents('.sub-menu').addClass('show');
			}
		}
	});
	
	/*
	 * Magnific Popup init
	 */
	$('.help-popup').magnificPopup({
		type: 'inline',
		fixedContentPos: false,
		fixedBgPos: true,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});
	
	/*
	 * Magnific Popup close action for close button in popup footer
	 */
	$(document).on( 'click', '.mfp-close-footer', function() {
		$.magnificPopup.close();
	});
	
	/*
	 * Listen button click and call ajax function
	 */
	$(document).on('click', 'form button', function(e){
		e.preventDefault(e);
		var form=$(this).closest('form');
		var buttonName=$(this).attr('name');
		var action=$(this).val();
		if(buttonName==='getResults'){
			var ajaxUrl=location.protocol+'//'+document.domain+':'+location.port+'/mvc/ajax.php';
			var data=form.serialize()+'&action='+action;
			$.ajax({
				url: ajaxUrl,
				type: 'POST',
				data: data,
				success: function(response){
					console.log(response);
				}
			});
		}
	});
})
