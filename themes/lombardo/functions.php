<?php
/* START HERE  */

global $tpath, $t_assets; // parent folder
global $spath, $s_assets; // child folder

/* #region - My Functions */

register_nav_menu('main', 'main menu');

/* #endregion */

/* #region - [F] WP ENQUEUE  */

function my_enqueue($hook)
{

    global $spath;
    $js = $spath . '/assets/js';

    //wp_enqueue_style( 'red_css', "{$js}/red/red.css", '', 1.0 );
    //wp_enqueue_script( 'red_js', "{$js}/red/red.js", array(), '1.0.0', true );    
}

add_action('get_footer', 'my_enqueue');

/* #endregion */

//Tailwind Settings
// function enqueue_child()
// {
//     wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/theme.css', array(), '1.0');
// }

// add_action('wp_enqueue_scripts', 'enqueue_child', 100);

add_filter('ai1wm_exclude_content_from_export', function ($exclude_filters) {
    $exclude_filters[] = get_stylesheet_directory() . '/node_modules';
    return $exclude_filters;
});

/* #region - [F] REMOTE ENQUEUE  */

function cleanPhoneNumber($phoneNumber)
{
    // Remove all non-digit characters from the phone number
    $cleanedPhoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
    return $cleanedPhoneNumber;
}

function slugify($string)
{
    // Replace spaces with hyphens, remove special characters, and convert to lowercase
    $slug = strtolower(str_replace(' ', '-', preg_replace('/[^a-zA-Z0-9\-]/', '', $string)));
    return $slug;
}

function my_assets($array)
{
    global $spath;

    if (!is_array($array)) {
        $array = explode(',', $array);
    }

    $js = $spath . '/assets/js';

    ## RED
    if (in_array('red', $array, TRUE)) {

        /*
             wp_register_style('red_css', "{$js}/red/red.css", '', 1.0);    
             wp_register_script('red_js', "{$js}/red/red.js",'','1.0');

             wp_enqueue_style('red_css');  
             wp_enqueue_script('red_js'); 
            */
    }

    ## ADD MORE...
}

/* #endregion */


function create_data_attributes($e, $type)
{

    $opt = data_fields($e);
    $s = check_media($e['media']);
    $output = '';
    switch ($type) {
        case 'full':
            //data-rtl=[true/false]
            $rtl = ($opt['rtl']) ? 'true' : 'false';
            $output  =  "data-rtl=$rtl";
            //data-vertical
            $vertical = ($opt['vertical']) ? 'true' : 'false';
            $output  .=  " data-vertical=$vertical";
            //data-hasmedia
            $hasmedia = ($s) ? 'true' : 'false';
            $output  .=  " data-hasmedia=$hasmedia";
            //data-alignment
            $alignment = ($opt['center_items']) ? 'true' : 'false';
            $output  .=  " data-alignment=$alignment";

            return $output;
            break;
        default:
            $rtl = ($opt['rtl']) ? 'true' : 'false';
            $output  =  "data-rtl=$rtl";
            return $output;
            break;
    }
}


/*== CUSTOM TITLE LENTGH ==*/
function child_limit_text($title, $limit)
{
    if (str_word_count($title, 0) > $limit) {
        $words = str_word_count($title, 2);
        $pos   = array_keys($words);
        $title  = substr($title, 0, $pos[$limit]) . '...';
    }
    return $title;
}

function get_post_by_category($params = array(), $defaults = array(
    'cat' => '0', 'order' => 'date', 'hide_empty' => false, 'field' => 'slug', 'post_type' => 'post', 'count' => '-1',
    'tax_query' => array(
        array(
            'taxonomy' => 'your_taxonomy_name',
            'field' => 'id',
            'terms' => 1,
        ),
    ),
))
{

    $q = array_merge($defaults, $params);

    $args = array(
        'post_type' => $q['post_type'],
        'post_type' => 'product',
        'posts_per_page' => $q['count'],
        'tax_query' => $q['tax_query'],
    );

    return new WP_Query($args);
}

/* #region - MENU EXTENSION  */
function child_fn_menu_ext($attr)
{
    $args = shortcode_atts(array(
        'echo'  => 0,
        't'     => 'buttons', //button, buttons_ex
        'b'     => -1,
        'class' => '',
    ), $attr);

    $output = '';

    $e = theme_menu_ext();


    foreach ($e['buttons'] as $btn) {
        $url = ($btn['button']['url']) ? $btn['button']['url'] : '#';
        $c = (string)$args['class'];
        $output .= "<a class='{$c}' href='{$url}'><span>{$btn['button']['title']}</span></a>";
    }

    return (string)$output;
}

add_shortcode('child-menu-ext', 'child_fn_menu_ext');

