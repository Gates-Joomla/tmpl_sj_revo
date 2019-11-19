jQuery(window).load(function() {
	jQuery(".loader-content").fadeOut("slow");
});

// Add Class In Slideshow
function customPager($classAll) {	
	jQuery(".owl-item.active .slider-detail .detail-top").addClass("detail-top-active");
	jQuery(".owl-item.active .slider-detail .detail-title").addClass("detail-title-active");
	jQuery(".owl-item.active .slider-detail .detail-bottom").addClass("detail-bottom-active");
	jQuery(".owl-item.active .slider-detail .detail-button").addClass("detail-button-active");
}


jQuery(window).load(function()  {
 
	jQuery("#owl-carousel").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items : 1,
		//Pagination
		pagination : true,
		paginationNumbers: false,
		responsive:{
			768:{
				items: 3,
				margin: 8,
			},
			992:{
				items: 3,
				margin: 8,
			},
			1200:{
				items: 1,
			},
		}
	});
	
	jQuery("#owl-carousel-cate-featured").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items : 1,
		//Pagination
		pagination : false,
		paginationNumbers: false,
		nav: true,
		loop: true,
		margin: 30,
		responsive:{
			768:{
				items: 3,
				margin: 8,
			},
			992:{
				items: 3,
				margin: 8,
			},
			1200:{
				items: 4,
			},
		}
	});
	jQuery("#owl-carousel-related").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items : 1,
		//Pagination
		pagination : false,
		paginationNumbers: false,
		nav: true,
		loop: true,
		margin: 30,
		responsive:{
			768:{
				items: 3,
				margin: 8,
			},
			992:{
				items: 3,
				margin: 8,
			},
			1200:{
				items: 4,
			},
		}
	});
	jQuery("#owl-carousel-blog").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items : 1,
		//Pagination
		pagination : false,
		paginationNumbers: false,
		nav: true,
		loop: true,
		margin: 30,
		responsive:{
			768:{
				items: 3,
				margin: 8,
			},
			992:{
				items: 3,
				margin: 8,
			},
			1200:{
				items: 3,
			},
		}
	});
	jQuery("#owl-carousel-brand").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items : 1,
		//Pagination
		pagination : false,
		paginationNumbers: false,
		nav: true,
		loop: true,
		margin: 30,
		responsive:{
			768:{
				items: 3,
				margin: 8,
			},
			992:{
				items: 3,
				margin: 8,
			},
			1200:{
				items: 5,
			},
		}
	});
	jQuery('img.sppb-img-responsive').each(function(){
		var $img = jQuery(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');
		
		jQuery.get(imgURL, function(data) {
		 // Get the SVG tag, ignore the rest
		 var $svg = jQuery(data).find('svg');
	  
		 // Add replaced image's ID to the new SVG
		 if(typeof imgID !== 'undefined') {
		  $svg = $svg.attr('id', imgID);
		 }
		 // Add replaced image's classes to the new SVG
		 if(typeof imgClass !== 'undefined') {
		  $svg = $svg.attr('class', imgClass+' replaced-svg');
		 }
	  
		 // Remove any invalid XML tags as per http://validator.w3.org
		 $svg = $svg.removeAttr('xmlns:a');
	  
		 // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
		 if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
		  $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
		 }
	  
		 // Replace image with new SVG
		 $img.replaceWith($svg);
	  
		}, 'xml');
	  
	   });
});

jQuery(document).ready(function($) {
    var ua = navigator.userAgent,
    _device = (ua.match(/iPad/i)||ua.match(/iPhone/i)||ua.match(/iPod/i)) ? "smartphone" : "desktop";

    if(_device == "desktop") {
		$(".my-account").children(".modtitle").addClass( "dropdown-toggle" );
		$(".my-account").children(".modcontent").addClass( "dropdown-menu" );
        $(".my-account").bind('hover', function() {
            $(this).children(".modtitle").addClass(function(){
                if($(this).hasClass("open")){
                    $(this).removeClass("open");
                    return "";
                }
                return "open";
            });
			$(this).stop().children(".modcontent").slideToggle('300');
        });
    }else{
        $('.my-account .modtitle').bind('touchstart', function(){
            $('.my-account .modcontent').toggle();
        });
    }
});


