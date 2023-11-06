<?php 
#region - HTML DATA
function ajax_loop_html($en, $id) {
    $data_out = apply_filters($en, $id);    
    return $data_out; 
}
#endregion

#region - TAXONOMY 
    //No TOUCH
    function ajax_loop_cat($ID, $cat, $taxname) {

        if($taxname != ''):
            if($cat != '')
                $tax = array( 
                    'tax_query' => array( 
                        array( 
                            'taxonomy' => $taxname, 
                            'field' => 'term_id', 
                            'terms' => $cat 
                        )
                    ) 
                );
                    
            if($cat == 'all') 
                $tax = array();
        endif;

        if($taxname == 'post'):
            if($cat != '')
                $tax = array( 'cat' => $cat );

            if($cat == 'all')
                $tax = array();
        endif;

        return $tax;
    }
#endregion

#region - AJAX LOADER
    //LOAD MORE  BUTTON
    function ajax_load($args) {
        global $wp_query, $post;
        global $t_assets, $vendor, $tpath;
        
        wp_register_script('ajax_click', $t_assets . 'ajax/ajax-click.js','','1.0'); 
        
        $COUNT = $args['count'];
        $CPT = $args['type'];
        $QUERY = $args['query'];
        $CTR = $args['ctr'];
        $TAXID = $args['tax_id'];
        $TAXNAME = $args['tax_name'];

        $custom_query = new WP_Query( $QUERY ); 
        $ajax_params = "ajax_params_{$CTR}";

        wp_localize_script( 'ajax_click', $ajax_params, 
            array(
                "ajaxurl"      => site_url() . '/wp-admin/admin-ajax.php', 
                "posts"        => json_encode( $custom_query->query_vars ), 
                "current_page" => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
                "max_page"     => $custom_query->max_num_pages,
                "post_type"    => $CPT,
                "post_count"   => $COUNT,
                "tax_id"       => $TAXID,
                "tax_name"     => $TAXNAME,
                "ID"           => $CTR,
                "Q"            => $QUERY
            ) 
        );    
        
        wp_enqueue_script( 'ajax_click',      '','','',$in_footer=true); 
    
    }
#endregion

#region - AJAX LOADER
    //LOAD MORE  BUTTON
    function ajax_scroll($args) {
        global $wp_query, $post;
        global $t_assets, $vendor, $tpath;
        
        wp_register_script('ajax_scroll', $t_assets . 'ajax/ajax-scroll.js','','1.0'); 
        
        $COUNT = $args['count'];
        $CPT = $args['type'];
        $QUERY = $args['query'];
        $CTR = $args['ctr'];
        $TAXID = $args['tax_id'];
        $TAXNAME = $args['tax_name'];

        $custom_query = new WP_Query( $QUERY ); 
        $ajax_params = "ajax_params_{$CTR}";

        wp_localize_script( 'ajax_scroll', $ajax_params, 
            array(
                "ajaxurl"      => site_url() . '/wp-admin/admin-ajax.php', 
                "posts"        => json_encode( $custom_query->query_vars ), 
                "current_page" => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
                "max_page"     => $custom_query->max_num_pages,
                "post_type"    => $CPT,
                "post_count"   => $COUNT,
                "tax_id"       => $TAXID,
                "tax_name"     => $TAXNAME,
                "ID"           => $CTR,
                "Q"            => $QUERY
            ) 
        );    
        
        wp_enqueue_script( 'ajax_scroll',      '','','',$in_footer=true); 
    
    }    
#endregion

#region - DISPLAYER
    //No TOUCH
    function ajax_load_handler(){

        $cpt = $_POST['p_type'];
        $cat = $_POST['p_cat'];
        $ID = $_POST['ID'];
        $taxid = $_POST['tax_id'];
        $taxname = $_POST['tax_name'];
        $query = $_POST['Q'];     

        //default loop and page + 1
        $pager = array('paged' => $_POST['page'] + 1);
        $loop = array_merge($query, $pager);
        
        //taxonomy modifier
        $tax = array();

        if($cat) { $tax = ajax_loop_cat($ID, $cat, $taxname); } 
        if($taxid) { $tax = ajax_loop_cat($ID, $taxid, $taxname); } 

        //final args
        $argss = array_merge($loop, $tax); 
        //print_r($argss);     
        
        $the_query = new WP_Query( $argss );  
        if ( $the_query->have_posts() ) : 
        while ( $the_query->have_posts() ) : $the_query->the_post(); 

            global $post;
            $id = $post->ID;

            //$output = apply_filters('proj_1', $id);
            $data_out = ajax_loop_html($ID, $post->ID); //HTML

            echo $data_out;

        endwhile;
        endif;  

        //async lazyloader
        echo "<script>LL.update();</script>";

        die; 
    }

    add_action('wp_ajax_loadmore', 'ajax_load_handler'); 
    add_action('wp_ajax_nopriv_loadmore', 'ajax_load_handler'); 

