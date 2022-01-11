jQuery(document).ready(function($){
	$('.mobile-menu').prepend("<a href='#' title='' class='close-nav-toggle' aria-expanded='true'><i class='fa fa-close'></i></a>");
});

jQuery(window).on('load', function( $ ){


	if(jQuery(".container").length){
		var gap = jQuery(".container").offset().left;

		jQuery(".pop-slider .slick-prev").css({
			"left": gap
		});
		jQuery(".pop-slider .slick-next").css({
			"right": gap
		});
	}
 
    /*==============================================
                      Custom Dropdown
    ===============================================*/

    jQuery('.drop-menu').on('click', function () {
        jQuery(this).attr('tabindex', 1).focus();
        jQuery(this).toggleClass('active');
        jQuery(this).find('.dropeddown').slideToggle(300);
    });
    jQuery('.drop-menu').on("focusout", function () {
        jQuery(this).removeAttr('tabindex', 1).focus();
        jQuery(this).removeClass('active');
        jQuery(this).find('.dropeddown').slideUp(300);
    });
    jQuery('.drop-menu .dropeddown li').on('click', function () {
        jQuery(this).parents('.drop-menu').find('span').text(jQuery(this).text());
        jQuery(this).parents('.drop-menu').find('span').addClass("selected");
        jQuery(this).parents('.drop-menu').find('input').attr('value', jQuery(this).attr('id'));
    });


    /*==============================================
                      DROPDOWN EFFECT
    ===============================================*/


    jQuery('.dropdown').on('show.bs.dropdown', function(e){
      jQuery(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
    });

    jQuery('.dropdown').on('hide.bs.dropdown', function(e){
      jQuery(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
    });


    /*==============================================
                SIGN / REGISTER POPUP
    ===============================================*/

    /*
    jQuery(".sign_in").on("click", function() {
        jQuery(".popup-from").addClass("show");
        jQuery(".wrapper").addClass("body-overlay");
        return false;
    });
    */
    jQuery(".close-form").on("click", function() {
        jQuery(".popup-from").removeClass("show");
        jQuery(".wrapper").removeClass("body-overlay");
        return false;
    });

    jQuery(".menu-btn,.close-nav-toggle").on("click", function(e) {
        e.preventDefault();
        jQuery(".mobile-menu").toggleClass("active");
        setTimeout (function(){
        jQuery(".close-nav-toggle").eq(0).attr('tabindex', -1).trigger('focus');
        },500);
         
        return false;
    });
    
    jQuery(".mobile-menu .menu a").last().on('keydown', function(e) { 
        var keyCode = e.keyCode || e.which; 
        if (keyCode == 9) { 
          e.preventDefault(); 
          jQuery(".close-nav-toggle").eq(0).attr('tabindex', -1).trigger('focus');
        } 
      });
    
    jQuery(".mobile-menu .menu a").last().on('keydown', function(e) { 
        var keyCode = e.keyCode || e.which; 
        if (keyCode == 9) { 
          e.preventDefault(); 
          jQuery(".close-nav-toggle").eq(0).attr('tabindex', -1).trigger('focus');
        } 
      });
    
    jQuery(".mobile-menu .menu a").first().on('keydown', function(e) { 
        var keyCode = e.keyCode || e.which; 
        if(event.shiftKey && event.keyCode == 9) { 
            //shift was down when tab was pressed
            e.preventDefault(); 
            jQuery(".close-nav-toggle").eq(0).attr('tabindex', -1).trigger('focus');
        }
    });
    
    jQuery(".close-nav-toggle").first().on('keydown', function(e) { 
        var keyCode = e.keyCode || e.which; 
        if(event.shiftKey && event.keyCode == 9) { 
            //shift was down when tab was pressed
            e.preventDefault(); 
            jQuery(".mobile-menu .menu a").last().attr('tabindex', -1).trigger('focus');
        }
    });
    
    
	jQuery(".mobile-menu > a/*, html*/").on("click", function() {
		jQuery(".mobile-menu").removeClass("active");
		return false;
	});
	
	jQuery(".mobile-menu").on("click", function(e) {
		e.stopPropagation();
	});

    jQuery(".mobile-menu ul.sub-menu").parent().addClass("has-sub-menu");

    jQuery(".mobile-menu li.has-sub-menu > a").on("click", function() {
        jQuery(this).next("ul").slideToggle();
        return false;
    });
	
	
	
    jQuery(".reply").on('click', function() {
        jQuery('html, body').animate({
            scrollTop: jQuery("#reply-sec").offset().top
        }, 2000);
    });

    jQuery(".more-btn").on("click", function() {
        jQuery(".banner2 .filter-section, .filter-section").slideToggle();
        return false;
    });
	
    jQuery('.menu-all-pages-container > ul > li a').on( "focus", function() {
        var $ = jQuery;
        var focused_class = 'is-focused';
        if($(this).closest('.menu-item-has-children')){
            var that,parent;
            that = $(this);
            parent = that.parent();
            parent.addClass(focused_class);
            parent.siblings().each(function(){
                $(this).removeClass(focused_class)
                $(this).find('li').removeClass(focused_class)
            })
        } else {
            jQuery('.menu-all-pages-container li').removeClass(focused_class)
        }
      });
      
    jQuery('form.sw_search_secondary select').each(function (i) {
        if(!jQuery(this).parent().find('.ss-main').length)
            new SlimSelect({
                select: 'form.sw_search_secondary select[name="'+jQuery(this).attr('name')+'"]'
            });
    })
    
    jQuery('form.sw_search_primary select').each(function (i) {
        if(!jQuery(this).parent().find('.ss-main').length)
            new SlimSelect({
                select: 'form.sw_search_primary select[name="'+jQuery(this).attr('name')+'"]'
            });
    })  

    jQuery('.search-form').on('submit', function () {
        jQuery(this).find('.search-submit').addClass('loading-show'); 
    });

    
});