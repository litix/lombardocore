<?php 
# ARTICLES
# article functions and features
## theme_placeholder()

/*------------------------------------------------*/

/* #region ~ EXCERPT */
function tp_excerpt($id='', $array=array()) { 
    $default = array( 
        'div'       =>  '',
        'id'        =>  '',
        'data'      =>  '',
        'words'     =>  '',
        'pos'       =>  '...',
        'char'      =>  150,
        'echo'      =>  true,
    ); 

    $output = '';

    $param = array_merge($default, $array);

    $excerpt = get_the_excerpt($id);

    if($excerpt) {

        if($param['char'])
            $output = limitStrlen($excerpt, $param['char'], $param['pos']);

        if($param['words'])
            $output = limit_text($excerpt, $param['words']);
    }

    #data
    $data = implode(" ", array($param['data'], $param['id']));
   
    $output = tag_wrap($param['div'], $output, $data);

    if($param['echo'] == true)
        echo $output;

    return $output;    
}

/* #endregion */

/*------------------------------------------------*/

/* #region ~ TAXONOMY */

function tp_tax($id='', $tax='', $array=array()) { 
    $default = array( 
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'data'      =>  '',
        'count'     =>  '2',
        'text'      =>  '',
        'echo'      =>  true,
        'link'      =>  true,
        'taxonomy'  =>  '',
        'sep'       =>  '|',
    ); 

    $param = array_merge($default, $array);

    if(!isset($param['post_type']))
        $post_type = get_post_type($id);

    $amt = $param['count'] - 1;

    $is_cpt = true;

    #post
    if($post_type == 'post' or $post_type == 'page') {
        $is_cpt = false;
    }

    #cpt
    if($is_cpt == true):

        if($tax != '')
            $terms = get_the_terms( $id, $tax);

        if($param['taxonomy']) 
            $terms = get_the_terms( $id, $param['taxonomy']);

        if($terms):

            $data = '';
            $text = '';
            $i = 0;
            foreach ( $terms as $term ):
                $link = get_term_link($term);
                $cat = $term->name;
                
                if($param['link'] == true) {
                    $data .= trim(el_a($link, array(
                        'class'=>"cat-link {$param['class']}", 
                        'title'=>$term->name, 
                        'echo'=>false)
                    ), ' ');
                } else {
                    $cat = tag_wrap('cat-div', $cat);
                    $data .= trim($cat, ' ');
                }

                $sep = "{$param['sep']}";
                $data .= $sep;

                $i++;    
                if($i > $amt)
                    break;                   

            endforeach;
            $output = rtrim($data, $sep);    

            if($param['text'])
                $text = "<span class=\"meta-label\">{$param['text']}</span>";   
            
            $output = "{$text}{$output}"; 

        endif;            
    
    endif;

    #data
    $data = implode(" ", array($param['data']));
   
    $output = tag_wrap($param['div'], $output, $data);

    if($param['echo'] == true)
        echo $output;

    return $output;    
}

/* #endregion */

/*------------------------------------------------*/

/* #region ~ SINGLE TAGS */

function tp_tags($id='', $array=array()) { 
    $default = array( 
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'data'      =>  '',
        'count'     =>  '-1',
        'text'      =>  'Tags : ',
        'echo'      =>  true,
        'sep'       =>  ', ', 
    );
    
    $param = array_merge($default, $array);

    $tags = get_the_tags($id);

    $links = '';

    $i = 0;
    if (!empty($tags)):
        foreach ($tags as $tag) :
            $tag_link = get_tag_link($tag->term_id);
            $links = trim(el_a($tag_link, array('class'=>"cat-link {$param['class']}", 'title'=>$tag->name, 'echo'=>false)), ' ');
            $links .= $param['sep'];

            $i++;
            if($param['count'] > 0)
                if($i >= $param['count']) 
                    break;

        endforeach;
    endif;

    $output = rtrim($links, $param['sep']); 

    if($param['text'])
        $text = "<span class=\"meta-label\">{$param['text']}</span>";   

    if($output)
        $output = "{$text}{$output}"; 

    #data
    $data = implode(" ", array($param['data']));

    $output = tag_wrap($param['div'], $output, $data);

    if($param['echo'] == true) {}
        echo $output;

    return $output; 
}    

/* #endregion */

/*------------------------------------------------*/

/* #region ~ LOOP CATEGORY */

