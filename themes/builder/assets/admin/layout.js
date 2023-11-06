var $ = jQuery.noConflict();

/*------------------------------------------------*/
/* #region                                        */
/*------------------------------------------------*/

(function($){

    /* #region - ELEMENTS 3.2 */

    /* #endregion */

    /*
    var opacity = $('.overlay[data-opacity]').data("opacity");
    var opacity = opacity + '%';
    $('.overlay[data-opacity]').css('opacity', opacity);


    var hslink = '<li><a href="#" class="btn_toggler">Show</a></li>';
    $(".acf-field-setting-fc_layout ul.acf-fl-actions").append(hslink);

    $(".acf-field-object-flexible-content .acf-field-setting-fc_layout").addClass('dhide');

    $(".btn_toggler").click(function(event) {
        $(this).parentsUntil('.acf-field').parent().toggleClass('dhide');
        //$(this).animate({ opacity: 'toggle' }, 'slow');

        var text = $(this).text();
        $(this).text(
            text == "Show" ? "Hide" : "Show");
    });

    $('.acf-field-object-flexible-content .add-layout').click(function(event) {
        $(this).parentsUntil('.acf-field').parent().removeClass('dhide');

        var text = $(this).siblings('.btn_toggler').text();
        $(this).siblings('.btn_toggler').text(
            text == "Show" ? "Hide" : "Show");
    });

    $('.acf-field-object-flexible-content .duplicate-layout').click(function(event) {
        $(this).parentsUntil('.acf-field').parent().removeClass('dhide');

        var text = $(this).siblings('.btn_toggler').text();
        $(this).siblings('.btn_toggler').text(
            text == "Show" ? "Hide" : "Show");
    });
    */

    /* NOTE ~ cheatingly hide the Adv Flex Content */

    var fxa = $('.acf-field-acfe-flexible-advanced');
    $(fxa).siblings('div:not(.acf-field-setting-fc_layout)').hide();
    
    $(fxa).find('.acf-switch-input').click(function() { 
        $(fxa).siblings('.acf-field-true-false').css('display', 'flex');
        $(fxa).siblings('.acf-field-checkbox, .acf-field-group, .acf-field-radio').show();       
    });


    $('div[data-anon="title"]').parent().parent().addClass('li-title');
    $('div[data-anon="text"]').parent().parent().addClass('li-text');
    $('div[data-anon="block"]').parent().parent().addClass('li-block');
    $('div[data-anon="image"]').parent().parent().addClass('li-image');    
    $('div[data-anon="media"]').parent().parent().addClass('li-media');
    $('div[data-anon="bg"]').parent().parent().addClass('li-bg');     

    
    /* NOTE ~ add accordion icon */

    function init_add() {
        var acc_icon = '<i class="acf-iconer accordion-icon"></i>';
        $('.acf-field-accordion .acf-accordion-title label').prepend(acc_icon);
    }

    function init(){
        LL = new LazyLoad({ elements_selector: ".bg-lazy, .lazy" });   

        $(document).on('click', '.acfe-flexible-stylised-button a[data-name=add-layout]', () => {
            changeThumbs();
        })

        init_add();
    }

    function changeThumbs() {
        //var layout_thumb = $('.acfe-modal-select-dev_layout').find('.acfe-flex-thumbnails a');
        var layout_thumb = $('.acfe-modal-select-dev_layout, .acfe-modal-select-layout').find('.acfe-flex-thumbnails a');
        $(layout_thumb).each(function(){
            var layout_slug = $(this).attr('data-layout');        
            var thumbSource = adminLocal.directory + '/images/preview/' + layout_slug + '.png';
            $(this).find('.acfe-flexible-layout-thumbnail').css("background-image", 'url("' + thumbSource + '")');          
        });      
    }

    $(document).ready(init);

})(jQuery)

/* #endregion */
/*------------------------------------------------*/