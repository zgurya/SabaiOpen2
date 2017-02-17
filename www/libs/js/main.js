jQuery(function($){
	var ajaxUrl=location.protocol+'//'+document.domain+':'+location.port+'/mvc/ajax.php';
	new Date();
	
	/*
	 * Document.Ready - init action
	 */
	$(document).ready(function() {
		/* Network.Time - Current Computer Time and Timezone */
		if($('body.network-time').length) $('#user_time').text(Date());
		
		/* Diagnostic.Route - Add click trigger at  page */
		if ($('body.diagnostics-route').length) $('.controlBoxContent button[name="getResults"]').trigger( "click" );
		
		if ($('img#timezone-image').length){
			$('#timezone-image').timezonePicker({
				target: '#edit-date-default-timezone',
				countryTarget: '#edit-site-default-country'
			});

			// Optionally an auto-detect button to trigger JavaScript geolocation.
			$('#timezone-detect').click(function() {
				$('#timezone-image').timezonePicker('detectLocation');
			});
		}
	});
	
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
    	get_ajax_data('status','system','remote_ip','#top-panel #locstats #locquery');
    	get_ajax_data('status','system','remote_city','#top-panel #loccity #locquery');
    	get_ajax_data('status','system','remote_country','#top-panel #loccountry #locquery');
    	if($('body.administration-status').length) get_ajax_data('status','system','time','#sys_time');
	}, 3000);
    
    window.setInterval(function(){
    	if($('body.network-time').length) get_ajax_data('status','system','time','#sys_time')
    	if($('body.network-time').length) $('#user_time').text(Date());
    }, 1000);
    
    function get_ajax_data(action,type,param,dest){
    	$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {
				action: action,
				type: type,
				param: param
			},
			success: function(response){
				$(dest).text(response);
			},
			error: function(xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
    }
    
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
				action: 'synchronize_time',
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
		//$('#edit-date-default-timezone').val(currTZ.name());
		//setTimeout("window.location.reload()",1000);
	});
})