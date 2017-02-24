var ajaxUrl=location.protocol+'//'+document.domain+':'+location.port+'/mvc/ajax.php';
new Date();

jQuery(function($){

	/*
	 * Document.Ready - init action
	 */
	$(document).ready(function() {
		formmodified=0;
	    $('form *').change(function(){
	    	var form=$(this).closest('form');
	    	if($(this).attr('id')!='edit-date-default-timezone' && form.attr('id')!='auth'){
	    		formmodified=1;
	    	}
	    });
	    window.onbeforeunload = confirmExit;
	    function confirmExit() {
	        if (formmodified == 1) {
	            return "New information not saved. Do you wish to leave the page?";
	        }
	    }
	    $('input[name="saveResults"].save-form-btn').click(function() {
	        formmodified = 0;
	    });
	});
	
	/*
	 * Cancel button
	 */
	$(document).on('click', 'button[name="cancel"]', function(e){
		window.location.href = location.protocol+'//'+document.domain+':'+location.port;
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
		if($('.help-popup').length){
			var helpID=$('.help-popup').attr('href').substring(1);
			var menuID='menu_'+helpID;
		    $('#'+menuID).addClass('current-item');
		    $('#'+menuID).parents('.sub-menu').addClass('show');
		}
	});
	
	/*
	 * Magnific Help Popup init
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
	 * Sort table
	 */
	var table = $('.sortTable');
    
    table.find('th')
        .wrapInner('<span title="sort this column"/>')
        .each(function(){
            var th = $(this),
                thIndex = th.index(),
                inverse = false;
            th.click(function(){
            	
            	$(this).parents('#resultTable').find('th').not($(this)).each(function(){
            		$(this).removeClass('icon-sort-up');
                	$(this).removeClass('icon-sort-down');
            	});
            	if($(this).hasClass('icon-sort-up')){
            		if($(this).hasClass('up')){
            			$(this).removeClass('up');
                		$(this).addClass('down');
            		}
            		$(this).removeClass('icon-sort-up');
            		$(this).addClass('icon-sort-down');
            	}else{
            		if($(this).hasClass('icon-sort-down')){
            			if($(this).hasClass('down')){
                			$(this).removeClass('down');
                    		$(this).addClass('up');
                		}
                		$(this).removeClass('icon-sort-down');
                		$(this).addClass('icon-sort-up');
                	}else{
                		if($(this).hasClass('up')){
                			$(this).addClass('icon-sort-down');
                		}else{
                			$(this).addClass('up');
                    		$(this).addClass('icon-sort-up');
                		}
                	}
            	}
            	
            	
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
	}, 3000);
    
    
    
	/*
	 * Listen button click and call ajax function. Diagnostics
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

})

function get_ajax_data(action,type,param,dest){
	jQuery.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {
				action: action,
				type: type,
				param: param
			},
			success: function(response){
				jQuery(dest).text(response);
			},
			error: function(xhr, desc, err) {
				console.log(xhr + "\n" + err);
			}
		});
    }

function openPopup(el) {
		jQuery.magnificPopup.open({
			items: {
				src: '#'+el,
			},
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
	}