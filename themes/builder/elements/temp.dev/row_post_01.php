<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colsize($e);

    section_class('rowpost-01');
    div_start('dflex', array('data'=>data_set($opt)));

    $id = $e['featured'];
    $title = get_the_title($id);
    $length = $e['length']; 
?>

<div class="overlay color"></div>
<div class="container-xl">      
    <div class="row">

        <div class="col-lg-<?php echo $col[0]; ?> cc">    
            <div class="dimage" data-img="single">
                <?php tp_thumb($id, array('class'=>'post-thumbnail', 'as'=>'img')); ?> 
            </div>
        </div>    
    
        <div class="col-lg-<?php echo $col[1]; ?> cc">

            <div class="dinfo">
                <?php 
                    el_img($e['icon'], array('div'=>'diconn'));
                    el_title($e['before_title'], array('css'=>'btitle'));
                    tp_cat($id, array('class'=>'btitle post-category', 'link'=>false, 'count'=>'1', 'post_text'=>'')); 

                    el_title($title, array('css'=>'mtitle')); 
                    tp_excerpt($id, array('char'=>$length, 'div'=>'post-excerpt dtext'));                   
                    el_text($e['text'], array('css'=>'dtext'));
                ?>    
                <div class="meta flexic">
                    <?php tp_meta($id, array('meta'=>'date','div'=>'post-meta post-date')); ?>
                    <span class="separator">|</span> 
                    <?php tp_meta($id, array('meta'=>'name','div'=>'post-meta post-author', 'text'=>'By ')); ?>
                </div>
                <?php 
                    //if you have link
                    el_advlink($e['button'], array('div'=>'btn-loop'));
                    //el_static_btn($e['button'], array('as'=>'div')); 
                ?>
            </div>        
        </div>        
    
    </div>
</div>    

<?php div_end(); ?>