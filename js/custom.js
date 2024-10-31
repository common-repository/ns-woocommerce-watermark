// Display image in input type text after choosen
jQuery(document).ready(function($){
	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;

	$('#woocommerce_watermark_img_button').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		var id = button.attr('id').replace('_button', '');
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				$("#"+id).val(attachment.url);
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}

		wp.media.editor.open(button);
		return false;
	});

	$('.add_media').on('click', function(){
		_custom_media = false;
	});
	
	$('#woocommerce-watermark-notice button.ns-notice-dismiss').click(function() {
		$.ajax({
			url : nsdismisswat.ajax_url,
			type : 'post',
			data : {
				action : 'ns_dismisswatermark_ajax'
			},
			success : function( response ) {
				$('#woocommerce-watermark-notice').fadeOut();
			}
		});	
		
	});
});