<?php 
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## parameters
    $theme = $e['theme'];
    $bgcolor = $e['bg_color'];

    $opacity = $e['media_opacity'];  
    $opacity = field_opacity($opacity, 0);
    

    section_fire(
        array(
            'otheme'=>$theme, 
            'ocolor'=>$bgcolor,
        )
    );

    ## start the fire
    global $fire;
    $fire = create_fire($e['sections']);

    ## leave an admin message
    if(is_admin()) {
        $amt = $fire - 1;
        echo "<div class=\"text-center p-4\">Background Setup for : {$amt} Sections (below)</div>";
    }

    ## bgcolor as overlay
    $bg_color = $e['background_color'];

    if($bg_color) {
        $style = array(
            'background-color'=>$bg_color
        );
        el_overlay('', array('style'=>$style));
    }

    ## create the background image
    $background = $e['media'];
    if(check_media($e['media']) == true) {
        el_media($e['media'], array('as'=>'overlay', 'style'=>$opacity));
    }
?>




