var wallowOptions;

(function($) {

wallowOptions = {

	//initialize
	init : function() {
		wallowOptions.switchTab('appearance');

		$('#to-defaults').click (function () {
			var answer = confirm(wlw_L10n.confirm_to_defaults)
			if (!answer){
				return false;
			}
		});

		$('#wallow-options .wlw-color').each(function() {
			$this = $(this);
			$this.wpColorPicker({
				change: function( event, ui ) {
					$this.val( $this.wpColorPicker('color') );
				},
				clear: function() {
					$this.val( '' );
				},
				palettes: ['#21759b','#404040','#87ceeb','#000','#fff','#aaa','#ff7b0a','#f7009c']
			});
		});

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

