function changeWPreviewBg(inputName,styleOption){
	if ( inputName != '' ) {
		var imgtofade = jQuery('#tp_' + inputName);
		imgtofade.removeClass().addClass(styleOption);
	} else {
		jQuery('#tp_wallow_theme_genlook').removeClass().addClass(styleOption);
		jQuery('#tp_wallow_theme_sidebar').removeClass().addClass(styleOption);
		jQuery('#tp_wallow_theme_pages').removeClass().addClass(styleOption);
		jQuery('#tp_wallow_theme_popup').removeClass().addClass(styleOption);
		jQuery('#tp_wallow_theme_avatar').removeClass().addClass(styleOption);
		jQuery('#tp_wallow_theme_quickbar').removeClass().addClass(styleOption);
	}
}
function forceWPreviewOptChng(styleOption){
	if(styleOption == '1'){
		jQuery("#wallow_options_select input").val([]);
		jQuery('#wallow_options_select').css( { 'visibility' : 'visible' } );
		jQuery('#wallow_options_select').css( { 'height' : 'auto' } );
	}else{
		jQuery('#wallow_options_select').css( { 'visibility' : 'hidden' } );
		jQuery('#wallow_options_select').css( { 'height' : '0px' } );
	}
}
