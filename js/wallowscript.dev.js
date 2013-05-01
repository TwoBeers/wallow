/**
 * The animations
 *
 */

var wallowAnimations;

(function($) {

wallowAnimations = {

	//initialize
	init : function( in_modules ) {

		var modules = in_modules.split(',');

		for (i in modules) {

			switch(modules[i]) {

				case 'main_menu':
					this.main_menu();
					break;

				case 'smooth_scroll':
					this.smooth_scroll();
					break;

				case 'quickbar':
					this.quickbar();
					break;

				case 'widgets_style':
					this.widgets_style();
					break;

				case 'thickbox':
					this.thickbox();
					$('body').on('post-load', function(event){ //Jetpack Infinite Scroll trigger
						wallowAnimations.thickbox();
					});
					break;

				case 'resizevideo':
					this.resize_video();
					break;

				default :
					//no default action
					break;

			}

		}

	},

	main_menu : function() {

		$('#mainmenu').children('.menu-item-parent').each(function(){ //get every main list item
			var $this = $(this);
			var d = $this.children('ul'); //for each main item, get the sub list
			var margintop_in = 50; //the starting distance between menu item and the popup submenu
			var margintop_out = 20; //the exiting distance between menu item and the popup submenu
			d.css({'opacity' : 0 , 'margin-top' : margintop_in });
			$this.hoverIntent(
				function(){ //when mouse enters, slide down the sub list
					d.css({'display' : 'block' }).animate(
						{ 'opacity' : 1 , 'margin-top' : 0 },
						200
					);
				},
				function(){ //when mouse leaves, hide the sub list
					d.stop().animate(
						{ 'opacity' : 0 , 'margin-top' : margintop_out },
						200,
						'swing',
						function(){ d.css({'display' : '' , 'margin-top' : margintop_in }); }
					);
				}
			);
		});

	},

	smooth_scroll : function() {

		// fade in/out on scroll
		top_but = $('#micronav .up');
		bot_but = $('#micronav .down');
		top_but.hide();
		$(function () {
			$(window).scroll(function () {
				// check for top action
				if ($(this).scrollTop() > 100) {
					top_but.fadeIn();
				} else {
					top_but.fadeOut();
				}
				// check for bottom action
				if ( $('body').height()-$(window).scrollTop()-$(window).height() < 100) {
					bot_but.fadeOut();
				} else {
					bot_but.fadeIn();
				}

			});
		});

		// smooth scroll top/bottom
		top_but.click(function() {
			$("html, body").animate({
				scrollTop: 0
			}, {
				duration: 400
			});
			return false;
		});
		bot_but.click(function() {
			$("html, body").animate({
				scrollTop: $('#credits').offset().top - 80
			}, {
				duration: 400
			});
			return false;
		});

	},

	quickbar : function() {

		$('#quickbar').find('.footer_wig').each( function(){ //get every widget in qb
			var $this = $(this);
			var marginbottom_in = 50; //the starting distance between qb item and its submenu
			var marginbottom_out = 20; //the exiting distance between qb item and its submenu
			var list = $this.find('div.fw_pul') //the floating container
			if (list) {
				list.css({'opacity': 0,'margin-bottom': marginbottom_in});
				$this.hoverIntent(
					function(){ //when mouse enters the widget field
						list.css({'display' : 'block' }).stop().animate(
							{ 'opacity' : 1 , 'margin-bottom' : 0 },
							200
						);
					},
					function(){  //when mouse leaves the widget field
						list.stop().animate(
							{ 'opacity' : 0 , 'margin-bottom' : marginbottom_out },
							200,
							'swing',
							function(){ list.css({'display' : 'none' , 'margin-bottom' : marginbottom_in }); }
						);
					}
				);
			};
		});

	},

	widgets_style : function() {

		// widget placement
		$('#error404-widgets-area .widget:nth-child(odd)').css('clear', 'left');
		$('#single-widgets-area .widget:nth-child(odd)').css('clear', 'left');

	},

	thickbox : function() {

		//thickbox init
		$('#content').find('.storycontent a img').parent('a[href$=".jpg"],a[href$=".png"],a[href$=".gif"]').addClass('thickbox');
		$('#content').find('.storycontent .gallery').each(function() {
			var $this = $(this);
			$('a[href$=".jpg"],a[href$=".png"],a[href$=".gif"]',$this).attr('rel', $this.attr('id'));
		});

	},

	resize_video : function() {
		// https://github.com/chriscoyier/Fluid-Width-Video
		var $fluidEl = $("#content").find(".storycontent");
		var $allVideos = $("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com'], object, embed",$fluidEl);

		$allVideos.each(function() {
			$(this)
				// jQuery .data does not work on object/embed elements
				.attr('data-aspectRatio', this.height / this.width)
				.removeAttr('height')
				.removeAttr('width');
		});

		$(window).resize(function() {
			var newWidth = $fluidEl.width();
			$allVideos.each(function() {
				var $el = $(this);
				$el
					.width(newWidth)
					.height(newWidth * $el.attr('data-aspectRatio'));
			});
		}).resize();
	}

};

$(document).ready(function($){ wallowAnimations.init(wallow_l10n.script_modules); });

})(jQuery);
