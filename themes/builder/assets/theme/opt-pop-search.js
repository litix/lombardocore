var $ = jQuery.noConflict();

$(function () {   

    /*
    ## POP SEARCH
    ## LINK functions/shortcode/short-code-theme.php
    */
    $('.pop-search [data-trigger]').click(function (e) {

        e.preventDefault();
        $(this).toggleClass('active');
        $(this).parent().children('.show-search').fadeToggle(function () {
            
            $('html').bind('click', function () {
                $('.show-search').fadeOut(function () {
                    $('html').unbind('click');
                });
                
                $('.pop-search [data-trigger]').removeClass('active');
            });
            
            $('.show-search').bind('click', function (e) {
                e.stopPropagation();
            });
        });
        
    });   

}); 