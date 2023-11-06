var $ = jQuery.noConflict();
$(document).ready(function($){
    
    $('.ajax_post').on( 'click', function() {

    	var dbutton = $(this),
		  data = {
			 'action'  : 'loadmore',
			 'query'   : ajax_params.posts, 
			 'page'    : ajax_params.current_page,
             'p_type'  : ajax_params.post_type,
             'p_count' : ajax_params.post_count,
             'p_cat'   : ajax_params.cat
		  };
       
        var ajax_grid = $('.ajax_grid');
        
        $.ajax({
            url  : ajax_params.ajaxurl,
            data : data,
			type : 'POST',            
        
            beforeSend : function ( xhr ) {
                dbutton.text('Loading Posts...'); 
            },        
            
            success : function( data ){
                if( data ) {     
                    ajax_grid.append( data );   /* adds the load handler */
                    ajax_params.current_page++; /* add page by 1 */
                    
                    dbutton.text( 'Load More' ); 
                    
                    if(ajax_params.current_page == ajax_params.max_page) {
                        //dbutton.remove();
                    } 
                    
                } else {
                       dbutton.text( 'Load More' ); 
                       dbutton.hide();
                       
                }
            }
        
        });
        
    });
    
    $('.ajax_category').on( 'click', function() {
        
        var cat_id = $(this).data("id");
        var cat_title = $(this).data("title");
        
    	var dbutton = $(this),
		  data = {
			 'action'  : 'loadmore',
			 'query'   : ajax_params.posts, 
			 'page'    : 0,
             'p_count' : ajax_params.post_count,
             'p_cat'   : cat_id
		  };
       
        var ajax_grid = $('.ajax_grid');
        
        $.ajax({
            url  : ajax_params.ajaxurl,
            data : data,
			type : 'POST',            
        
            beforeSend : function ( xhr ) {
                dbutton.text('Loading...'); 
            },        
            
            success : function( data ){
                if( data ) {     
                    ajax_grid.html( data );     /* replace the data */
                    
                    dbutton.text( cat_title );
                    
                    $('.ajax_post').attr("data-id", cat_id);
                    
                    ajax_params.current_page = 1 /*  set page to 1 */
                    ajax_params.cat = cat_id     /*  change the category id */
                    //ajax_params.current_page = 2;  /*  after initial data (page + 1) */
                    
                    $('.ajax_post').show();
                }
            }
        
        });
        
    });    
    
});