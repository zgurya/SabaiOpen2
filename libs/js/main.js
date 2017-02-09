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
	 * Listen button click and call ajax function
	 */
	$(document).on('click', 'form button', function(e){
		e.preventDefault(e);
		var form=$(this).closest('form');
		var buttonName=$(this).attr('name');
		var action=$(this).val();
		$('#results').show();
		$('#results #statistics').text('Loading...');
		if(buttonName==='getResults'){
			var ajaxUrl=location.protocol+'//'+document.domain+':'+location.port+'/mvc/ajax.php';
			var data=form.serialize()+'&action='+action;
			$.ajax({
				url: ajaxUrl,
				type: 'POST',
				data: data,
				success: function(response){
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
			});
		}
	});
})