function tp_cat($id='', $array=array()) { 
    $default = array( 
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'data'      =>  '',
        'count'     =>  '2',
        'post_text' =>  'Categories : ',
        'page_text' =>  '',
        'cpt_text'  =>  '',
        'echo'      =>  true,
        'post_type' =>  '',
        'taxonomy'  =>  '',
        'link'      =>  true,
        'sep'       =>  ', ',
    ); 

    $output = '';
    $text = '';
    $data = '';

    $param = array_merge($default, $array);

    if(!$param['post_type'])
        $post_type = get_post_type($id);

    $amt = $param['count'] - 1;

    $is_cpt = true;

    #post
    if($post_type == 'post') {

        $is_cpt = false;
        $dcategory = get_the_category($id);

        for ($i = 0; $i <= $amt; $i++) {

            if(isset($dcategory[$i]))
                $cat = $dcategory[$i]->cat_name;

            if(isset($dcategory[$i])) {
                if($cat):
                    $cat_link = get_category_link( $dcategory[$i]->term_id );
                    
                    if($param['link'] == true) {
                        $data .= trim(el_a($cat_link, array('class'=>"cat-link {$param['class']}", 'title'=>$cat, 'echo'=>false)), ' ');
                    } else {
                        $cat = tag_wrap("cat-div {$param['class']}", $cat);
                        $data .= trim($cat, ' ');
                    }

                    $sep = "{$param['sep']}";
                    $data .= $sep;
                endif;    
            }
        }    

        $output = rtrim($data, $sep);    
        if($param['post_text'])
            $text = "<span class=\"meta-label\">{$param['post_text']}</span>";   
        
        $output = "{$text}{$output}"; 
    }

    #page
    if($post_type == 'page') {
        $is_cpt = false;
        $output = "Page";

        if($param['page_text'])
        $text = "<span class=\"meta-label\">{$param['page_text']}</span>";   
    
        $output = "{$text}{$output}"; 
    }

    #cpt
    if($is_cpt == true) {

        if($param['taxonomy']) {
            $terms = get_the_terms( $id, $param['taxonomy']);

            if(!$terms->errors) {

                $i = 0;
                if($terms):

                    foreach ( $terms as $term ):
                        
                        $link = get_term_link($term);
                        $cat = $term->name;

                        $data .= el_a($link, array('class'=>'cat-link', 'title'=>$cat, 'echo'=>false));
                        $sep = "{$param['sep']}";
                        $data .= $sep;

                        $i++;    
                        if($i > $amt)
                            break;                   

                    endforeach;
                    $output = rtrim($data, $sep); 

                else:
                    $output = $post_type;
                endif;         
                
            }

        } else {
            $output = $post_type;
        }

        if($param['cpt_text'])
        $text = "<span class=\"meta-label\">{$param['cpt_text']}</span>";   
    
        $output = "{$text}{$output}"; 
    }

    #data
    $data = implode(" ", array($param['data']));
   
    $output = tag_wrap($param['div'], $output, $data);

    if($param['echo'] == true)
        echo $output;

    return $output;    
}

/* #endregion */

/*------------------------------------------------*/

/* #region ~ CPT META */

function tp_meta($id='', $array=array()) { 
    $default = array( 
        'meta'      =>  'date',  /* date, avatar, name */
        'div'       =>  '',
        'class'     =>  '',
        'name'      =>  'display_name', /* first_name, full_name */
        'id'        =>  '',
        'text'      =>  '',
        'format'    =>  'F j, Y',
        'echo'      =>  true,
        'data'      =>  '',
    );    

    #default
    $text = '';

    #parameters
    $param = array_merge($default, $array);   
    
    $auth_id = get_post_field('post_author', $id);

    ## avatar
    if($param['meta'] == 'avatar') { 
        
        $avatar = get_field('avatar', 'user_' . $auth_id);
        
        $avatar = $avatar ? el_img($avatar, array('echo'=>false)) : get_avatar($auth_id);

        $div = implode(" ", array('meta-avatar', $param['div'], $param['class']));
        $output = $avatar;
    }
    
    ## name
    if($param['meta'] == 'name') { 

        $dname = get_the_author_meta( $param['name'], $auth_id );

        if($dname) {
            if($param['text'])
                $text = "<span class=\"au-label\">{$param['text']}</span>";
            
                $dname = "<span class=\"au-name\">{$dname}</span>";
        }

        $div = implode(" ", array('meta-name', $param['div'], $param['class']));
        $output = "{$text} {$dname}";
    }

    ## date
    if($param['meta'] == 'date') { 
        $date = get_the_date($param['format'], $id);
        
        if($date) {
            if($param['text'])
                $text = "<span class=\"au-label\">{$param['text']}</span>";
                $date = "<span class=\"span-date\">$date</span>";            
        }

        $div = implode(" ", array('meta-date', $param['div'], $param['class']));
        $output = "{$text} {$date}";
    }

    $output = tag_wrap($div, $output, $param['data']);

    if($param['echo'] == true)
    echo $output;

    return $output;    
}

/* #endregion */

/*------------------------------------------------*/

/* #region ~ CPT Thumbnail or Placeholder */

