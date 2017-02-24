jQuery(function($){
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
})