<?php 
#SHORTCODES
# theme_contact()  

// see lib-theme-opt-init
// [contact-phone] [contact-email] [contact-address] [contact-map]


/* ----------------------------------------- */

/* #region ~ PHONE */

function co_phone($attr) {
    $args = shortcode_atts( array(
        'echo'      => 0,
        'linked'    => 1,   // tel
        'icon'      => 0,   // icon
        'format'    => 0,   // format as (111) 111-1111
        'loop'      => -1,  // [0,1,2,3] display 1 / [-1] display all
        'text'      => '',
        'div'       => 'company-phone',
    ), $attr );

    global $tpath;

    $icon = '';

    if($args['icon'] == 1) {
        $icon = $tpath . '/images/icons/phone.svg';

        $icon = el_img($icon, array(
            'echo' => false, 'div' => 'sc-icon', 'class' => 'c-icon', 'alt' => 'contact-phone'
        ));
    }

    $class = "sc-contact sc-phone";
    $output = '';

    $e = theme_contact();

    $rp = '';
    if(isset($e['phone']))
        $rp = $e['phone'];

    $i = 0;

    $text = $args['text'];
    if($text) $text = tag_wrap("sc-text", $text, '', 'span');

    if($rp):   

        if($args['loop'] > 0) {

            $s = $args['loop'] - 1;

            if(isset($rp[$s])) {
                $r = $rp[$s];
                
                $telf = phone_format($r['contact']);
                $telc = str_replace(' ', '',$telf);
                $tel = ($args['format'] == 1) ? $telf : $r['contact'];
                $data = "{$icon}<span>{$tel}</span>";

                $link_attr = implode(" ", array(
                    "href=\"tel:{$telc}\"",
                    "target=\"_blank\"",
                ));           
            
                if($r['contact']):
                    if($args['linked'] == 1) {
                        $output .= tag_wrap("{$class} phone-{$i}", $data, $link_attr, 'a');
                    } else {
                        $output .= tag_wrap("{$class} phone-{$i}", $data);
                    }           
                endif;  

                if($text)
                    $output = tag_wrap("sc-div", "{$text} {$output}");
            }
        } 
        
        if($args['loop'] < 0) {

            foreach($rp as $r):

                $i++;
                $telf = phone_format($r['contact']);
                $telc = str_replace(' ', '',$telf);
                $tel = ($args['format'] == 1) ? $telf : $r['contact'];
                $data = "{$icon}<span>{$tel}</span>";

                $link_attr = implode(" ", array(
                    "href=\"tel:{$telc}\"",
                    "target=\"_blank\"",
                ));           
            
                if($r['contact']):
                    if($args['linked'] == 1) {
                        $item = tag_wrap("{$class} phone-{$i}", $data, $link_attr, 'a');
                    } else {
                        $item = tag_wrap("{$class} phone-{$i}", $data);
                    }           
                endif;  

                $output .= $text ? tag_wrap("sc-div","{$text} {$item}") : "{$item}";
            
            endforeach;
        }

    endif;    

    if($args['div'] != '')
        $output = tag_wrap($args['div'], $output);       

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('contact-phone', 'co_phone'); 

/* #endregion */

/* ----------------------------------------- */

/* #region ~ EMAIL */

function co_email($attr) {
    $args = shortcode_atts( array(
        'echo'      => 0,
        'linked'    => 1,
        'icon'      => 0,
        'icon_link' => '',
        'loop'      => -1, // [0,1,2,3] display 1 / [-1] display all
        'text'      => '',
        'div'       => 'company-email',
    ), $attr );

    global $tpath, $spath;
    $output = '';
    $item = '';
    $icon = '';

    if($args['icon'] == 1)
        $icon = $tpath . '/images/icons/mail.svg';

    if($args['icon_link'] != '')
        $icon = $args['icon_link'];

    $icon = el_img($icon, array(
        'echo' => false, 'div' => 'sc-icon', 'class' => 'c-icon', 'alt' => 'contact-email'
    ));

    $class = "sc-contact sc-email";
    
    $e = theme_contact();
    $rp = '';
    if(isset($e['emails']))
        $rp = $e['emails'];
    
    $i = 0;

    $text = $args['text'];
    if($text) $text = tag_wrap("sc-text", $text, '', 'span');
    
    if($rp):   

        if($args['loop'] > 0) {

            $s = $args['loop'] - 1;
            $r = $rp[$s];

            $data = "{$icon}<span>{$r['email']}</span>";

            $link_attr = implode(" ", array(
                "href=\"mailto:{$r['email']}\"",
                "target=\"_blank\"",
            ));

            if(is_email($r['email'])):
                if($args['linked'] == 1) {
                    $output .= tag_wrap("{$class} email-{$i}", $data, $link_attr, 'a');
                } else {
                    $output .= tag_wrap("{$class} email-{$i}", $data);
                }           
            endif;  

            if($text)
                $output = tag_wrap("sc-div", "{$text} {$output}");
        } 

        if($args['loop'] < 0) {

            foreach($rp as $r):

                $i++;
                $data = "{$icon}<span>{$r['email']}</span>";

                $link_attr = implode(" ", array(
                    "href=\"mailto:{$r['email']}\"",
                    "target=\"_blank\"",
                ));           

                if(is_email($r['email'])):
                    if($args['linked'] == 1) {
                        $item = tag_wrap("{$class} email-{$i}", $data, $link_attr, 'a');
                    } else {
                        $item = tag_wrap("{$class} email-{$i}", $data);
                    }           
                endif;  

                $output .= $text ? tag_wrap("sc-div","{$text} {$item}") : "{$item}";
               
            endforeach;

        }

    endif;    

    if($args['div'] != '')
        $output = tag_wrap($args['div'], $output);     
    
    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('contact-email', 'co_email'); 

/* #endregion */

/* ----------------------------------------- */

/* #region ~ ADDRESS */
function co_address($attr) {
    global $gmap;
    $gmap++;

    $args = shortcode_atts( array(
        'echo'      => 0,
        'linked'    => 1,
        'icon'      => 0,
        'zoom'      => 13,
        'title'     => '',
        'loop'      => -1,  // [0,1,2,3] display 1 / [-1] display all
    ), $attr );

    global $tpath;

    $output = '';
    $icon = '';

    if($args['icon'] == 1)
        $icon = $tpath . '/images/icons/map.svg';

    $icon = el_img($icon, array(
        'echo' => false, 'div' => 'sc-icon', 'class' => 'c-icon', 'alt' => 'contact-address'
    ));

    $class = "sc-contact sc-address";
    
    $e = theme_contact();

    $rp = '';
    if(isset($e['address'])) $rp = $e['address'];
    
    $i = 0;
    if($rp):   

        ## SINGLE
        if($args['loop'] > 0):

            $s = $args['loop'] - 1;

            if(isset($rp[$s])) {
                $r = $rp[$s];

                $data = "{$icon}{$r['address']}";

                $src  = googlemap($r['address'], false);
                $src .= "&z={$args['zoom']}";

                $link_attr = implode(" ", array(
                    "data-src=\"#map-modal-{$gmap}\"",
                    "data-fancybox"
                ));           

                $output = '';            

                if($r['address']):

                    if($args['title'] != "") {
                        $output .= "<span class=\"sc-text\">{$args['title']}</span>";
                        $class .= $class . ' w-title';
                    }

                    if($args['linked'] == 1) {
                        $output .= "<a class=\"$class address-{$s}\" {$link_attr}>$data</a>";
                        //$output .= tag_wrap("{$class} address-{$i}", $data, $link_attr, 'a');
                    } else {
                        $output .= "$data";
                        //$output .= tag_wrap("{$class} address-{$i}", $data);
                    }           

                    //modal
                    $output .= "<div class=\"fancy-modal\" id=\"map-modal-{$gmap}\"";
                    $output .= ' tabindex="-1" aria-labelledby="'. "map-modal-{$gmap}" . '" aria-hidden="true">';
                    $output .= '<div class="fancy-container">';
                    $output .= '<iframe class="lazy" loading="lazy" src="about:blank" data-src="' . $src . '"></iframe>';
                    $output .= '</div>';
                    $output .= '</div>';                

                endif;
            }    

        endif;

        ## LOOP
        if($args['loop'] < 0):

            foreach($rp as $r):

                $data = "{$icon}{$r['address']}";

                $src  = googlemap($r['address'], false);
                $src .= "&z={$args['zoom']}";

                $link_attr = implode(" ", array(
                    "data-src=\"#map-modal-{$gmap}\"",
                    "data-fancybox"
                ));           

                if($r['address']):

                    if($args['title'] != "") {
                        $output .= "<span class=\"sub-title\">{$args['title']}</span>";
                        $class .= $class . ' w-title';
                    }

                    if($args['linked'] == 1) {
                        $output .= "<a class=\"$class address-{$i}\" {$link_attr}>$data</a>";
                        //$output .= tag_wrap("{$class} address-{$i}", $data, $link_attr, 'a');
                    } else {
                        $output .= "$data";
                        //$output .= tag_wrap("{$class} address-{$i}", $data);
                    }           

                    //modal
                    $output .= "<div class=\"fancy-modal\" id=\"map-modal-{$gmap}\"";
                    $output .= ' tabindex="-1" aria-labelledby="'. "map-modal-{$gmap}" . '" aria-hidden="true">';
                    $output .= '<div class="fancy-container">';
                    $output .= '<iframe class="lazy" loading="lazy" src="about:blank" data-src="' . $src . '"></iframe>';
                    $output .= '</div>';
                    $output .= '</div>';
                    
                endif;    

                $i++;
                
            endforeach;

        endif;    

    endif;    

    $output = tag_wrap('company-address', $output);    
    
    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('contact-address', 'co_address'); 

/* #endregion */

/* ----------------------------------------- */

/* #region ~ MAP */

function co_map($attr) {
    $args = shortcode_atts( array(
        'echo'      => 0,
        'map'       => 0, //select the map
        'h'         => 300,
        'z'         => 16
    ), $attr );
   
    $e = theme_contact();

    //$map = $args['map'];
    $src = '';
    if(isset($e['address'])):
        $src = $e['address'];
        if(isset($src[$args['map']]))
            $src = $src[$args['map']]['address'];
    endif;

    $z = $args['z'];
    
    $output = el_gmap($src, array('echo'=>false, 'z'=>$z));
    
    $meta = "style=\"height:{$args['h']}px;\"";

    $output = tag_wrap('company-map sc-map', $output, $meta);    
    
    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('contact-map', 'co_map'); 

/* #endregion */

?>