function tp_thumb($postID='', $array=array()) {

    if(!$postID) {
        global $post;
        $postID = $post->ID;
    }

    $default = array( 
        'temp'      =>  true, //use placeholder or no?
        'div'       =>  '',
        'class'     =>  '',
        'size'      =>  'full',
        'id'        =>  '',
        'echo'      =>  true,
        'data'      =>  '',
        'title'     =>  '',
        'as'        =>  'bg', //img or bg
    );

    #parameters
    $param = array_merge($default, $array);   

    #src
    $src    = get_the_post_thumbnail_url($postID);
    $title  = get_the_title($postID);
    $title .= $param['title'];
    $data   = 'image-thumb';
    
    #no featured image
    if(!$src) {
        if($param['temp'] == true){
            $img  = fn_opt_thumbnail($postID);
            $src  = $img['img'];
            $data = $img['data'];
        }
    }

    $tag = ($param['as'] == 'bg') ? 'div' : 'img';

    #class
    $class = implode(" ", array($param['class']));

    #data
    $data = implode(" ", array("data-image=\"$data\"", $param['data']));

    #div
    $div = ($tag != 'div') ? 'post-thumb' : $param['div'];

    #output
    if($param['as'] == 'bg') {
        $output = el_bg($src, array(
                'div'    =>    $div, 
                'echo'   =>    false,
                'class'  =>    $param['class'],
                'id'     =>    $param['id'],
                'data'   =>    $data,
                'title'  =>    $title
        ));

        if($param['echo'] == true)
            echo $output;

        return $output;
    } 

    if($param['as'] == 'img') {
        $output = el_img($src, array(
                'div'    =>    '', 
                'echo'   =>    false,
                'class'  =>    $param['class'],
                'id'     =>    $param['id'],
                'alt'    =>    $title
        ));

        $output = tag_wrap("post-thumb", $output, $data);

        if($param['echo'] == true)
            echo $output;
    
        return $output;
    }
    
}

/* #endregion */

/*------------------------------------------------*/

/* #region ~ PREV NEXT */

function tp_prevnext($id='', $array=array()) { 

    $default = array( 
        'div'       =>  '',
        'class'     =>  '',
        'id'        =>  '',
        'data'      =>  '',
        'design'    =>  false,
        'count'     =>  '-1',
        'prev'      =>  '',
        'next'      =>  '',
        'pre'       =>  '',
        'pos'       =>  '',        
        'symbol'    =>  '',
        'echo'      =>  true,
    ); 

    $param = array_merge($default, $array);

    $output = '';
    $prevID = '';
    $nextID = '';

    # post args
    if($id) {
        $args = array(
            "numberposts" => $param['count'],
            "orderby" => "date",
            "order" => "ASC"                        
        );
            
        $list = get_posts($args);
        $posts = array();

        foreach ($list as $p) {
            $posts[] += $p->ID;
        }

        $current = array_search($id, $posts);

        if(isset($posts[$current-1]))
            $prevID = $posts[$current-1];

        if(isset($posts[$current+1]))
            $nextID = $posts[$current+1];

    }
    
    if (!empty($prevID)) { 

        $plink = get_permalink($prevID);
        $ptitle = ($param['prev']) ? $param['prev'] : get_the_title($prevID);
        $pthumb = tp_thumb($prevID, array('echo'=>false, 'div'=>'thumb-bg'));

        $output = '';

        if($param['pre'])
            $ptitle = "<em>{$param['pre']}</em> $ptitle";

        if($param['design'] == false)
            $output .= el_a($plink, array('title'=>$ptitle, 'echo'=>false));
        
        if($param['design'] == true) {
            $output .= "<a class=\"meta-nav mleft\" href=\"{$plink}\" title=\"{$ptitle}\">";
            $output .= $pthumb;
            $output .= "<div class=\"meta-text\">";
            $output .= "<small>PREVIOUS : </small>";
            $output .= "<span>{$ptitle}</span>";
            $output .= "</div>";
            $output .= "</a>";
        }
    }

    if (!empty($nextID)) { 

        $nlink = get_permalink($nextID);
        $ntitle = ($param['next']) ? $param['next'] : get_the_title($nextID);        
        $nthumb = tp_thumb($nextID, array('echo'=>false, 'div'=>'thumb-bg'));

        if($param['pos'])
            $ntitle = "$ntitle <em>{$param['pos']}</em> ";

        if($param['design'] == false)
            $output .= el_a($nlink, array('title'=>$ntitle, 'echo'=>false));

        if($param['design'] == true) {
            $output .= "<a class=\"meta-nav mright\" href=\"{$nlink}\" title=\"{$ntitle}\">";
            $output .= "<div class=\"meta-text\">";
            $output .= "<small>NEXT : </small>";
            $output .= "<span>{$ntitle}</span>";
            $output .= "</div>";            
            $output .= $nthumb;            
            $output .= "</a>";
        }
    }
    
    #data
    $data = implode(" ", array($param['data']));
   
    $output = tag_wrap($param['div'], $output, $data);

    if($param['echo'] == true)
        echo $output;

    return $output;   
}    

/* #endregion */

/*------------------------------------------------*/

/* #region ~ Auxillary */

function fn_opt_thumbnail($postID='post') {
    /* get placeholder in theme options */
    $post_type = get_post_type($postID);

    $img = '';

    $e = theme_placeholder();
    $rp = $e['cpt_thumbnail'];
    if($rp) {
        foreach($rp as $r):
            if($post_type == $r['type'])
                $img = $r['thumbnail'];
                $data = 'image-opt';
        endforeach;
    }

    $logo = build_acf_logo('main');

    /* no image */
    if(!$img) {
        $img = $logo;
        $data = 'image-none';
    }
    
    return array('img'=>$img, 'data'=>$data);
}

/* #endregion */

?>