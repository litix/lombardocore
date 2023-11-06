<?php 
    global $acc;
    $acc++;
    load_assets(array('bootstrap'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colsize($e);

    ## opener
    $show_first = $opt['open_first'];

    ## this can be image
    $on = "-";
    $off = "+";

    section_class('rowaccordion-01');
    div_start('dflex', array('data'=>data_set($opt)));

    $s = check_media($e['media']);
?>

<div class="container-xl">      
    <div class="row">

        <?php if($s == true): ?>
        <div class="col-md-<?php echo $col[0]; ?> cc">    
            <?php el_media($e['media']); ?>
        </div>    
        <?php endif; ?>
    
        <div class="col-md-<?php echo $col[1]; ?> cc">
            <div class="dinfo">
            <?php 
                el_img($e['icon'], array('div'=>'diconn'));
                el_title($e['before_title'], array('css'=>'btitle'));
                el_title($e['mtitle']);
                el_title($e['title'], array('css'=>'dtitle'));
                el_title($e['after_title'], array('css'=>'atitle'));
                el_text($e['editor']);
                el_text($e['text'], array('css'=>'ptext'));
                el_btnloop($e['button_loop']);
            ?>    
            </div>        

            <div class="acc-content col-info" id="acc-content<?php _e($acc); ?>" data-accordion>
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
                                <?php el_text($r['text'], array('data'=>'data-show')); ?>  
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

