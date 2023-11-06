console.log(document);
var $ = jQuery.noConflict();

$(function () {
    
    /*------------------------------------------------*/
    /* POP UP : FANCYBOX / POPOVER                    */
    /*------------------------------------------------*/
    if (document.getElementById('fancybox_js')) {    
        //-- Fancy Box --//
        $('[data-fancybox]').fancybox({
            toolbar  : false,
            smallBtn : true
        });
    }
    
    
    //-- Popover --//
    $('[data-toggle="popover"]').popover({
        trigger : 'focus',
        animation: true,
        placement : 'top',
        html : true,
        title : function() {
                     return $(this).find(".pop-title").html();
                },   
        content : function() {
                     return $(this).find(".pop-body").html();
                }    
    });
    
    $('.popover-dismiss').popover({
        trigger: 'focus'
    }) 
    
    /*------------------------------------------------*/
    /* BS MODAL                                       */
    /*------------------------------------------------*/

    $('.bs-modal').each(function(e){ 
        var href = $(this).attr('href');
        $(this).removeAttr("href");
        $(this).attr("data-toggle", "modal");
        $(this).attr("data-target", href);
    });    
    
});    

/*------------------------------------------------*/
/* GRAVITY FORM                                   */
/*------------------------------------------------*/
/* Gravity Forms Setting -> Output HTML5 -> Yes */
/* add form control on input */

$(function () {
    $('.ginput_container input').addClass('form-control');         
    $('.ginput_container select').addClass('form-control');
    $('.ginput_container textarea').addClass('form-control');
    $('.ginput_container input[type=checkbox]').removeClass('form-control');

    /* validation */
    /*
    $(".required input").attr("required", true);  
    $(".required textarea").attr("required", true);  
    */
    $(".gfield_contains_required input").attr("required", true);
    $(".gfield_contains_required textarea").attr("required", true);

    $('.gform_button').addClass('btn btn-more-2 btn-rev');
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
    
    /*
    $('#jobModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var position = button.data('whatever') 
      var modal = $(this)
      //modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body #input_2_2').val(position)
    })    
    */
}); 