#endregion




//----------------------------------------------------------------------------

#region - MULTIPLE LOADER

    //No TOUCH
    function ajax_menu_links($post_taxonomy, $post_type, $ajx_ctr, $post_count) {
        $li = "";
        $div1 = "
            <div class=\"desktop-view-lg tax-buttons\">
            <ul class=\"p-0 m-0 flexic none\">";
        $li_all = "
            <li>
                <a class=\"btn btn-2 btn-all ajax_category active\" 
                data-ctr=\"{$ajx_ctr}\"
                data-id=\"all\" 
                data-title=\"All\" 
                data-max=\"0\">
                    <span>All</span>
                </a>
            </li>";
            
        if($post_taxonomy != 'post'):

            $args = array(
                'show_option_none' => '',
                'hide_empty' => 0,
                'taxonomy' => $post_taxonomy
            );   

            $taxs = get_categories($args);

            $li = '';

            foreach ($taxs as $tax):

                $termid = $tax->term_id;        
                /* count the post */    
                $args = array(
                    'post_type' => $post_type,
                    'posts_per_page' => $post_count,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $post_taxonomy,
                            'field' => 'term_id',
                            'terms' => $termid
                            )
                    )
                );

                $the_query = new WP_Query( $args );
                $total = $the_query->max_num_pages;                        
                wp_reset_postdata();  
            
                $li .= "
                    <li>
                    <a class=\"btn btn-2 ajax_category\" 
                    data-id=\"{$tax->term_id}\" 
                    data-title=\"{$tax->name}\"
                    data-ctr=\"{$ajx_ctr}\" 
                    data-max=\"{$total}\">
                        <span>{$tax->name}</span>
                    </a>
                    </li>";

            endforeach;
        endif;       
        
        if($post_taxonomy == 'post'):

            $args = array(
                'parent'   => '0',
                'order'   => 'ASC',
                'hide_empty'   => '0'		  
            );      

            $cats = get_categories($args);

            foreach ($cats as $tax):
            
            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => $post_count,
                'cat' => $tax->term_id 
            );

            $the_query = new WP_Query( $args );
            $total = $the_query->max_num_pages;                        
            wp_reset_postdata();

                $li .= "
                    <li>
                    <a class=\"btn btn-2 ajax_category\" 
                    data-id=\"{$tax->term_id}\" 
                    data-title=\"{$tax->name}\"
                    data-ctr=\"{$ajx_ctr}\" 
                    data-max=\"{$total}\">
                        <span>{$tax->name}</span>
                    </a>
                    </li>";

            endforeach;
        endif;               

            $div2 = "</ul></div>";

        $out = $div1 . $li_all . $li . $div2;

        echo $out; 
    }

    //----------------------------------------------------------------------------    

    function ajax_menu_links_mobile($tax) {

        $span = '';
        $k = 0;

        $div1 = 
        '<div class="mobile-view-lg tax-select">
        <div class="custom-select-wrapper ">
            <div class="dcustom-select">
                <div class="custom-select__trigger"><span>Select Category</span>
                    <div class="arrow"></div>
                </div>
                <div class="custom-options">
                    <span class="custom-option selected" data-id="all">All</span>';

                if($tax != 'post'):
                    $categories = get_categories( array(
                        'show_option_none' => '',
                        'hide_empty' => 0,
                        'taxonomy' => $tax                        
                            //'parent'   => '0',
                            //'orderby' => 'name',
                            //'order'   => 'ASC',
                            //'hide_empty'   => '1'		  

                    ) );
                    $k = 1;    
                    foreach( $categories as $category ): 
                        $cat_id = $category->term_id;   
                        $cat_name = $category->name;        

                        $span .= "<span class=\"custom-option\" data-id=\"{$cat_id}\">{$cat_name}</span>";
                    
                        $k++;    
                    endforeach;     
                endif;        
                
                if($tax == 'post'):
                    $args = array(
                        'parent'   => '0',
                        'order'   => 'ASC',
                        'hide_empty'   => '0'		  
                    );      
            
                    $cats = get_categories($args);
            
                    foreach ($cats as $tax):
                        $cat_id = $tax->term_id;   
                        $cat_name = $tax->name;  
                    
                        $span .= "<span class=\"custom-option\" data-id=\"{$cat_id}\">{$cat_name}</span>";

                        $k++;    
                    endforeach;                      
                endif;          
                
        $div2 =                
        '</div>
        </div>
            </div>
                </div>';

        $out = $div1 . $span . $div2;
        echo $out;
    }

#endregion