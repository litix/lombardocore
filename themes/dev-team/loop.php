<?php

## NOTE - AJAX LOOP --------------------------------------------- ##

//AJAX CPT - Button
## ANCHOR[id=cpt]

add_filter('pp_1', function($id) 
{ 
    $title = get_the_title($id);
    $featured = tp_thumb($id, array('echo'=>false));

    //$tax = tp_tax($id, 'proj-cat', array('echo'=>false, 'div'=>'cat-links'));
    $tax = '';
    $href = 'href="' . get_the_permalink($id) . '"';

    $data = '';
    ob_start();

    ?>

        <div class="col-lg-4">
        <div class="cpt">
            <a class="cpt-link" <?= $href ?>>
                <?= $featured ?>
                <h5 class="cpt-title"> <?= $title ?></h5>
            </a>
            <?= $tax ?>
        </div>
        </div>              

    <?php
    
    $data = ob_get_clean();
    return $data;
}
); 

//AJAX POST - Button
## ANCHOR[id=post]

add_filter('pp_2', function($id) 
{ 
    $title = get_the_title($id);
    $title = el_tag($title, array('div'=>'post-title same-h', 'tag'=>'h4', 'class'=>'title', 'echo'=>false));            
    $href  = 'href="' . get_the_permalink($id) . '"';
    
    $featured = tp_thumb($id, array('div'=>'post-thumb', 'as'=>'bg', 'echo'=>false));
    $date     = tp_meta($id, array('meta'=>'date','div'=>'post-meta', 'echo'=>false));
    $excerpt  = tp_excerpt($id, array('char'=>'110', 'div'=>'post-excerpt match-h', 'echo'=>false));
    $meta     = tp_cat($id, array('div'=>'post-meta', 'post_text'=>'Category : ', 'echo'=>false));

    $data = '';
    ob_start();

    ?>

    <div class="col-lg-4">
        <div class="box b">
            <a class="post-link" <?= $href ?>>
                <?= $featured ?>
                <?= $date ?>
                <?= $title ?>
                <?= $excerpt ?>
            </a>
            <div class="div-meta">
                <?= $meta ?>
            </div>
        </div>
    </div>            
    
    <?php

    $data = ob_get_clean();
    return $data;
}
); 

//AJAX CPT - Scroll
## ANCHOR[id=scroll]

add_filter('pp_3', function($id) 
{ 
    $title = get_the_title($id);
    $featured = tp_thumb($id, array('echo'=>false));

    //$tax = tp_tax($id, 'proj-cat', array('echo'=>false, 'div'=>'cat-links'));
    $tax = '';
    $href = 'href="' . get_the_permalink($id) . '"';

    $data = '';
    ob_start();

    ?>
    
        <div class="col-lg-4">
        <div class="cpt">
            <a class="cpt-link" <?= $href ?>>
                <?= $featured ?>
                <h5 class="cpt-title"> <?= $title ?></h5>
            </a>
            <?= $tax ?>
        </div>
        </div>         

    <?php

    $data = ob_get_clean();
    return $data;
}
); 


## NOTE - GRID LOOP --------------------------------------------- ##

## NOTE ~ for post
function grid_post_display($id) {

    if($id):

        $data = '';
        ob_start();
    ?>    

        <a href="<?php the_permalink($id); ?>" class="post-item">
            <div class="post-info">
                <?php 
                    tp_thumb($id, array('class'=>'post-thumbnail', 'as'=>'bg'));
                    tp_cat($id, array('div'=>'post-category', 'link'=>false, 'count'=>'1', 'post_text'=>'')); 
                ?> 
                <?php el_title(get_the_title($id), array('css'=>'ititle')); ?>
                <?php tp_excerpt($id, array('char'=>'110', 'div'=>'post-excerpt')); ?> 
            </div>

            <div class="meta">
                <?php tp_meta($id, array('meta'=>'date','div'=>'post-meta post-date')); ?>
                <?php tp_meta($id, array('meta'=>'name','div'=>'post-meta post-author', 'text'=>'By ')); ?>
            </div>
        </a>

    <?php

        $data = ob_get_clean();

    endif;

    return $data;
}


## NOTE ~ for custom post type
function grid_cpt_display($id) {

    if($id):

        $data = '';
        ob_start();
    ?>    

            <a href="<?php the_permalink($id); ?>" class="post-item">
                <div class="post-info">
                    <?php 
                        tp_thumb($id, array('class'=>'post-thumbnail', 'as'=>'bg'));
                        el_title(get_the_title($id), array('css'=>'post-title ntitle'));

                        ## $sample = get_field('filed');
                        
                        /*
                            $term = get_the_terms( $post->ID, 'whatever'); 
                            <a href="<?php echo get_term_link($term[0]); ?>" class="rlink" 
                            rel="category tag cat-<?php  echo $term[0]->term_id; ?>">
                            <?php echo $term[0]->name; ?>
                            </a>
                        */
                    ?> 
                </div>
            </a>

    <?php

        $data = ob_get_clean();

    endif;

    return $data;
}

