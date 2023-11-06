<?php 
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $page = $e['page'];
    $layout = 'layout'; //ie. layout / dev_layout 
    $dlayout = 'your_element_name'; //ie. row_content_rc01    

    if( have_rows($layout, $page) ): 
        while( have_rows($layout, $page) ): the_row();
            if( get_row_layout() == $dlayout ):
            $e = get_sub_field($dlayout);        
?>
 
            <!-- code elemets goes here -->    
 
<?php 
            endif;
        endwhile; 
    endif; 
?> 