function child_social_icons_single($attr)
{
    $args = shortcode_atts(array(
        'echo'  => 0,
        'array' => 0,
        'in' => 0,
        'class' => ''
    ), $attr);

    $e = theme_social();

    $in = $args['in'];

    $output = '';

    $link = '';

    $rp = '';

    if (isset($e['social_links_r']))
        $rp = $e['social_links_r'];

    if ($rp) {

        if (isset($rp[$in]['link']['url'])) :
            $meta = el_link_meta($rp[$in]['link']);
            $attr = $meta['all'] . ' class="soc-link idflex-center"';
            $text = $meta['title_only'];

            $link .= "<a {$attr}>";
            $link .= el_img($rp[$in]['icon'], array('echo' => false, 'll' => 2));
            $link .= "</a>";
        endif;
    }

    $output = tag_wrap('social-icons', $link);



    if ($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('child-social-single', 'child_social_icons_single');

function child_co_phone($attr)
{
    $args = shortcode_atts(array(
        'echo'      => 0,
        'linked'    => 1,   // tel
        'icon'      => 0,   // icon
        'format'    => 0,   // format as (111) 111-1111
        'loop'      => -1,  // [0,1,2,3] display 1 / [-1] display all
        'text'      => '',
        'div'       => 'company-phone',
    ), $attr);

    global $tpath;

    $icon = '';

    if ($args['icon'] == 1) {
        $icon = $tpath . '/images/icons/phone.svg';

        $icon = el_img($icon, array(
            'echo' => false, 'div' => 'sc-icon', 'class' => 'c-icon', 'alt' => 'contact-phone'
        ));
    }

    $class = "sc-contact sc-phone";
    $output = '';

    $e = theme_contact();

    $rp = '';
    if (isset($e['phone']))
        $rp = $e['phone'];

    $i = 0;

    $text = $args['text'];
    if ($text) $text = tag_wrap("sc-text", $text, '', 'span');

    if ($rp) :

        if ($args['loop'] > 0) {

            $s = $args['loop'] - 1;

            if (isset($rp[$s])) {
                $r = $rp[$s];

                $telf = phone_format($r['contact']);
                $telc = str_replace(' ', '', $telf);
                $tel = ($args['format'] == 1) ? $telf : $r['contact'];
                $data = "{$icon}<span>{$tel}</span>";

                $link_attr = implode(" ", array(
                    "href=\"tel:{$telc}\"",
                    "target=\"_blank\"",
                ));

                if ($r['contact']) :
                    if ($args['linked'] == 1) {
                        $output .= tag_wrap("{$class} phone-{$i}", $data, $link_attr, 'a');
                    } else {
                        $output .= tag_wrap("{$class} phone-{$i}", $data);
                    }
                endif;

                if ($text)
                    $output = tag_wrap("sc-div", "{$text} {$output}");
            }
        }

        if ($args['loop'] < 0) {

            foreach ($rp as $r) :

                $i++;
                $telf = phone_format($r['contact']);
                $telc = str_replace(' ', '', $telf);
                $tel = ($args['format'] == 1) ? $telf : $r['contact'];
                $phoneNumber = preg_replace('/[^0-9]/', '', $tel);
                $data = "{$icon}<span>{$tel}</span>";

                $link_attr = implode(" ", array(
                    "href=\"tel:{$phoneNumber}\"",
                    "target=\"_blank\"",
                ));

                if ($r['contact']) :
                    if ($args['linked'] == 1) {
                        $item = tag_wrap("{$class} phone-{$i}", $data, $link_attr, 'a');
                    } else {
                        $item = tag_wrap("{$class} phone-{$i}", $data);
                    }
                endif;

                $output .= $text ? tag_wrap("sc-div", "{$text} {$item}") : "{$item}";

            endforeach;
        }

    endif;

    if ($args['div'] != '')
        $output = tag_wrap($args['div'], $output);

    if ($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('child-contact-phone', 'child_co_phone');

/* #region - FOOTER MENU  */
function child_fn_footer_menu($attr)
{
    global $wp;

    load_assets(array('mobile-menu'));
    $current_slug = add_query_arg(array(), $wp->request);
    $args = shortcode_atts(array(
        'echo'  => 0,
        'menu'  => 0, /* n = menu position */
        'main'  => false, /* 1 = use main menu */
        'text'  => 'Select Link',
        'desktop-class' => '',
        'mobile-class'  =>  '',
    ), $attr);

    $output = '';

    $e = theme_footer_menu();

    if ($args['main'] == false) :

        if (isset($e['footer_menus'])) {

            $n = $args['menu'];

            $menu = $e['footer_menus'];

            if (isset($menu[$n]['menu'])) {
                $menu = $menu[$n]['menu']; //group title        
                $rp = $menu['menu']; //group links

                $output = el_title($menu['title'], array('echo' => false, 'class' => 'desktop-view', 'css' => 'ftitle'));

                ## desktop menu

                $output .= "<ul class=\"menu-links desktop-view {$args['desktop-class']}\">";

                if ($rp) :
                    foreach ($rp as $r) :
                        $menu_class = 'is-link';
                        $link = el_link($r['link'], array('echo' => false, 'class' => "{$menu_class}"));
                        $output .= tag_wrap('menu-item', $link, '', 'li');
                    endforeach;
                endif;
                $output .= '</ul>';

                ## mobile menu
                $output .= "<ul class=\"menu-links is-mobile mobile-view {$args['mobile-class']}\">";

                if ($menu['title']) {
                    $text = $menu['title'];
                } else {
                    $text = $args['text'];
                }

                $output .= tag_wrap('menu-item', $text, '', 'li');

                if ($rp) :
                    foreach ($rp as $r) :
                        $menu_class = 'is-link';
                        $link = el_link($r['link'], array('echo' => false, 'class' => "{$menu_class}"));
                        $output .= tag_wrap('menu-link', $link, '', 'li');
                    endforeach;
                endif;
                $output .= '</ul>';
            }
        }

        $output = tag_wrap('footer-menu', $output);

        if ($args['echo'] == 1)
            echo $output;

        return $output;

    endif;


    if ($args['main'] == true) :

        echo "<div class=\"footer-menu\">";

        wp_nav_menu(array(
            'theme_location'  => 'main',
            'depth'              => 0,
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_id'         => '',
            'menu_class'      => 'menu-links desktop-view',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ));

        wp_nav_menu(array(
            'theme_location'  => 'main',
            'depth'              => 0,
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_id'         => '',
            'menu_class'      => 'menu-links is-mobile mobile-view',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker(),
        ));

        echo "</div>";

    endif;
}

add_shortcode('child-footer-menu', 'child_fn_footer_menu');