<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = $e['display_fields'];
    $col = $opt['columns'];

    section_class('el-column rf01');
    div_start('dflex', array('data'=>data_set($opt)));

    $id = $e['featured'];
    $title = get_the_title($id);
    $length = $e['length'];

    #sample of show/hide
    $date = $opt['post_date'];
    $author = $opt['post_date'];
    $meta = ($date == 1 or $author == 1) ? "" : "dnone";        
?>

<div class="overlay color"></div>
<div class="container-xl">      
    <div class="row">

        <div class="col-lg-<?php echo $col[0]; ?> cc">    
            <div class="dimage" data-img="single">
                <?php tp_thumb($id, array('class'=>'post-thumbnail', 'as'=>'bg')); ?> 
            </div>
        </div>    
    
        <div class="col-lg-<?php echo $col[2]; ?> cc">
            <div class="dinfo">

                <?php el_img($e['icon'], array('div'=>'diconn')); ?>
                <div>
                    <div class="dtop flexic">
                        <?php 
                            el_title($e['before_title'], array('css'=>'btitle'));
                            tp_cat($id, array('class'=>'btitle post-category', 'link'=>false, 'count'=>'1', 'post_text'=>'')); 
                        ?>
                    </div>
                    <?php el_title($title, array('css'=>'mtitle f40')); ?>
                </div>
                <?php
                    tp_excerpt($id, array('char'=>$length, 'div'=>'post-excerpt dtext'));
                    el_text($e['text'], array('css'=>'dtext'));
                ?>    
                <div class="meta <?php _e($meta); ?>">
                    <?php tp_meta($id, array('meta'=>'date','div'=>'post-meta post-date')); ?>
                    <span class="s post-date">|</span> 
                    <?php tp_meta($id, array('meta'=>'name','div'=>'post-meta post-author', 'text'=>'By ')); ?>
                </div>
                <?php 
                    //if you have link
                    el_advlink($e['button'], array('div'=>'abtn-loop'));
                    //el_static_btn($e['button'], array('as'=>'div')); 
                ?>

            </div>        
        </div>        
    
    </div>
</div>    

<?php div_end(); ?>

<?php 
## Updated    : Apr 15 2023
## Element    : Row Content RC01
## Group      : Templates [OPT] [1]
## Version    : 0.2
?>
