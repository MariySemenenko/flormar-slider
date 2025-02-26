
;(function($) {
    $(function() {
		
jQuery(document).ready(function($) {
    
    $('.flormar-slider').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
		autoplay: true, 
        autoplaySpeed: 3000,
		dots: false,
        arrows: true,
		prevArrow: '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg width="30" height="30" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg></button>',
        nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg width="30" height="30" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg></button>', 
        responsive: [
		{
            breakpoint: 1024, 
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false
            }
        },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false 					
                }
            }
        ]
    });
});

});
})(jQuery);