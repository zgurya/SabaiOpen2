jQuery(function($){
	var ajaxUrl=location.protocol+'//'+document.domain+':'+location.port+'/mvc/ajax.php';
	
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
	
	var table = $('#resultTable');
    
    table.find('th')
        .wrapInner('<span title="sort this column"/>')
        .each(function(){
            
            var th = $(this),
                thIndex = th.index(),
                inverse = false;
            
            th.click(function(){
                
                table.find('td').filter(function(){
                    
                    return $(this).index() === thIndex;
                    
                }).sortElements(function(a, b){
                    
                    return $.text([a]) > $.text([b]) ?
                        inverse ? -1 : 1
                        : inverse ? 1 : -1;
                    
                }, function(){
                    
                    // parentNode is the element we want to move
                    return this.parentNode; 
                    
                });
                
                inverse = !inverse;
                    
            });
                
        });
	
    
    /*
	 * Timeout recheck data
	 */
    window.setInterval(function(){
    	$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {
				action: 'status',
				type: 'system',
				param: 'remote_ip'
			},
			success: function(response){
				$('#top-panel #locstats #locquery').text(response);
			},
			error: function(xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
    	$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {
				action: 'status',
				type: 'system',
				param: 'remote_city'
			},
			success: function(response){
				$('#top-panel #locstats #loccity').text(response);
			},
			error: function(xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
    	$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {
				action: 'status',
				type: 'system',
				param: 'remote_country'
			},
			success: function(response){
				$('#top-panel #locstats #loccountry').text(response);
			},
			error: function(xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
    	if($('body.administration-status').length){
    		$.ajax({
    			url: ajaxUrl,
    			type: 'POST',
    			data: {
    				action: 'status',
    				type: 'system',
    				param: 'time'
    			},
    			success: function(response){
    				$('#sys_time').text(response);
    			},
    			error: function(xhr, desc, err) {
    				console.log(xhr + "\n" + err);
    			}
    		});
    	}
	}, 3000);
    
	/*
	 * Listen button click and call ajax function
	 */
	$(document).on('click', '.controlBoxContent button[name="getResults"]', function(e){
		e.preventDefault(e);
		
		if($('#resultTable tr.dataRow').length){
			$('#resultTable tr.dataRow').each(function(){
				$(this).remove();
			})
		}
		if($('#results').length){
			$('#results').hide();
		}
		if($('#resultTable').length){
			$('#resultTable').hide();
		}
		
		var form=$(this).closest('form');
		var action=$(this).val();
		if($('#results').length){
			$('#results').show();
			$('#results #statistics').html('Loading...');
		}
		var data=form.serialize()+'&action='+action;
		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: data,
			success: function(response){
				if(action=='ping'){
					var json=$.parseJSON(response);
					var stats=json.pingStatistics.split(',');
			        var info=json.pingInfo.split(',');
			        $('#results #statistics').html('--Summary--<br><br>');
			        $('#statistics').append('Round-Trip: '+stats[0]+' min, '+stats[1]+' avg, '+stats[2]+' max <br>');
			        $('#statistics').append('Packets: '+info[0]+' transmitted, '+info[1]+' received, '+info[2]+'% lost<br><br>');
			        
			        $.each( json.pingResults, function(i,value) {
			        	$('#resultTable').append('<tr class="dataRow"><td>'+value.count+'</td><td>'+value.bytes+'</td><td>'+value.count+'</td><td>'+value.time+'</td></tr>');
			        });
			        $('#resultTable').show();
				}
				if(action=='trace'){
					$('#results #statistics').remove();
					var json=$.parseJSON(response);
					$.each( json.traceResults, function(i,value) {
			        	$('#resultTable').append('<tr class="dataRow"><td>'+value.Hop+'</td><td>'+value.Address+'</td><td>'+value['Time (ms)']+'</td><td>'+value.Address2+'</td><td>'+value['Time2 (ms)']+'</td><td>'+value.Address3+'</td><td>'+value['Time3 (ms)']+'</td></tr>');
			        });
					$('#resultTable').show();
				}
				if(action=='nslookup'){
					var json=$.parseJSON(response);
					$('#results #statistics').html('');
					$.each( json, function(i,value) {
						$('#results #statistics').append(value+'<br>');
					});
				}
				if(action=='route'){
					var json=$.parseJSON(response);
					$.each(json.routeResults, function(i,value) {
						$('#resultTable').append('<tr class="dataRow"><td>'+value.destination+'</td><td>'+value.gateway+'</td><td>'+value.genmask+'</td><td>'+value.flags+'</td><td>'+value.mss+'</td><td>'+value.window+'</td><td>'+value.irtt+'</td><td>'+value.interface+'</td></tr>');
					});
					$('#resultTable').show();
				}
				if(action=='logs'){
					if($('.controlBoxContent select[name="act"]').val()=='download'){
						$('#results #statistics').html('<a href="'+response+'" download>File</a>');
					}else{
						$('#results #statistics').html(response);
					}
					
				}
				if(action=='console'){
					$('#results #statistics').html(response);
				}
			},
			error: function(xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
	});
	
	/*
	 * Add click trigger at Diagnostic Route page
	 */
	$(document).ready(function() {
		if ($('body.diagnostics-route').length){
			$('.controlBoxContent button[name="getResults"]').trigger( "click" );
		}
	});
	
	/*
	 * Listen change select option at Diagnostic Logs page
	 */
	$(document).on('change', '.controlBoxContent select[name="act"]', function(e){
		$('.controlBoxContent #detailSuffix').hide();
		$('.controlBoxContent #detail').show().val('');
		switch($('.controlBoxContent select[name="act"]').val()){
			case 'all':
			case 'download':
				$('.controlBoxContent #detail').hide();
			break;
			case 'head':
			case 'tail':
				$('.controlBoxContent #detail').show().val('25');
				$('.controlBoxContent #detailSuffix').html(' lines');
				$('.controlBoxContent #detailSuffix').show();
			break;
			case 'grep':
				$('.controlBoxContent #detail').show().val('');
				break;
		}
	});
	
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
	
	/*
	 * Cancel button
	 */
	$(document).on('click', 'button[name="cancel"]', function(e){
		window.location.href = location.protocol+'//'+document.domain+':'+location.port;
	});
}) 