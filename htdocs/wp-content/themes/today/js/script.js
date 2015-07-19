(function ($) {
	$(document)
		.ready(function () {
		
			// -------------------------------------------------------------------------------------------------------
			// Rotator
			// -------------------------------------------------------------------------------------------------------				
			jQuery('#short-two').showbizpro({
					dragAndScroll: "on",
					visibleElementsArray: [3, 3, 2, 1],
					carousel: "off",
					entrySizeOffset: 0,
					allEntryAtOnce: "off",
					ytMarkup: "<iframe src='http://www.youtube.com/embed/%%videoid%%?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0&amp;autoplay=1'></iframe>",
					vimeoMarkup: "<iframe src='http://player.vimeo.com/video/%%videoid%%?title=0&amp;byline=0&amp;portrait=0;api=1&amp;autoplay=1'></iframe>",
				});
				
			jQuery('#short-three').showbizpro({
					dragAndScroll: "on",
					visibleElementsArray: [3, 3, 2, 1],
					carousel: "off",
					entrySizeOffset: 0,
					allEntryAtOnce: "off",
					ytMarkup: "<iframe src='http://www.youtube.com/embed/%%videoid%%?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0&amp;autoplay=1' height='100px'></iframe>",
					vimeoMarkup: "<iframe src='http://player.vimeo.com/video/%%videoid%%?title=0&amp;byline=0&amp;portrait=0;api=1&amp;autoplay=1'></iframe>",
				});
				
			jQuery('#short-five').showbizpro({
					dragAndScroll: "on",
					visibleElementsArray: [3, 3, 2, 1],
					carousel: "off",
					entrySizeOffset: 0,
					allEntryAtOnce: "off",
					ytMarkup: "<iframe src='http://www.youtube.com/embed/%%videoid%%?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0&amp;autoplay=1' height='100px'></iframe>",
					vimeoMarkup: "<iframe src='http://player.vimeo.com/video/%%videoid%%?title=0&amp;byline=0&amp;portrait=0;api=1&amp;autoplay=1'></iframe>",
				});
				
			jQuery('.widget-blog-two').showbizpro({
					dragAndScroll: "on",
					visibleElementsArray: [3, 3, 2, 1],
					carousel: "off",
					entrySizeOffset: 0,
					allEntryAtOnce: "off",
					ytMarkup: "<iframe src='http://www.youtube.com/embed/%%videoid%%?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0&amp;autoplay=1' height='100px'></iframe>",
					vimeoMarkup: "<iframe src='http://player.vimeo.com/video/%%videoid%%?title=0&amp;byline=0&amp;portrait=0;api=1&amp;autoplay=1'></iframe>",
				});
				
			jQuery('.bl3page-archive').showbizpro({
					dragAndScroll: "on",
					visibleElementsArray: [3, 3, 2, 1],
					carousel: "off",
					entrySizeOffset: 0,
					allEntryAtOnce: "off",
					ytMarkup: "<iframe src='http://www.youtube.com/embed/%%videoid%%?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0&amp;autoplay=1' height='100px'></iframe>",
					vimeoMarkup: "<iframe src='http://player.vimeo.com/video/%%videoid%%?title=0&amp;byline=0&amp;portrait=0;api=1&amp;autoplay=1'></iframe>",
				});
				
			// -------------------------------------------------------------------------------------------------------
			// First word
			// -------------------------------------------------------------------------------------------------------	
			$('.sidebarnav h3')
				.each(function () {
					var h = $(this)
						.html();
					var index = h.indexOf(' ');
					if (index == -1) {
						index = h.length;
					}
					$(this)
						.html('<div style="font-weight:300; display:inline;">' + h.substring(0, index) + '</div>' + h.substring(index, h.length));
				});
				
			$('.short-title h3')
				.each(function () {
					var h = $(this)
						.html();
					var index = h.indexOf(' ');
					if (index == -1) {
						index = h.length;
					}
					$(this)
						.html('<div style="font-weight:300; display:inline;">' + h.substring(0, index) + '</div>' + h.substring(index, h.length));
				});
				
			$('.title-head h1')
				.each(function () {
					var h = $(this)
						.html();
					var index = h.indexOf(' ');
					if (index == -1) {
						index = h.length;
					}
					$(this)
						.html('<div style="font-weight:300; display:inline;">' + h.substring(0, index) + '</div>' + h.substring(index, h.length));
				});
				
			$('.footer-col h3')
				.each(function () {
					var h = $(this)
						.html();
					var index = h.indexOf(' ');
					if (index == -1) {
						index = h.length;
					}
					$(this)
						.html('<div style="font-weight:300; display:inline;">' + h.substring(0, index) + '</div>' + h.substring(index, h.length));
				});
			
			// -------------------------------------------------------------------------------------------------------
			// Image hover
			// -------------------------------------------------------------------------------------------------------
			$(".photo-preview img").fadeTo(1, 1);
			$(".photo-preview img").hover(
					function () {
						$(this).fadeTo("fast", 0.70);
					}, function () {
						$(this).fadeTo("slow", 1);
					});
					
			$(".flickr_badge_image img").fadeTo(1, 1);
			$(".flickr_badge_image img").hover(
					function () {
						$(this).fadeTo("fast", 0.70);
					}, function () {
						$(this).fadeTo("slow", 1);
					});
					
			// -------------------------------------------------------------------------------------------------------
			// Tabs
			// -------------------------------------------------------------------------------------------------------
			$("#tabs ul").idTabs();
			
			// -------------------------------------------------------------------------------------------------------
			// Menu responsive
			// -------------------------------------------------------------------------------------------------------	
			$('.menu').slicknav();
						
			// -------------------------------------------------------------------------------------------------------
			// Toggle
			// -------------------------------------------------------------------------------------------------------
			$("#tabs ul")
				.idTabs();
			$(".toggle_container")
				.hide();
			$(".trigger")
				.click(function () {
					jQuery(this)
						.toggleClass("active")
						.next()
						.slideToggle("fast");
					return false; //Prevent the browser jump to the link anchor
				});
				
		});
})(window.jQuery);