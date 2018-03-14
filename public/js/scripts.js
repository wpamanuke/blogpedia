jQuery(document).ready(function( $ ) {
	/***********************************/
	/********** CATEGORIES add double liner *****************/
	$('.block1__meta .entry-meta-categories a').toggleClass('h-double-rect');
	$('.block1__meta .entry-meta-categories a').each( function( index, listItem ) {
		$(this).attr('data-before',$(this).text());
	});
	
	// slder
	$('.bped-main-slider__meta1 .entry-meta-categories a').toggleClass('h-double-rect');
	$('.bped-main-slider__meta1 .entry-meta-categories a').each( function( index, listItem ) {
		$(this).attr('data-before',$(this).text());
	});
	
	//single
	$('.block-single__meta .entry-meta-categories a').toggleClass('h-double-rect');
	$('.block-single__meta .entry-meta-categories a').each( function( index, listItem ) {
		$(this).attr('data-before',$(this).text());
		
	});
	
	/***********************************/
	/********** SLIDER *****************/
	//window.dispatchEvent(new Event('resize'));
	$('.bped-main-slider-block').owlCarousel({
		loop:true,
		margin:0,
		//navContainer:'.bped-main-slider-nav',
		navContainer:false,
		//nav:true,
		//navText: ["<span class='icon icon-arrow-left7'><i class='fa fa-angle-left'></i></span>","<span class='icon icon-arrow-right7'><i class='fa fa-angle-right'></i></span>"],
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		},
		responsiveClass:true,
		autoHeight:true,
		autoplay:false,
		autoplayTimeout:8000
	});
	$('.bped-main-slider-block .icon-arrow-right7').click(function(){
		$('.bped-main-slider-block .owl-next').trigger( "click" );
	});
	$('.bped-main-slider-block .icon-arrow-left7').click(function(){
		$('.bped-main-slider-block .owl-prev').trigger( "click" );
	});
	//$( ".bped-main-slider-block .owl-nav" ).wrap('<div class="bped-main-slider-block__navigation"><div class="container"><div class="row"><div class="col-md-12"></div></div></div></div>');
	
	
	
	$('.bped-top-featured-block').owlCarousel({
		loop:true,
		margin:0,
		nav:true,
		navText: ["<span class='icon icon-arrow-left7'><i class='fa fa-angle-left'></i></span>","<span class='icon icon-arrow-right7'><i class='fa fa-angle-right'></i></span>"],
		responsive:{
			0:{
				items:1
			},
			600:{
				items:2
			},
			1000:{
				items:4
			}
		},
		margin: 30,
		responsiveClass:true,
		autoHeight:true
	});
	
	$('.bped-top-featured-title .fa-angle-right').click(function(){
		$('.bped-top-featured-block .owl-next').trigger( "click" );
	});
	$('.bped-top-featured-title .fa-angle-left').click(function(){
		$('.bped-top-featured-block .owl-prev').trigger( "click" );
	});
	
	/********** SLIDER ENDS ************/
	/***********************************/
	
	
	/***********************************/
	/********** MENU *****************/
	
	//responsive copy main menu iteme
	$("#primarymenu ").children().clone().appendTo("#primarymenu-responsive");
	
	//main menu responsive sub menu toggle 
	jQuery('#primarymenu-responsive .menu-item-has-children,#mainmenu .page_item_has_children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');
    jQuery('#primarymenu-responsive .sub-toggle').click(function() {
        jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        jQuery(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
        jQuery(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
    });
	// toggle responsive menu icon
	jQuery('#bped-primarymenu-responsive-icon').click(function() {
		jQuery('.section-primarymenu-responsive').slideToggle('1000');
	});
	
	// main menu
	jQuery('#primarymenu > .menu-item-has-children > a,#mainmenu > .page_item_has_children > a').append('<span class="sub-toggle"> <i class="fa fa-angle-down"></i> </span>');
	jQuery('#primarymenu li .menu-item-has-children> a,#mainmenu  li .page_item_has_children >  a').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');
	
	/********** MENU ENDS ************/
	/***********************************/
	

});