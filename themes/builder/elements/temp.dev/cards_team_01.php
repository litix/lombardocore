<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colcount($e);
    
    section_class('team-01');
    div_start('dflex', array('data'=>data_set($opt)));   
?>

<div class="container-xl">         
<div class="row">

    <?php 
    $rp = $e['team'];

    if($rp):
        foreach($rp as $r):
    ?>

    <div class="col-md-<?php _e($col); ?>">    

            <div class="item">

                <div class="dimage">
                    <?php el_bg($r['avatar'], array('class'=>'overlay')); ?>
                    <div class="overlay color"></div>
                </div>

                <div class="dinfo">
                    <?php 
                        el_title($r['title'], array('css'=>'ititle'));
                        el_title($r['before_title'], array('css'=>'btitle'));
                    ?>   
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