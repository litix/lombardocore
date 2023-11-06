<?php 
    load_assets(array('bootstrap'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $media = $e['cfg_media'];
    section_class("el-flex is-{$media['type']}");
    div_start();    

    $d = $e['display_fields'];
    bd_media_embed($media);    
?>
<div class="overlay color"></div>
<div class="container-xl m-container" <?php //echo el_opt($d); ?>>      
    <div class="dinfo" <?php //echo el_align($d); ?>>

        <?php 
        $rp = $e['content']; 
        // print_r($rp); //flexible content field
        if($rp):
            foreach( $rp as $r ):
        
            $row = $r['acf_fc_layout'];
            
            if($row == 'title'):
                bd_title($r['title'], "dtitle", 'f-item', 1, 'mtitle' );

            elseif($row == 'mini_title'): 
                bd_title($r['mini_title'], 'btitle', '', 1, 'btitle');          

            elseif($row == 'text'): 
                bd_text($r['text'], "dtext f-item", 1);    
                
            elseif($row == 'logo'): 
                bd_img($r['logo'], '', "dlogo f-item", 1);       

            elseif($row == 'button'): 
                el_btnloop($r['button_loop']);

            endif;    
        
            endforeach; 
        endif;          
        ?>

    </div>        
</div>    

<?php div_end(); ?>

<style>
    .el-flex .wrap { padding: 60px 0; }
    /* .el-flex .overlay.color { background-color: rgba(0,0,0,0.2); } */
    .el-flex .f-item { margin-top: 20px; }
    .el-flex .f-item:first-child { margin-top: 0px; }
    .el-flex .dtext { margin-top: 30px; }
    .el-flex .btn-loop { margin-top: 40px; }
    .el-flex .diframe { height: 145%; } 

    .is-map .wrap { align-items: flex-start; }
    .is-map .dinfo {
        padding: 30px;
        background-color: rgba(255,255,255, 0.9);
        text-align: center;
        border: 1px solid var(--color5);
    }
    .is-map .overlay.color { display: none; }
    .is-map .btn span { text-transform: capitalize; color: var(--color); font-size: 14px;  }
    .is-map .btn.w-icon span::before { display:none }
    .is-map .btn-loop { margin-top: 15px; }
    .is-map .dtitle { position: relative; }
    .is-map .dtitle::after {  
        content: "";
        border-bottom: 1px solid var(--color5);
        display: block;
        width: 75%;
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
    }
    .m-container { max-width: unset; width: auto;  }

    .el-flex iframe, .el-flex video { filter: grayscale(1); }
    .el-flex video { object-position: center bottom; }
    /*
    
    .is-map .dtitle { font-size: 30px; }
    .is-map .btn-loop,
    .is-map .dtext { margin-top: 20px; }
    .is-map .dinfo {
        top: 50%;
        transform: translateY(-50%);
        position: absolute;
        width: 100%;
        max-width: 400px;
    }
    .is-map .dinfo {
        padding: 30px;
        background-color: var(--color2);
    }
    */
</style>

