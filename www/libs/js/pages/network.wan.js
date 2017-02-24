jQuery(function($){
	/*
	 * Network WAN. Tabs
	 */
	$(document).on('click', '.network-wan .tabs span', function(e){
		e.preventDefault(e);
		var clickedTab=$(this);
		var clickedID=clickedTab.attr('id');
		$('form input[name="wan_proto"]').val(clickedID);
		clickedTab.parent().find('span').removeClass('selected');
		clickedTab.addClass('selected');
		clickedTab.parents('.controlBoxContent').find('.wan-proto').each(function(){
			if($(this).hasClass(clickedID)){
				$(this).removeClass('hidden');
			}else{
				$(this).addClass('hidden');
			}
		});
	});
	
	/*
	 * Network WAN. Clear
	 */
	$(document).on('click', '.network-wan .clear-field', function(e){
		$(this).prev().find('input').val('');
	});
	
	/*
	 * Network WAN. Save
	 */
	$(document).on('click', '.network-wan button[name="saveResults"]', function(e){
		var form=$(this).closest('form');
		var validForm=true;
		form.find('input').each(function(){
			if(!$(this)[0].checkValidity()){
				$(this).parent().addClass('error');
				validForm=false;
			}
		});
		if(validForm){
			$('.overlay').show();
			$('body').css('cursor','wait');
			$('.overlay .content').text('Applying settings...');
			var data=form.serialize()+'&action=wan';
			$.ajax({
				url: ajaxUrl,
				type: 'POST',
				data: data,
				success: function(response){
					$('.overlay').hide();
					$('body').css('cursor','default');
					var json=$.parseJSON(response);
					$('.row.result-msg').show();
					$('.row.result-msg .col-lg-12').text(json.msg);
					setTimeout(function(){
						window.location.href = window.location.href;
					}, 3000);
				},
				error: function(xhr, desc, err) {
					$('.overlay').hide();
					$('body').css('cursor','default');
					console.log(xhr + "\n" + err);
				}
			});
		}
	});
	
	$(document).on('focus click', '.network-wan form input', function(e){
		if($(this).parent().hasClass('error')){
			$(this).parent().removeClass('error');
		}
	});
});