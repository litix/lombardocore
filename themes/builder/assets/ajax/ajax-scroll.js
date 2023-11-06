var $ = jQuery.noConflict();
$(document).ready(function($){
    
	var canBeLoaded = true, 
	    bottomOffset = 2000; 
		// the distance (in px) from the page bottom when you want to load more posts
	
	
	$(window).scroll(function(){

		var seed = $('#seed');
        var CTR = seed.data("ctr");

		ajax_params = eval("ajax_params_" + CTR);

        var data = {
            'action': 'loadmore',
            'query': ajax_params.posts,
            'page': ajax_params.current_page,
            'p_type': ajax_params.post_type,
            'p_count': ajax_params.post_count,
            'max': ajax_params.max_page,
            'tax_id': ajax_params.tax_id,
            'tax_name': ajax_params.tax_name,
            'p_cat': ajax_params.cat, /* see line 119 */
            'ID': ajax_params.ID,
            'Q': ajax_params.Q,
        };

		if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ){

			var ajax_grid = $('.ajax_grid[data-grid="ajax_' + CTR + '"]');

			$.ajax({
				url  : ajax_params.ajaxurl,
				data : data,
				type : 'POST',  
				
				beforeSend: function( xhr ){
					// you can also add your own preloader here
					// you see, the AJAX call is in process, we shouldn't run it again until complete
					canBeLoaded = false; 
				},

				success:function(data){
					
					if( data ) {     
						ajax_grid.append( data );   
						canBeLoaded = true;
						ajax_params.current_page++; 
						if(ajax_params.current_page == ajax_params.max_page) {
							//dbutton.remove();
						} 
					
					} else {
						   
					}
					
				//	if( data ) {
				//		$('#main').find('article:last-of-type').after( data ); // where to insert posts
				//		canBeLoaded = true; // the ajax is completed, now we can run it again
				//		misha_loadmore_params.current_page++;
				//	}
					
				}
			});
		}
	});

    $('.ajax_category.btn-all').on('click', function() {
        var dbutton = $('.ajax_post');
        //ajax_params.current_page = 0;
        dbutton.html('<span>Load More</span>');
    });

    $('.ajax_category').on('click', function() {

        $('.ajax_category').removeClass('active');
        $(this).addClass('active');

        var cat_id = $(this).data("id");
        var cat_title = $(this).data("title");
        var max_post = $(this).data("max");
        var CTR = $(this).data("ctr");

        var dbutton = $('.ajax_post[data-ctr="' + CTR + '"]');
        dbutton.attr('data-max', max_post);

        ajax_params = eval("ajax_params_" + CTR);

        var catbutton = $(this);
        var data = {
            'action': 'loadmore',
            'query': ajax_params.posts,
            'page': 0,
            'p_type': ajax_params.post_type,            
            'p_count': ajax_params.post_count,
            'p_cat': cat_id,
            'tax_id': ajax_params.tax_id,
            'tax_name': ajax_params.tax_name,
            'ID': ajax_params.ID,    
            'Q': ajax_params.Q,
        };

        var ajax_grid = $('.ajax_grid[data-grid="ajax_' + CTR + '"]');

        $.ajax({

            url: ajax_params.ajaxurl,
            data: data,
            type: 'POST',

            beforeSend: function(xhr) {
                //catbutton.html('<span>Loading...</span>');
                $('#iloader .dots').show();
            },

            success: function(data) {
                if (data) {
                    ajax_grid.html(data); /* replace the data */

                    catbutton.html('<span>' + cat_title + '</span>');

                    dbutton.attr("data-id", cat_id);

                    ajax_params.current_page = 1; /*  set page to 1 */
                    ajax_params.cat = cat_id /*  change the category id */
                    //ajax_params.current_page = 2;  /*  after initial data (page + 1) */
                    //ajax_params.max_page = ajax_params.max_page - 1;

                        //dbutton.show();
                    
                    if (max_post == 1) {
                        //dbutton.hide();
                    }

                } else {
                    /* NO DATA */
                    ajax_grid.html('<div class="col-lg-12 text-center">No Post Available</div>');
                    catbutton.html('<span>' + cat_title + '</span>');
                    //dbutton.hide();
                }
            }

        });

    });	


	
    
});