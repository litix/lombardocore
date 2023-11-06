<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = $e['display_fields'];
    $col = data_col($opt['col_count']); 
    
    section_class('el-cards cards-1 c01');
    div_start('dflex', array('data'=>data_set($opt)));   
?>

<div class="container-xl">         
<div class="row">

    <?php 
    $rp = $e['cards'];

    if($rp):
        foreach($rp as $r):
            $tag = el_notlink($r['button']);
    ?>

    <div class="col-md-<?php _e($col); ?> cc">    

        <?php _e($tag[0]); ?>

            <div class="dinfo">

                <div class="dimage">
                    <?php el_img($r['image'], array('class'=>'img-bg')); ?>
                    <div class="overlay color"></div>
                </div>

                <div class="pad">
                    <?php 
                        el_title($r['before_title'], array('css'=>'btitle'));
                        el_title($r['mtitle'], array('class'=>'f21'));
                        if(!$r['mtitle'])
                            el_title($r['title'], array('css'=>'ititle'));
                        el_title($r['after_title'], array('css'=>'atitle'));
                        el_text($r['editor']);
                        el_text($r['text'], array('css'=>'ptext'));
                    ?>   
                </div>  

            </div>

            <div class="abtn-loop">
                <?php el_static_btn($r['button'], array('as'=>'div')); ?>
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


<?php 
## Updated    : Apr 14 2023
## Element    : Cards C01
## Group      : Templates [OPT] [1]
## Version    : 0.1
?>