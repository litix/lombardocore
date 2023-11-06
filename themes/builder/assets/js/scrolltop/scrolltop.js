var $ = jQuery.noConflict();
$(function () {

    if (document.querySelector(".scroll-up")) {

        $(window).scroll(function () {
            if ($(this).scrollTop() > 80) {
                $('.scroll-up').fadeIn();
            } else {
                $('.scroll-up').fadeOut();
            }
        });    

        $('.scroll-up a').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        }); 

    }

}); 