<?php 
    global $pop_gf;
    $pop_gf++;

    load_assets(array('gform'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = data_fields($e);

    ##
    $id = $e['popup_id'];
    $file_name = $e['file_name'];  
    $file = $e['file_url'];

    section_class('ugf-01 hide-me');
    div_start('dcol nowrap', array('data'=>data_set($opt), 'id'=>$id));  
?>

    <div class="gform element p-2">
        <h4 class="ititle mb-2">Download : <?php _e($file_name); ?></h4>
        <?php 
            if(!is_admin()) {
                echo do_shortcode('[gravityform id="'. $e['form_id'] .'" title="false" description="false" ajax="true"]'); 
            } else {
                echo "<div clas=\"p-5\">Gravity Form</div>";
            }
        ?>
    </div>

<?php div_end(); ?>

<?php if(!is_admin()): ?>   
<script>
var $ = jQuery.noConflict();
$(function() {


    $('a[data-src="#<?php _e($id); ?>"]').click(function() {
        
        $('input#input_3_4').val('<?php _e($file_name); ?>');
        $('input#input_3_5').val('<?php _e($file); ?>');

    });   

});    
</script>        
<?php endif; ?> 