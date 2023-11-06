<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colcount($e);
    
    section_class('quotes-01');
    div_start('dflex', array('data'=>data_set($opt)));   
?>

<div class="container-xl">         
<div class="row">

    <?php 
    $rp = $e['clients'];

    if($rp):
        foreach($rp as $r):
    ?>

    <div class="col-md-<?php _e($col); ?>">    

            <div class="item">

                <div class="dinfo">
                    <?php 
                        el_text($r['text'], array('css'=>'ptext'));
                        el_text($r['editor']);
                    ?>   
                </div>  

                <hr>

                <div class="flexic">

                    <div class="davatar round">
                        <?php el_bg($r['avatar'], array('class'=>'overlay')); ?>
                    </div>

                    <div class="meta">
                    <?php 
                        el_title($r['title'], array('css'=>'ititle'));
                        el_text($r['before_title'], array('class'=>'btitle wex'));
                        el_text($r['after_title'], array('class'=>'btitle quas'));                
                    ?>
                    </div>

                </div>



            </div>
        
    </div>   

    <?php 
        endforeach;
    endif;
    ?>

</div>
</div>    

<?php div_end(); ?>