<?php 
#SHORTCODES
# theme_info() | # theme_logos() | # theme_social() | # theme_footer()

// [google-reviews] [company-name] [company-about] [company-hours]
// [company-logo] [social-icons] [copyright] [web-design]

/* ----------------------------------------- */

/* #region ~ ABOUT */

## company name
function co_google_reviews($attr) {
    $args = shortcode_atts( array(
        'echo'  => 0,
        'pop'   => 'pop',
        'class' => 'btn-1',
    ), $attr );

    $e = theme_info();
    $acf = '';
    $output = '';

    if(isset($e['google_reviews']))
        $acf = $e['google_reviews'];

    $class = "btn {$args['class']}";
    $output = el_link($acf, array('echo'=>false, 'class'=>$class));

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('google-reviews', 'co_google_reviews');

## company name
function co_name($attr) {
    $args = shortcode_atts( array(
        'echo' => 0,
        'tag'  => 'div',
    ), $attr );

    $e = theme_info();
    $meta = '';

    $output = $e['company_name'];
    $output = tag_wrap('company-name', $output, $meta, $args['tag']); 

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('company-name', 'co_name');

## company about
function co_about($attr) {
    $args = shortcode_atts( array(
        'echo' => 0
    ), $attr );

    $e = theme_info();

    $output  = '';
    if(isset($e['about_title']))
        $output .= el_title($e['about_title'],array('echo'=>false, 'css'=>'dtitle'));

    if(isset($e['about']))
        $output .= el_text($e['about'],array('echo'=>false));

    $output  = tag_wrap('company-about', $output); 

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('company-about', 'co_about');

## company operating hours
function co_hours($attr) {
    $args = shortcode_atts( array(
        'echo' => 0
    ), $attr );

    $e = theme_info();

    $rp = '';
    if(isset($e['office_hours']))
        $rp = $e['office_hours'];

    $output = '';
    $meta = '';

    $i = 0;
    if($rp):   
        foreach($rp as $r):
            $output .= tag_wrap('oh-day', $r['day'], $meta);
            $output .= tag_wrap('oh-hrs', $r['hours'], $meta);
        endforeach;
    endif;     

    $output = tag_wrap('company-hours sc-hours', $output);

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('company-hours', 'co_hours');

/* #endregion */

/* ----------------------------------------- */

/* #region ~ LOGO */

function co_logo($attr) {
    $args = shortcode_atts( array(
        'echo'      => 0,
        'location'  => 'main', //main, sticky, footer
        'linked'    => 1,
        'lazy'      => true,
    ), $attr );

    global $tpath;   

    $logo = '';

    $e = theme_logos();
    
    switch($args['location']) {  
        case 'main':    
            if(isset($e['main_logo']))
                $logo = $e['main_logo'];
        break;            
        case 'sticky':        
            if(isset($e['sticky_logo']))
                $logo = $e['sticky_logo'];
        break;        
        case 'footer':    
            if(isset($e['footer_logo']))
                $logo = $e['footer_logo'];
        break;            
        default: 
            $logo = $tpath . '/images/placeholder/logo.svg';
    }    
    
    $home = home_url();
    $info = get_bloginfo();
    $linked = $args['linked'];
    
    if($logo == '')
        $logo = $tpath . '/images/placeholder/logo.svg';

    $el_logo = el_img($logo, array(
        'echo'  => false, 
        'lazy'  => $args['lazy'],
        'class' => 'logo',
        'alt'   => $info,
        'll'    => 2
    ));

    $link_attr = implode(" ", array(
        "data-location=\"{$args['location']}\"",
        "href=\"$home\"",
        "title=\"$info\"",
    ));

    $class = "navbar-brand {$args['location']}-logo";

    $output = ($linked == 1) ? tag_wrap($class,$el_logo,$link_attr,'a') : $el_logo;

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('company-logo', 'co_logo'); 

/* #endregion */

/* ----------------------------------------- */

/* #region ~ SOCIAL */

function social_icons($attr) {
    $args = shortcode_atts( array(
        'echo'  => 0,
        'title' => 0
    ), $attr );

    $output = '';
    $e = theme_social();

    $rp = '';
    if(isset($e['social_links_r']))
        $rp = $e['social_links_r'];

    $link = '';

    if($rp):
        foreach ($rp as $r):
        
        if(isset($r['link']['url'])):
            $meta = el_link_meta($r['link']);
            $attr = $meta['all'] . ' class="soc-link idflex-center"';       
            $text = $meta['title_only']; 

            $link .= "<a {$attr}>";
            $link .= el_img($r['icon'], array('echo'=>false, 'll'=>2));
            $link .= "</a>";
        endif;

        endforeach;
    endif;

    $output = tag_wrap('social-icons', $link);

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('social-icons', 'social_icons'); 

/* #endregion */

/* ----------------------------------------- */

/* #region ~ FOOTER */

## Copyright
function copyright($attr) { 
    $args = shortcode_atts( array(
        'echo' => 0
    ), $attr );

    $co = company_name(); 

    $e = theme_footer();
    if(isset($e['copyright'])) {
        $copy = $e['copyright'];

        $y = date('Y');
    
        $ntext  = str_replace("[year]", $y, $copy);
        $output = str_replace("[company]", $co, $ntext);
        $output = tag_wrap('copy', $output);

        if($args['echo'] == 1)
            echo $output;

        return $output;
    }
}

add_shortcode('copyright', 'copyright');

#disclaimer
function disclaimer($attr) { 
    $args = shortcode_atts( array(
        'echo' => 0
    ), $attr );

    $e = theme_footer();
    if(isset($e['disclaimer'])) {
        $output = $e['disclaimer'];
        $output = tag_wrap('disclaim', $output);

        if($args['echo'] == 1)
            echo $output;

        return $output;
    }
}

add_shortcode('disclaimer', 'disclaimer');


## Design By
function web_design($attr) {

    $args = shortcode_atts( array(
        'echo' => 0
    ), $attr );

    $e = theme_footer();
    
    if(isset($e['web_by'])) {
        $by = $e['web_by'];
        $link = $e['web_link'];
        $link = el_link($link, array('echo'=>false));

        $output = str_replace("[web_link]", $link, $by); 
        $output = tag_wrap('web', $output); 

        if($args['echo'] == 1)
            echo $output;

        return $output;
    }
}

add_shortcode('web-design', 'web_design');

## Mini Links
function fn_mini_links($attr) { 

    $args = shortcode_atts( array(
        'echo' => 0
    ), $attr );

    $e = theme_footer();
    $output = '';

    if(isset($e['mini_links'])){
        $rp = $e['mini_links']; 

        if($rp):
            foreach($rp as $r):
                $output .= el_link($r['link'], array('echo'=>false, 'class'=>"simp-link"));
            endforeach;
        endif;        
    }

    $output = tag_wrap('mini-links', $output);  

    if($args['echo'] == 1)
    echo $output;

    return $output;     
    
}

add_shortcode('mini-links', 'fn_mini_links');


/* #endregion */

?>