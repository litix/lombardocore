<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = $e['display_fields'];
    $col = data_col($opt['col_count']); 

    section_class('el-cards cards-2 c02');
    div_start('dflex', array('data'=>data_set($opt)));  
?>

<div class="container-xl">         
<div class="flexic">
    <?php 
    $rp = $e['cards'];

    if($rp):
        foreach($rp as $r):
            $tag = el_notlink($r['button']);
    ?>

        <?php _e($tag[0]); ?>

            <div class="dinfo">

                <div class="dimage dflex-center">
                    <?php 
                        el_img($r['image'], array('class'=>'img-bg')); 
                        el_img($r['logo'], array('class'=>'logo'));
                    ?>
                </div>
                
                <div class="dlogo">
                    <?php el_img($r['logo'], array('class'=>'logo')); ?>
                </div>
                

                <div class="pad">
                    <?php 
                        el_title($r['before_title'], array('css'=>'btitle'));
                        if(!$r['mtitle'])
                            el_title($r['title'], array('css'=>'ititle'));
                        el_title($r['after_title'], array('css'=>'atitle'));
                        el_title($r['after_title'], array('css'=>'atitle'));
                        el_text($r['editor']);
                        el_text($r['text'], array('css'=>'ptext'));
                    ?>   
                </div>  

            </div>

        <?php _e($tag[1]); ?>
        

    <?php 
        endforeach;
    endif;
    ?>
</div>
</div>    

<?php div_end(); ?>

<?php 
## Updated    : Apr 14 2023
## Element    : Cards Logo CL01
## Group      : Templates [OPT] [1]
## Version    : 0.3
?>