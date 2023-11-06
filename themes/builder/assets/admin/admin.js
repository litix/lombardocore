function checkImage(urlToFile)
{
    var xhr = new XMLHttpRequest();
    xhr.open('HEAD', urlToFile, false);
    xhr.send();

    if (xhr.status == "404") {
        return false;
    } else {
        return true;
    }
}

(function($){
    function changeImages() {
        
        var tt = $('.acf-tooltip ul li a');
        
        $(tt).hover(function(){ 
            const imageLayoutSlug = $(this).attr('data-layout');
            const imageSource = adminLocal.directory + '/images/preview/' + imageLayoutSlug + '.png';
           
            if ( checkImage( imageSource ) ) {
                $('.acf-tooltip').append('<div class="module-preview"><img src="'+imageSource+'" alt=""></div>')
            }           
        }, function(){
            if ( $('.module-preview').length ) {
                $('.module-preview').remove();
            }
        });
    }
   
    function checkDOMChange() {
        let toolTips = document.querySelectorAll('.acf-tooltip ul li');

        if (toolTips.length) {
            changeImages(toolTips);
        } else {
            setTimeout( checkDOMChange, 100 );
        }
    }
   
    function init(){
        $(document).on('click', 'a[data-name=add-layout]', () => {
            checkDOMChange();
        })
    }
   
    $(document).ready(init);
})(jQuery)