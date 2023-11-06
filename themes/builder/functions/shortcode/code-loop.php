<?php 
# ARTICLES
# article functions and features
## theme_placeholder()

/*------------------------------------------------*/

/* #region ~ recent, relationship, random */

function el_loop($field='', $array=array()) { 

    $default = array( 
        'type'      => 'recent', /* recent, relationship, random */
        'div'       => 'col-md-4',
        'count'     => 0,
        'col'       => 4,
        'row'       => false,
        'echo'      => true,
        'post_type' => 'post'
    ); 

    $output = '';
    $data = '';

    $param = array_merge($default, $array);

    $col       = $param['col'];
    $type      = $param['type'];
    $count     = $param['count'];
    $rp        = $field;
    $post_type = $param['post_type'];
    $colmd     = $param['div'];


    if($type == 'recent'):

        if(is_admin())
            $count = $col;

        $custom_query_args = array(
            'post_type' => $post_type,
            'posts_per_page' => $count,            
            'orederby' => 'date',
            'order' => 'DESC'
        );
    
        $custom_query = new WP_Query( $custom_query_args );             

        while( $custom_query->have_posts() ) : $custom_query->the_post();
        global $post;
        $id = $post->ID;

            $data = grid_cpt_display($id);
            if($post_type == 'post')
                $data = grid_post_display($id);

            $output .= tag_wrap($colmd, $data);

        endwhile;
        wp_reset_postdata();
    endif;


    if($type == 'relationship'):
        if($rp):
            $i = 0;
            foreach($rp as $id):

                $data = grid_cpt_display($id);

                if($post_type == 'post')
                    $data = grid_post_display($id);

                $output .= tag_wrap($colmd, $data);                  
                
                if(is_admin()) {
                    if($i == $col) break;
                }

            endforeach;
        endif;                
    endif;


    if($type == 'random'):

        if(is_admin())
            $count = $col;        

        $custom_query_args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
            '_shuffle_and_pick' => $count
        );
    
        $custom_query = new \WP_Query( $custom_query_args );    

        while( $custom_query->have_posts() ) : $custom_query->the_post();
        global $post;
        $id = $post->ID;

            $data = grid_cpt_display($id);
            
            if($post_type == 'post')
                $data = grid_post_display($id);

            $output .= tag_wrap($colmd, $data);                

        endwhile;
        wp_reset_postdata();        
    endif;

    #if row
    if($param['row'] == true)
        $output = tag_wrap('row', $output);

    if($param['echo'] == true)
        echo $output;

    return $output;    
}

/* #endregion */
