<?php 
    load_assets(array('gform'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colsize($e);

    section_class('frcontact-01');
    div_start('dflex', array('data'=>data_set($opt)));
?>

<div class="container-xl">      
    <div class="row">

        <div class="col-md-<?php echo $col[0]; ?> cc">    
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
    
        <div class="col-md-<?php echo $col[1]; ?> cc">

            <div class="dinfo">
            <?php 
                el_img($e['icon'], array('div'=>'diconn'));
                el_title($e['before_title'], array('css'=>'btitle'));
                el_title($e['mtitle']);
                
                el_text($e['editor']);
            ?>    
            </div>        

            <div class="soc-med mt-5">
                <?php el_title($e['after_title'], array('css'=>'atitle')); ?>
                <?php echo do_shortcode('[social-icons]'); ?>
            </div>

            <div class="company-contact mt-5">
                <div class="mb-3"><?php echo do_shortcode('[contact-phone icon="1" linked="1" loop="1"]'); ?></div>
                <div class="mb-3"><?php echo do_shortcode('[contact-email icon="1" loop="1"]'); ?></div>
                <?php echo do_shortcode('[contact-address icon="1" linked="1" loop="1"]'); ?>
            </div>
        </div>        
    
    </div>
</div>    

<?php div_end(); ?>

