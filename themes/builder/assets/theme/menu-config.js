/* -------------------------------------------
    Base MENU JS 1.2 | 01/01/2023
----------------------------------------------*/

var $ = jQuery.noConflict();

$(function () {   

    var screen = $(window);

    $('.dmenu-1, .dmenu-2').each(function() {
        $(this).mouseenter(function(e) {       
            var ss = $(this).siblings('a.dropdown-item').addClass('hoved');
        });

        $(this).mouseleave(function(e) {       
            var ss = $(this).siblings('a.dropdown-item').removeClass('hoved');
        });
        
    });         

    

    
    if(document.querySelector('nav[data-main-menu="options"]')){  

        /* HEIGHT */
        var nav_height = $('header.header-menu').height();

        /* MENUS */

        /* HOVER + CLICK ANIMATOR */
        $.fn.anibar_menu = function() {
            var current_dropdown = $(this).next(".dropdown-menu");
            var item = $('.navbar[data-drop="animate"]').data("item");
            console.log(item);

            if(item == 'single') {
                current_dropdown.children(".menu-item").each(function(index){
                    ctr = (index + 1 ) * 60;    

                    if(nav_animate_mov == 'rotatex') {  
                        $(this).css("animation", 'rotateX 400ms ' + ctr + 'ms ease-in-out forwards');
                    }
                    if(nav_animate_mov == 'dropy') {
                        $(this).css("animation", 'slideDown 300ms ' + ctr + 'ms ease-in-out forwards');
                    }
                    if(nav_animate_mov == 'translatez') {
                        $(this).css("animation", 'rotateZ 300ms ' + ctr + 'ms ease-in-out forwards');
                    }
                    if(nav_animate_mov == 'scale') {
                        $(this).css("animation", 'scaleZ 300ms ' + ctr + 'ms ease-in-out forwards');
                    }
                    if(nav_animate_mov == 'rampxy') {
                        $(this).css("animation", 'translateX 300ms ' + ctr + 'ms ease-in-out forwards');
                    }

                });  
            }
            
            if(item == 'group') {
                if(nav_animate_mov == 'rotatex') {
                    current_dropdown.css("animation", 'rotateMenu 400ms ease-in-out forwards');
                }
                if(nav_animate_mov == 'dropy') {
                    current_dropdown.css("animation", 'growDown 300ms ease-in-out forwards');
                }
                if(nav_animate_mov == 'translatez') {
                    current_dropdown.css("animation", 'downOut 300ms ease-in-out forwards');
                }
                if(nav_animate_mov == 'scale') {
                    current_dropdown.css("animation", 'growOut 300ms ease-in-out forwards');
                }
                if(nav_animate_mov == 'rampxy') {
                    current_dropdown.css("animation", 'rotateY 300ms ease-in-out forwards');
                }            
            }

        }

        /* ANIMATED HOVER */
        var nav_animate_hover = '.navbar[data-drop="animate"][data-trigger="hover"]';

        if(document.querySelector(nav_animate_hover)) {
            var nav_animate_mov = $(nav_animate_hover).data("move");

            $(nav_animate_hover + ' .dropdown-item-0').hover(function(e){
                $(this).anibar_menu();
            });       
        }

        /* ANIMATE CLICK */
        var nav_animate_click = '.navbar[data-drop="animate"][data-trigger="click"]';
        var nav_animate_drop = $(nav_animate_click).data("drop");

        if(document.querySelector(nav_animate_click)) {
            var nav_animate_mov = $(nav_animate_click).data("move");

            $(nav_animate_click + ' .dropdown-item-0').removeAttr("href");
            
            $(nav_animate_click + ' .dropdown-item-0').click(function(e){
                var current_dropdown = $(this).next(".dropdown-menu");
                
                $(".dropdown-menu").not(current_dropdown).removeClass("shown");            
                current_dropdown.toggleClass("shown");

                $(this).anibar_menu();
                return false
            });     
            
            $(document).click(function(e) {       
                var target = e.target;
                if(nav_animate_drop == 'animate') { $('.dmenu-0').removeClass("shown"); } 
            });        
            
        }    


        /* NORMAL CLICK */
        var normal_click = '.navbar[data-trigger="click"]';
        var normal_click_drop = $(normal_click).data("drop");

        if(document.querySelector(normal_click)) {

            if(normal_click_drop != 'animate') {

                $(normal_click + ' .dropdown-item-0').removeAttr("href");

                $(normal_click + ' .dropdown-item-0').click(function(e){
                    var en = normal_click_drop;
                    var current_dropdown = $(this).next(".dropdown-menu");

                    if(en == 'default') {
                        $(".dropdown-menu").not(current_dropdown).hide();
                        current_dropdown.toggle();
                    }
            
                    if(en == 'slide') {
                        $(".dropdown-menu").not(current_dropdown).slideUp();
                        current_dropdown.slideToggle();
                    }
                    
                    if(en == 'fade') {
                        $(".dropdown-menu").not(current_dropdown).fadeOut();
                        current_dropdown.fadeToggle();
                    }                               
            
                    return false;  
                });

                $(document).click(function(e) {       
                    var screen = $(window);
                    if (screen.width() > 1080) {
                        var target = e.target;
                        if(normal_click_drop == 'default') { $('.dmenu-0').hide(); }    
                        if(normal_click_drop == 'slide')   { $('.dmenu-0').slideUp(); }    
                        if(normal_click_drop == 'fade')    { $('.dmenu-0').fadeOut(); }    
                    }
                });

            } // != animate
        }

        /* NORMAL HOVER */
        var normal_hover = '.navbar[data-trigger="hover"]';
        var normal_hover_drop = $(normal_hover).data("drop");

        if(document.querySelector(normal_hover)) {
            if(normal_hover_drop != 'animate') {

                $(normal_hover + ' .dropdown').hover(function(e){
                    if(normal_hover_drop == 'default') {
                        /* css show */
                    }    
                    if(normal_hover_drop == 'slide') {
                        $(this).children(".dmenu-0").stop().slideToggle();
                    }    
                    if(normal_hover_drop == 'fade') {
                        $(this).children(".dmenu-0").stop().fadeToggle();
                    }    
                });
            } // != animate
        }

        var topdistance = $(document).scrollTop();
    }

    if(document.querySelector('header[data-header="options"]')){    

        /* STICKY MENU */    
        var tick_height = $('#top-ticker').height();
        var nav_pos = $('header.header-menu').offset().top + (nav_height / 2);

        if (document.querySelector(".admin-bar")) { 
            nav_pos = nav_pos - 32;
        }
        //var nav_pos = nav_height;


        var stickyhead = document.querySelector('header[data-sticky="sticky"]');
        if (stickyhead) {
            var navfloat = document.querySelector("#navbar-float");

            /* add/remove classes when header is on top */
            if(!navfloat) {
                $(window).scroll(function () {          

                    if ($(this).scrollTop() > nav_pos) {
                        $('.header-menu').addClass("sticky-head");
                        $('.header-menu').removeClass("ontop");
                    } else {
                        $('.header-menu').removeClass("sticky-head");
                        $('.header-menu').addClass("ontop");
                    }          
                });
            }

            /* version 0 */
            var header_0 = document.querySelector('header.ver-0[data-sticky="sticky"]');
            if(header_0) {
                if (topdistance > nav_pos) {  
                    $(header_0).addClass("sticky-head");
                    $(header_0).removeClass("ontop");        
                } 
            }            
        }

        /* version - 1 FLOATING MENU */
        var navfloat = document.querySelector("#navbar-float");
        if (navfloat) {    
            $(window).scroll(function () {
                if ($(this).scrollTop() > nav_height) {
                    $('#navbar-float').addClass("float-menu-show");
                } else {
                    $('#navbar-float').removeClass("float-menu-show");
                }          
            });
        }

        /* version 1 - sticky */
        var stickyhead = document.querySelector('.ver-1[data-sticky="sticky"]');
        if (stickyhead) {

            var floater = $('#navbar-float');
            var header = $('header[data-sticky="sticky"');
            var top_head = $('.top_head');

            var topdistance = $(document).scrollTop();  
            var head_height = header.height() + top_head.height();
            
            var header_1a = document.querySelector('#navbar-float');
            if(header_1a) {
                if (topdistance > head_height) {  
                    $(floater).addClass("float-menu-show");
                } 
            }  
        }

        /* version 1 - sticky-fixed */
        var header_1b = document.querySelector('[data-sticky="sticky-fixed"]');
        if(header_1b) {
            
            var header = $('[data-sticky="sticky-fixed"]');
            var top_head = $('.top_head');
            var head_height = header.height();

            /* on refresh */
            var topdistance = $(document).scrollTop();  
            if (topdistance > head_height) { 
                $(header).addClass("sticky-me");
            } 

            /* on scroll */
            $(window).scroll(function () {
                var topdistance = $(document).scrollTop();      
                if (topdistance > head_height) {  
                    $(header).addClass("sticky-me");
                } else {
                    $(header).removeClass("sticky-me");
                }
            });
        }
    
    }   

    
    if(document.querySelector('div[data-mobile-menu="options"]')){
        /* MOBILE MENU */
        $('.menu-oc-right').click(function(){       
            $('body').toggleClass('remove_scroll');
        });  

        $('.menu-oc-right.opener').click(function(){ 
            $('#menu-oc-right').addClass('active');      
            $('#menu-oc-right').removeClass('inactive');
        });

        $('.menu-oc-right.closer').click(function(){ 
            $('#menu-oc-right').addClass('inactive');
            $('#menu-oc-right').removeClass('active');
        });   
        
        var chev_right = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10 fa-3x"><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" class=""></path></svg>';

        $(".mobile-menu .dropdown-menu").before('<a class="m-toggler dflex-center">'+chev_right+'</a>');

        $(".mobile-menu .m-toggler").click(function(e){
            e.stopPropagation();
            $(this).parent('.menu-item').siblings(".menu-item").children('.dropdown-menu').slideUp();
            $(this).parent('.menu-item').siblings(".menu-item").children('.m-toggler').removeClass("active");
            $(this).toggleClass("active");    
            $(this).siblings(".dropdown-menu").slideToggle();
            $(this).siblings(".dropdown-menu").toggleClass("active");
        }); 

        /* ACCESSIBILITY */
        $('.mobile-menu a.dropdown-item, .mobile-menu .nav-link').each(function() {
            var mobtitle = 'Mobile ' + $(this).attr("title");
            $(this).attr("title", mobtitle);
        });         

        $('.mobile-menu .dropdown-toggle[href="#"]').each(function(e) {
            $(this).removeAttr("href");  
            $(this).click(function(e){
                e.stopPropagation();
                $(this).parent('.menu-item').siblings(".menu-item").children('.dropdown-menu').slideUp();
                $(this).toggleClass("active");    
                $(this).siblings(".dropdown-menu").slideToggle();
                $(this).siblings(".dropdown-menu").toggleClass("active");
            });         
        }); 

        /*
        $('.element:not(header)').click(function(){       
            $('#menu-oc-right').removeClass('active');
        }); 
        */
    }


}); 