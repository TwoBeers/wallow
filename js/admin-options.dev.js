var farbtastic;
var wallowOptions;

(function($) {

wallowOptions = {

	//initialize
	init : function() {
		wallowOptions.switchTab('appearance');
		
		$(document).mousedown(function(){
			$('.wlw-colorpicker').each( function() {
				var display = $(this).css('display');
				if (display == 'block')
					$(this).fadeOut(2);
			});
		});
		
		$('#to-defaults').click (function () {
			var answer = confirm(wlw_l10n.confirm_to_defaults)
			if (!answer){
				return false;
			}
		});

	},

	//update inputs value
	updateColor : function (domid,color,txtcolor) {
		inputid = '#wlw-color-' + domid;
		$(inputid).css({
			'background-color' : color,
			'color' : txtcolor
		});
		$(inputid).val(color);
	},

	// display the color picker
	showColorPicker : function (domid) {
		placeholder = '#wlw-colorpicker-' + domid;
		$(placeholder).show();
		farbtastic = $.farbtastic(placeholder, function(color) { 
			lightness = farbtastic.RGBToHSL(farbtastic.unpack( color ))[2];
			lightness > 0.5 ? txtcolor = '#000' : txtcolor = '#fff';
			wallowOptions.updateColor(domid,color,txtcolor);
		});
		farbtastic.setColor($('#wlw-color-' + domid).val());
	},

	//show only a set of rows
	switchTab : function (thisset) {
		thisclass = '.wlw-tabgroup-' + thisset;
		thissel = '#wlw-selgroup-' + thisset;
		$('.wlw-tab-opt').css({ 'display' : 'none' });
		$(thisclass).css({ 'display' : '' });
		$('#wlw-tabselector li').removeClass("sel-active");
		$(thissel).addClass("sel-active");
	},

	//change the preview
	changePreview : function (inputName,styleOption) {
		if ( inputName != '' ) {
			var imgtofade = $('#tp_' + inputName);
			imgtofade.removeClass().addClass(styleOption);
		} else {
			$('#tp_wallow_theme_genlook,#tp_wallow_theme_sidebar,#tp_wallow_theme_pages,#tp_wallow_theme_popup,#tp_wallow_theme_avatar,#tp_wallow_theme_quickbar').removeClass().addClass(styleOption);
		}
	},

	//slide down/up the theme mixer
	toggleMixer : function (styleOption) {
		if(styleOption == '1'){
			$("#wallow_theme_elements input").val([]);
			$('#wallow_theme_elements').slideDown()
		}else{
			$('#wallow_theme_elements').slideUp();
		}
	}
};

$(document).ready(function($){ wallowOptions.init(); });

})(jQuery);

