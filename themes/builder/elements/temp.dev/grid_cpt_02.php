<?php 
    global $post;
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = data_fields($e);
    $col = data_colcount($e);
   
    section_class('gcpt-02');
    div_start('dflex', array('data'=>data_set($opt)));  

    $loop = $e['post_loop'];
    $select = $loop['post_display'];
    $post_type = $loop['post_type'];    
    $count = $loop['post_count'];  
?>

<div class="container-xl">   

    <div class="dinfo dflex-between">
        <div>
        <?php 
            $d = $e['extra']; 
            
            el_img($d['icon'], array('div'=>'diconn'));
            el_title($d['before_title'], array('css'=>'btitle'));
            el_title($d['mtitle']);
            el_title($d['title'], array('css'=>'dtitle'));
            el_title($d['after_title'], array('css'=>'atitle'));
            el_text($d['editor']);
            el_text($d['text'], array('css'=>'ptext'));
        ?>
        </div>
        <?php el_btnloop($d['button_loop']); ?>
    </div>

    <div class="row">

        <!-- *NOTE - RECENT -->
        <?php 
        if($select == 'rc'): 

            $custom_query_args = array(
                'post_type' => $post_type,
                'posts_per_page' => $count,            
                'orederby' => 'date',
                'order' => 'DESC'
            );
        
            $custom_query = new WP_Query( $custom_query_args );             

            while( $custom_query->have_posts() ) : $custom_query->the_post();
            $id = $post->ID;
        ?>

            <div class="col-md-<?php _e($col); ?>">
            <a href="<?php the_permalink($id); ?>" class="post-item">
                <?php tp_thumb($id, array('class'=>'post-thumbnail overlay', 'as'=>'bg')); ?>
                
                <?php  $term = get_the_terms( $post->ID, 'project-type'); ?>
  
                <span class="post-cat">
                    <?php echo $term[0]->name; ?>
                </span>   
                
                <div class="post-info">  
                    <?php el_title(get_the_title($id), array('css'=>'post-title ntitle ititle')); ?> 
                </div>
            </a>
            </div>           

        <?php 
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

        <!-- *NOTE - FEATURED -->
        <?php 
        $rp = $loop['posts'];
        if($select == 'fp' and $rp):
            $i = 0;
            foreach($rp as $id):
        ?>

            <div class="col-md-<?php _e($col); ?>">
            <a href="<?php the_permalink($id); ?>" class="post-item">
                <div class="post-info">
                    <div class="pos-rel">
                    <?php 
                        tp_thumb($id, array('class'=>'post-thumbnail', 'as'=>'bg'));

                        $term = get_the_terms( $post->ID, 'project-type'); 
                        /* href="<?php echo get_term_link($term[0]); ?>" */
                    ?>
                        <span class="post-cat">
                            <?php echo $term[0]->name; ?>
                        </span>                   
                    </div>
                    <?php
                        el_title(get_the_title($id), array('css'=>'post-title ntitle ititle'));
                        ## $sample = get_field('filed');
                    ?> 

                </div>
            </a>
            </div> 

        <?php
            $i++;
            if($i == $count) break;
            endforeach;
        endif;
        ?>

        <!-- *NOTE - FEATURED -->
        <?php 
        if($select == 'rd'): 

            $custom_query_args = array(
                'post_type' => $post_type,
                'posts_per_page' => -1,
                '_shuffle_and_pick' => $count
            );
        
            $custom_query = new \WP_Query( $custom_query_args );    

            while( $custom_query->have_posts() ) : $custom_query->the_post();
            $id = $post->ID;
        ?>

            <div class="col-md-<?php _e($col); ?>">
            <a href="<?php the_permalink($id); ?>" class="post-item">
                <div class="post-info">
                    <div class="pos-rel">
                    <?php 
                        tp_thumb($id, array('class'=>'post-thumbnail', 'as'=>'bg'));

                        $term = get_the_terms( $post->ID, 'project-type'); 
                        /* href="<?php echo get_term_link($term[0]); ?>" */
                    ?>
                        <span class="post-cat">
                            <?php echo $term[0]->name; ?>
                        </span>                   
                    </div>
                    <?php
                        el_title(get_the_title($id), array('css'=>'post-title ntitle ititle'));
                        ## $sample = get_field('filed');
                    ?> 

                </div>
            </a>
            </div> 

        <?php 
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

    </div>

</div>    

<?php div_end(); ?>