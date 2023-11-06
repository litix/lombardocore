var $ = jQuery.noConflict();
$(function () {

    //Mobile Menu Accordion
    if (document.querySelector(".menu-links.is-mobile")) {

        var mobile_link = $(".menu-links.is-mobile");

        $(mobile_link).click(function() {

            var is_open = $(this).hasClass("open");

            if (is_open) {
              $(this).removeClass("open");
            } else {
              $(this).addClass("open");
            }

        });
          
        $(document).mouseup(function(event) {
          
            var target = event.target;
            var select = $(mobile_link);
          
            if (!select.is(target) && select.has(target).length === 0) {
              select.removeClass("open");
            }
          
        });
    }    

});