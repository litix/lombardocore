<?php 
/* LOOP FUNCTIONS */

/*------------------------------------------------*/
/* RANDOM BY SHUFFLE QUERY                        */
/*------------------------------------------------*/

add_filter( 'the_posts', function( $posts, \WP_Query $query ) {
    if( $pick = $query->get( '_shuffle_and_pick' ) )
    {
        shuffle( $posts );
        $posts = array_slice( $posts, 0, (int) $pick );
    }
    return $posts;
}, 10, 2 );

/** 
usage:
      $custom_query_args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        '_shuffle_and_pick' => 3 //selects 3  
      );

      $custom_query = new \WP_Query( $custom_query_args );
**/

/*------------------------------------------------*/
/* POST PAGINATION                                */
/*------------------------------------------------*/

function pp_pagination_nav() {
	if( is_singular() )
	return;
	
	global $wp_query;
	
	if( $wp_query->max_num_pages <= 1 )	return;
	
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max = intval( $wp_query->max_num_pages );
	
    if ( $paged >= 1 )	$links[] = $paged;
	
	if ( $paged >= 3 ) {
	$links[] = $paged - 1;
	$links[] = $paged - 2;
	}
	
	if ( ( $paged + 2 ) <= $max ) {
	$links[] = $paged + 2;
	$links[] = $paged + 1;
	}
	
	echo '<div class="paginate"><ul class="pagination">' . "\n";
	
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link($label = fa_icon('double_left') . '<span class="novisual">Prev</span>') );
	
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, 
               esc_url( get_pagenum_link( 1, false ) ), '1' );
		if ( ! in_array( 2, $links ) )
		echo '<li>…</li>';
	}
	
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, 
               esc_url( get_pagenum_link( $link, false ) ), $link );
	}
	
	if ( ! in_array( $max, $links ) ) {
	if ( ! in_array( $max - 1, $links ) )
		echo '<li>…</li>' . "\n";
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link($label = fa_icon('double_right') . '<span class="novisual">Next</span>') );
	echo '</ul></div>' . "\n";
}

/**
    <div class="post-pagination  clearfix">
        <?php pp_pagination_nav(); ?>
    </div>
**/
?>