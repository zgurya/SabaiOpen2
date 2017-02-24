jQuery(function($){
	window.setInterval(function(){
    	get_ajax_data('status','system','time','#sys_time');
	}, 3000);
})