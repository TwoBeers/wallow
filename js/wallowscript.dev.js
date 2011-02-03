jQuery(document).ready(function($){

	//main menu dropdown animation
	$('#mainmenu').children('li').each(function(){ //get every main list item
		var d = $(this).children('ul'); //for each main item, get the sub list
		var margintop_in = 50; //the starting distance between menu item and the popup submenu
		var margintop_out = 20; //the exiting distance between menu item and the popup submenu
		if(d.size() !== 0){ //if the sub list exists...
			$(this).children('a').append('<span class="hiraquo"> »</span>'); //add a raquo to the main item
			
			d.css({'opacity' : 0 , 'margin-top' : margintop_in });
			
			$(this).mouseenter(function(){ //when mouse enters, slide down the sub list
				d.css({'display' : 'block' });
				d.animate(
					{ 'opacity' : 1 , 'margin-top' : 0 },
					200
				);
			}).mouseleave(function(){ //when mouse leaves, hide the sub list
				d.stop();
				d.animate(
					{ 'opacity' : 0 , 'margin-top' : margintop_out },
					200,
					'swing',
					function(){ d.css({'display' : '' , 'margin-top' : margintop_in }); }
				);
			});
		}
	});
		
	//quickbar animation
	$('.footer_wig').each( function(){ //get every widget in qb
		var marginbottom_in = 50; //the starting distance between qb item and its submenu
		var marginbottom_out = 20; //the exiting distance between qb item and its submenu
		var list = $(this).find('div.fw_pul') //the floating container
		if (list) {
			list.css('opacity', '0');
			list.css('margin-bottom', marginbottom_in);
			$(this).mouseenter(function(){ //when mouse enters the widget field
				list.css({'display' : 'block' });
				list.stop();
				list.animate(					
					{ 'opacity' : 1 , 'margin-bottom' : 0 },
					200
				);
			}).mouseleave(function(){  //when mouse leaves the widget field
				list.stop();
				list.animate(					
					{ 'opacity' : 0 , 'margin-bottom' : marginbottom_out },
					200,
					'swing',
					function(){ list.css({'display' : 'none' , 'margin-bottom' : marginbottom_in }); }
				);
			});
		};
	});
	
});
