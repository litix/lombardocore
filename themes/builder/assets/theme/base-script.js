/* 
    This File is not the place for adding your scripts
    please go to : ## LINK script.js
*/
var $ = jQuery.noConflict();
$(function () {

    //LAZYLOAD
    LL = new LazyLoad({ elements_selector: ".bg-lazy, .lazy" });
    // LL.update(); //when you async    

    // PREVENT DOUBLE TAP ON DEVICES
   document.addEventListener("touchstart", function () {}, false);
   

    // REMOVE ADDED STYLES FROM SETTINGS

    $.fn.styleremove = function() {
        $('div:not(.lazy, [style*="display"], [style*="width"], [style*="transform"], [style*="height"])[style]').each(function() {
            var el = $(this);
            if(el.length > 0) {
                var w = el.attr("style");
                el.attr('data-style', w);
                el.removeAttr("style");
            }
        });
    }; 

    $.fn.stylerestore = function() {
        $('div[data-style]').each(function() {
            var el = $(this);
            var w = $(this).data("style");
            el.attr('style', w);
        });
    }; 

    //REMOVE LAYOUT STYLES - control by lib-style...
    $(window).on('resize', function(){
        var win = $(this); //this = window

        if (win.width() < 1080) {  
            $.fn.styleremove();
        } else {
            $.fn.stylerestore();
        }

    });

    //CSS UNIFORM RESET
    var screen = $(window);

        if (screen.width() < 1080) {
            $.fn.styleremove();
        } else {
            $.fn.stylerestore();
        }

    //FANCYBOX 
    // <a class="anchor" data-fancybox data-width="" data-height="">foo</a>
    Fancybox.bind("[data-fancybox]", { 
        Toolbar: false, 
        hideScrollbar: false,
    });

    //GROUP  
    //Fancybox.bind("a.member", { Toolbar: false, });  

    // MATCH HEIGHT
    // usage : <div class="same-h">Foo</div>
    if(document.querySelector(".same-h")) { $(".same-h").matchHeight(); }
    if(document.querySelector(".match-h")) { $(".match-h").matchHeight(); }

    // ACNHOR
    // <a class="anchor" target="#foo">foo</a>

    
    $(".anchor").click(function(event) {
        event.preventDefault();

        $("html, body").animate({
            scrollTop: $($(this).attr("href")).offset().top - 120
        }, 500);
    });


    // If BOOTSTRAP is loaded we remove data-toggle 
    if (!$.fn.modal) { 
        console.log("Bootstrap is NOT loaded");
    } else {
        console.log("Bootstrap is loaded");
        $('.dropdown-item-0.dropdown-toggle').removeAttr("data-toggle");
    }


}); 

 