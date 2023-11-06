<?php  
    load_assets(array());
    $layout = get_row_layout();    
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    section_class('colstack-01', array());
    div_start('dflex', array('data'=>data_set($opt), 'style'=>data_height($opt, 0)));
?>

<?php el_media($e['background'], array('as'=>'overlay')); ?>

<div class="overlay color"></div>

<div class="container-xl">

    <div class="col-info">
    <?php 
        $rp = $e['flex_content']; ##flexible clone

        if($rp):
            foreach( $rp as $r ):
        
            $row = $r['acf_fc_layout'];
            
            if($row == 'main_title'):
                el_title($r['main_title'], array('div'=>'fc-item'));
        
            elseif($row == 'seo_title'):                
                el_title($r['seo_title'], array('css'=>'btitle', 'div'=>'fc-item'));
        
            elseif($row == 'alt_title'): 
                el_title($r['alt_title'], array('css'=>'atitle', 'div'=>'fc-item'));
        
            elseif($row == 'text'): 
                if($r['full'] == true):
                    el_text($r['text_full'], array("class"=>"dtext dtext-f fc-item", 'full'=>true));
                else:
                    el_text($r['text'], array("class"=>"dtext fc-item"));    
                endif;
                
            elseif($row == 'logo'): 
                el_img($r['logo'], array('div'=>'fc-item'));
        
            elseif($row == 'button'): 
                el_btnloop($r['button_loop'], array('div'=>"btn-loop fc-item"));

            elseif($row == 'row'):                

                $opt = $r['data_opt'];
                $col = data_isrow($opt, 'col');

                $data = '';
                ob_start();
            ?>

            <div class="fc-item" <?php data_isrow($opt, 'opt'); ?>>
                <div class="row">

                    <div class="col-md-<?php echo $col[0]; ?> cc">    
                        <?php el_media($r['media']); ?>
                    </div>

                    <div class="col-md-<?php echo $col[1]; ?> cc">
                        <div class="dinfo">
                                <?php 
                                el_title($r['title'], array('css'=>'dtitle')); 
                                el_text($r['text'], array('css'=>'ptext'));
                            ?>
                        </div>        
                    </div>   

                </div>
            </div>

            <?php
                $data = ob_get_clean();
                echo $data;               

            //elseif($row == 'something'):
                //do something...

            endif;    
        
            endforeach; 
        endif; 
    ?>
    </div>

</div>    

<?php div_end(); ?>