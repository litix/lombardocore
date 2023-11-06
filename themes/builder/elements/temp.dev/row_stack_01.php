<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colsize($e);

    section_class('rowmedia-01');
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
                $rp = $e['flex_content']; 

                if($rp):
                    foreach( $rp as $r ):
                
                    $row = $r['acf_fc_layout'];
                    
                    if($row == 'main_title'):
                        el_title($r['main_title']);
                
                    elseif($row == 'seo_title'):                
                        el_title($r['seo_title'], array('css'=>'btitle'));
                
                    elseif($row == 'alt_title'): 
                        el_title($r['alt_title'], array('css'=>'atitle'));
                
                    elseif($row == 'text'): 
                        if($r['full'] == true):
                            el_text($r['text_full'], array("class"=>"dtext dtext-f", 'full'=>true));
                        else:
                            el_text($r['text'], array("class"=>"dtext"));    
                        endif;
                        
                    elseif($row == 'logo'): 
                        el_img($r['logo']);
                
                    elseif($row == 'button'): 
                        el_btnloop($r['button_loop'], array('div'=>"btn-loop"));
                
                    endif;    
                
                    endforeach; 
                endif; 
            ?> 
            </div>        
        </div>        
    
    </div>
</div>    

<?php div_end(); ?>

