<?php 
    global $acc;
    $acc++;
    load_assets(array('bootstrap'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = data_fields($e);
    $show_first = $opt['open_first'];

    ## this can be image
    $on = "-";
    $off = "+";

    section_class('colaccordion-01');
    div_start('dflex', array('data'=>data_set($opt)));
?>

<div class="container-xl" data-accordion>

    <div class="acc-content col-info" id="acc-content<?php _e($acc); ?>">
        <?php 
        $rp = $e['items'];

        $i = 1;
        if($rp):
            foreach($rp as $r):
        ?>

            <div class="item item-<?php _e("{$acc}-{$i}"); ?>">

                <div class="ihead dflex-space collapsed" 
                     data-toggle="collapse" role="button" data-target="#idrop<?php _e("{$acc}-{$i}"); ?>" 
                     aria-expanded="true">

                    <div class="iclick">
                        <?php el_title($r['title'], array('css'=>'ititle')); ?>
                    </div>

                    <div class="acc-indicator">
                        <div class="off"><?php _e($off); ?></div>
                        <div class="on"><?php _e($on); ?></div>
                    </div>
                    
                </div>

                <div id="idrop<?php _e("{$acc}-{$i}"); ?>" 
                     class="ibox collapse" 
                     data-parent="#acc-content<?php _e($acc); ?>">
                     
                     <div class="pad">
                        <?php 
                            el_title($r['before_title'], array('css'=>'btitle'));
                            el_title($r['mtitle']);                       
                            el_title($r['after_title'], array('css'=>'atitle'));
                            el_text($r['editor']);
                            el_text($r['text'], array('css'=>'ptext'));
                        ?>  
                    </div>

                </div>              

            </div>

        <?php 
            $i++;
            endforeach;
        endif;
        ?>
    </div>
    
</div>    

<?php div_end(); ?>

<?php if(!is_admin()): ?>   
<script>
var $ = jQuery.noConflict();
$(function() {
 
    <?php if($show_first == true): ?>
    setTimeout(function() {
        $('#acc-content<?php _e($acc); ?> .item:first-child .ihead').trigger('click');
    }, 1);
    <?php endif; ?>
 
});    
</script>  
<?php endif; ?>