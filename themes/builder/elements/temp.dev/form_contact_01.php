<?php 
    load_assets(array('gform'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = data_fields($e);

    section_class('gf-01');
    div_start('dflex', array('data'=>data_set($opt)));  
?>

<div class="container-xl">      

    <div class="dinfo">
        <?php 
            el_img($e['icon'], array('div'=>'diconn'));
            el_title($e['before_title'], array('css'=>'btitle'));
            el_title($e['mtitle'], array('class'=>'f40'));
            el_title($e['after_title'], array('css'=>'atitle'));
            el_text($e['editor']);
        ?>    
    </div>  

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

<?php div_end(); ?>