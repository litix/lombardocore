<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colsize($e);

    section_class('gfsub-01');
    div_start('dflex', array('data'=>data_set($opt)));  
?>

<div class="container-xl">      
    <div class="row">

    <div class="col-lg-<?php echo $col[0]; ?> cc">    
        <div class="dinfo">
        <?php 
            el_img($e['icon'], array('div'=>'diconn'));
            el_title($e['before_title'], array('css'=>'btitle'));
            el_title($e['mtitle'], array('class'=>'f40'));
            el_title($e['after_title'], array('css'=>'atitle'));
            el_text($e['editor']);
        ?>    
        </div>                   
    </div>    
    
    <div class="col-lg-<?php echo $col[1]; ?> cc">
        <div class="gform">
            <?php 
                if(!is_admin()) {
                    echo do_shortcode('[gravityform id="'. $e['form_id'] .'" title="false" description="false" ajax="true"]'); 
                } else {
                    echo "<div clas=\"p-5\">Gravity Form</div>";
                }
            ?>
        </div>
    </div>        
    

    </div>
</div>    

<?php div_end(); ?>