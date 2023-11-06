var $ = jQuery.noConflict();

$(function () {   

    /*
    ## NEWS/WELCOME Ticker 
    ## LINK functions/shortcode/short-code-util.php
    */
    $("#top-ticker .svg-close").click(function(event) {
        $('#top-ticker').slideUp(200);
    });

    if (document.querySelector(".owl-ticker")) {
        var owl_tick = $('.owl-ticker');
        owl_tick.owlCarousel({
            autoplay:   true,
            loop:       true,
            margin:     0,
            nav:        false,
            dots:       false,
            items:      1,
            mouseDrag:  false,
            autoplayHoverPause: true,
        });

        $('.next-1').click(function() {
            owl_tick.trigger('next.owl.carousel');
        })
    
        $('.prev-1').click(function() {
            owl_tick.trigger('prev.owl.carousel');
        })  
    }  

}); 