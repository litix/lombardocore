<?php 
    global $coco;
    $coco++;

    load_assets(array('bootstrap'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colsize($e);
    
    section_class('js-collapse-01');
    div_start('dflex', array('data'=>data_set($opt)));   
?>

<div class="container-xl">         
<div class="flexic" <?php data_colgap($e); ?> id="myCTab<?php _e($coco); ?>">

    <?php 
        $rp = $e['cards'];
    ?>

    <div class="col1 md" <?php data_colgap($e, 1,'p'); ?>>
        <ul class="ntabs" role="tablist">
            <?php 
            $i = 0;
            if($rp):
                foreach($rp as $r):

                $liclass = '';
                $class = 'collapsed';
                $aria = 'aria-expanded="false"';
                if($i==0) {
                    $class = '';      
                    $liclass = 'active';      
                    $aria = 'aria-expanded="true"';
                }
            ?>
            
                <li class="nav-item <?php _e($liclass); ?>">
                    <a id="navi-<?php _e($i); ?>" 
                    class="navi <?php _e($class) ?>" 
                    href="#ctab-<?php _e($i); ?>" 
                    data-toggle="collapse" 
                    <?php _e($aria); ?>>
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

            <div class="tab-content" id="xtab-<?php _e($coco); ?>"> 

                <?php 
                $i = 0;
                if($rp):
                    foreach($rp as $r):

                    $class = '';
                    if($i==0) 
                        $class = 'show';
                ?>

                    <div id="ctab-<?php _e($i); ?>" class="collapse <?php _e($class); ?>" data-parent="#xtab-<?php _e($coco); ?>">

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

    $('.navi[aria-expanded="false"]').click(function(event) { 
            $('.navi').parent().removeClass('active');
            $(this).parent().addClass('active');
    })

    $('.navi[aria-expanded="true"]').click(function(event) { 
            $('.navi').parent().removeClass('active');
            $(this).parent().addClass('active');
    })

    $('#myCTab<?php _e($coco); ?>').on('show.bs.collapse', function () {       
        $('.navi[aria-expanded="false"]').click(function(event) { 
            $('.navi').parent().removeClass('active');
            $(this).parent().addClass('active');
        })
    });


});    
</script>        
<?php endif; ?>
