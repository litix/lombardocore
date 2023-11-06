<?php 
    global $tab;
    $tab++;

    load_assets(array('bootstrap'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colsize($e);
    
    section_class('js-tabs-01');
    div_start('dflex', array('data'=>data_set($opt)));   
?>

<div class="container-xl">         
<div class="flexic" <?php data_colgap($e); ?>>

    <?php 
        $rp = $e['cards'];
    ?>

    <div class="col1 md" <?php data_colgap($e, 1,'p'); ?>>
        <ul class="nav ntabs" id="myTab<?php _e($tab); ?>" role="tablist">
            <?php 
            $i = 0;
            if($rp):
                foreach($rp as $r):

                $liclass = '';
                $aria = 'aria-selected="false"';

                if($i==0) {
                    $class = '';      
                    $liclass = 'active';      
                    $aria = 'aria-selected="true"';
                }
            ?>

                <li class="nav-item">
                    <a class="nav-link  <?php _e($liclass); ?>" 
                       id="navi-tab-<?php _e($i); ?>" 
                       data-toggle="tab" 
                       href="#dtab-<?php _e($i); ?>" 
                       role="tab" 
                       aria-controls="dtab-<?php _e($i); ?>" 
                       <?php _e($aria) ?>>
                       <?php el_title($r['title'], array('css'=>'ititle')); ?>
                    </a>
                </li>

            <?php  
                $i++;
                endforeach;
            endif;   
            ?>    
        </ul>
    </div> 

    <div class="col2 md" <?php data_colgap($e, 1,'p'); ?>>    

            <div class="tab-content" id="xtab-<?php _e($tab); ?>"> 

                <?php 
                $i = 0;
                if($rp):
                    foreach($rp as $r):

                    $class = '';
                    if($i==0) 
                        $class = 'active';
                ?>

                    <div id="dtab-<?php _e($i); ?>" 
                         class="tab-pane <?php _e($class); ?>" 
                         role="tabpanel" 
                         aria-labelledby="navi-tab-<?php _e($i); ?>">

                        <div class="pad">
                            <div class="dimage">
                                <?php el_img($r['image'], array('class'=>'img-bg')); ?>
                            </div>

                            <div class="dinfo">
                                <?php 
                                    el_title($r['before_title'], array('css'=>'btitle'));
                                    el_title($r['mtitle']);
                                    //if(!$r['mtitle'])
                                    //  el_title($r['title'], array('css'=>'ititle'));
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



</div>
</div>    

<?php div_end(); ?>


<?php if(!is_admin()): ?>   
<script>
var $ = jQuery.noConflict();
$(function() {

    $('.navi').click(function(event) { 
        $('.navi').removeClass('active');
        $(this).addClass('active');
    })


});    
</script>        
<?php endif; ?>
