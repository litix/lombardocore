var $ = jQuery.noConflict();

$(function () {   

    //GRAVITY FORM with BS
    if (document.querySelector(".gform")) {
        $('.ginput_container input').addClass('form-control');
        $('.ginput_container select').addClass('form-control');
        $('.ginput_container textarea').addClass('form-control');
        $('.ginput_container input[type=checkbox]').removeClass('form-control');
        $(".gfield_contains_required input").attr("required", true);
        $(".gfield_contains_required textarea").attr("required", true);
        $('.gform_button').addClass('btn');

        var up = '.ginput_container_fileupload';
        if (document.querySelector(up)) {
            var upload_btn = $('<a class="dbutton btn btn-1 upload-btn"></a>').text('Upload');
            var par = $(up).parentsUntil('form');
            $(par).siblings('.gform_footer').children('.gform_button').before(upload_btn);

            $('.upload-btn').on("click", function(e) {
                e.stopPropagation();
                $('.ginput_container_fileupload input').click();
            });
        }
    }

}); 