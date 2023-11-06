<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    
    section_class('iconflex-01');
    div_start('dflex', array('data'=>data_set($opt)));   
?>

<div class="container-xl">         
<div class="flexic" <?php data_colgap($e); ?>>

    <?php 
    $rp = $e['icons'];

    if($rp):
        foreach($rp as $r):
            $tag = el_notlink($r['button']);
    ?>

    <div class="flex-item" <?php data_colgap($e, 1,'p'); ?>>    

        <?php _e($tag[0]); ?>

        <div class="dinfo">

            <div class="diconn">
                <?php el_img($r['iconn']); ?>
            </div>

            <div class="pad">
                <?php 
                    el_title($r['before_title'], array('css'=>'btitle'));
                    el_title($r['mtitle']);
                    if(!$r['mtitle'])
                        el_title($r['title'], array('css'=>'ititle'));
                    el_title($r['after_title'], array('css'=>'atitle'));
                    el_text($r['editor']);
                    el_text($r['text'], array('css'=>'ptext'));
                ?>   
            </div>  

        </div>

        <?php el_static_btn($r['button'], array('as'=>'div')); ?>

        <?php _e($tag[1]); ?>
        
    </div>   

    <?php 
        endforeach;
    endif;
    ?>

</div>
</div>    

<?php div_end(); ?>