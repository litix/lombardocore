<?php  
    load_assets(array());
    $layout = get_row_layout();    
    $e = get_sub_field($layout);

    $opt = data_fields($e);

    section_class('title-so-01', array());
    div_start('dflex', array('data'=>data_set($opt)));
?>

<div class="container-xl">

    <div class="col-info">
    <?php 
        $rp = $e['cfg_content']; ##flexible clone

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

<?php div_end(); ?>