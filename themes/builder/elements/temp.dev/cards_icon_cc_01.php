<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colcount($e);
    
    section_class('cardscc-01');
    div_start('dflex', array('data'=>data_set($opt)));   
?>

<div class="container-xl">         
<div class="flexic" <?php data_colgap($e); ?>>

    <?php 
    $rp = $e['cards'];

    if($rp):
        foreach($rp as $r):
            $tag = el_notlink($r['button']);
    ?>

    <div class="flex-item" <?php data_colgap($e, 1,'p'); ?>>    

        <?php _e($tag[0]); ?>

            <div class="overlay color"></div>
            <?php el_bgoverlay($r['bg']); ?>

            <div class="dinfo dback">
                <?php 
                    el_title($r['title'], array('css'=>'ititle'));
                    el_text($r['editor']);
                    el_text($r['text'], array('css'=>'ptext'));               
                ?>
            </div>

            <div class="dfront">
                <div class="diconn">
                    <?php el_img($r['iconn']); ?>
                </div>
                <?php el_title($r['title'], array('css'=>'ititle')); ?>
                <?php /*
                <div class="dimage">
                    <?php //el_img($r['image'], array('class'=>'img-bg')); ?>
                    <div class="overlay color"></div>
                </div>

                <div class="pad">
                    <?php 
                    /*
                        el_title($r['before_title'], array('css'=>'btitle'));
                        el_title($r['mtitle']);
                        if(!$r['mtitle'])
                            
                        el_title($r['after_title'], array('css'=>'atitle'));


                </div>  
                */
                ?>
            </div>

        <?php _e($tag[1]); ?>
        
    </div>   

    <?php 
        endforeach;
    endif;
    ?>

</div>
</div>    

<?php div_end(); ?>