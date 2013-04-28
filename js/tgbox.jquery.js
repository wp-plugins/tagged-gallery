//
// tgbox
// Author: Erik Bergh
// 
jQuery(document).ready(function($){ 
	$.fn.tgbox = function(options) {
		
	
		// Do your awesome plugin stuff here
		
		return this.each(function() {  
	
			var defaults = {  
				className:  "tg-lightbox",
				overlayCSS: {}
			};
			
			var options = $.extend(defaults, options);  
			
            var $obj = $(this);
            
			$('body').append("<div class='overlay'></div>");
			$('body').append("<div class='overlayimg'></div>");
			
			$(".overlay").css({
				opacity: '.7',
				filter: 'alpha(opacity=70)',
				background: '#000000'
            })
			
			var image=$obj.attr("data-larger");
			
			var fitimage = function(img) {
				
				var ratio =1;
				
				var width=img.attr("fs-width");
				var height=img.attr("fs-height");
				
				var display_size = {
					width:width,
					height:height
				}
				
				var window_height= $j(window).height();
				var window_width= $j(window).width();

                if(width>window_width*0.9){ // checking if picture is too wide
					display_size.width = window_width*0.9;
					ratio = display_size.width/width;
					display_size.height = height*ratio;
				} 
				
				// now we know that the image is not too wide
				if(display_size.height>window_height*0.9){ // checking if picture is too tall 
					display_size.height=window_height*0.9;
					ratio = display_size.height/height;
					display_size.width = width*ratio;
				}     
				
				return display_size;
            };
			
			function transform(ref) {
            
				var displaysize=fitimage(ref);
			
				var imgstring="<img src=\"" + image + "\" width=\""+ displaysize.width +"\">";
			
				var leftmargin = displaysize.width/2;
				var topmargin = displaysize.height/2;
			
				$(".overlayimg").css({
					top: '50%',
					left: '50%',
					'margin-left': -leftmargin,
					'margin-top': -topmargin,
					background: '#000000',
					border: '2px solid #000000'
				})
			
				$('.overlayimg').html(imgstring);
			
				$(".overlay").click(function() {
					$j(".overlay").remove();
					$j(".overlayimg").remove();
				});
			
				$(".overlayimg").click(function() {
					$j(".overlay").remove();
					$j(".overlayimg").remove();
				});
			}
			
			$(window).resize(function() {
					transform($obj);
			});
			
			if(this.complete) { // fix load issue in Opera & IE...
                transform($obj);
            } else {
                $obj.load(function() {
                    transform($(this));
                });
            }
        }); 
		
	};
	
});(jQuery);   