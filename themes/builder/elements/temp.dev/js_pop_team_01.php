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

    $i = 0;
    if($rp):
        foreach($rp as $r):
            $meta = $r['meta'];
    ?>

    <div class="col-md-<?php _e($col); ?>">    

            <a class="item member" href="javascript:;" data-fancybox="members" data-src="#bio<?php _e($i); ?>">

                <div class="dimage" <?php echo echo_style(array('height'=>'300px')); ?>>
                    <?php 
                        el_img($r['avatar'], array('class'=>'overlay')); 
                        // el_bg($r['avatar'], array('class'=>'overlay')); 
                    ?>
                    <div class="overlay color"></div>
                </div>

                <div class="dinfo">
                    <?php 
                        el_title($r['title'], array('css'=>'ititle'));
                        el_title($r['before_title'], array('css'=>'btitle', 'class'=>'author'));
                    ?>   
                </div>  

            </a>

            <!-- popup -->
            <div class="dnone" >
                <div id="bio<?php _e($i); ?>" class="bio-fc">
                    <div class="container-md p-3">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <?php 
                                el_img($r['avatar'], array('class'=>'mb-3')); 
                                el_title($r['title'], array('css'=>'ititle'));
                                el_text($r['before_title'], array('css'=>'btitle en'));                                
                            ?>
                        </div>
                        <div class="col-md-8">
                            <div class="dinfo p-4">
                            <?php 
                                el_text($r['editor']);
                                el_text($r['text'], array('css'=>'ptext'));
                            ?>
                            </div>

                            <div class="meta social-icons px-4">
                                <?php 
                                    el_social_icon($meta['twitter'], array('s'=>'twitter'));
                                    el_social_icon($meta['linkedin'], array('s'=>'linkedin'));
                                    el_social_icon($meta['email'], array('s'=>'email'));
                                ?>
                            </div>                            
                        </div>              
                    </div>
                    </div>                                                  
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