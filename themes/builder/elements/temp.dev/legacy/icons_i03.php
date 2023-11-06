<?php 
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);
    
    ## options
    $opt = $e['display_fields'];
    $col = data_col($opt['col_count']);

    section_class('el-icons icons-3 i03');
    div_start('dflex', array('data'=>data_set($opt))); 
?>

<div class="container-xl">         
<div class="row">
    <?php 
    $rp = $e['icons'];

    if($rp):
        foreach($rp as $r):
            $tag = el_notlink($r['button']); //set <a> or <div>
    ?>

    <div class="col-md-<?php _e($col); ?> cc">    

        <?php _e($tag[0]); ?>

            <div class="diconn">
                <?php el_img($r['iconn']); ?>
            </div>

            <?php 
                el_title($r['before_title'], array('css'=>'btitle'));
                el_title($r['mtitle']);
                if(!$r['mtitle'])
                    el_title($r['title'], array('css'=>'ititle'));
                el_title($r['after_title'], array('css'=>'atitle'));
                el_text($r['editor']);
                el_text($r['text'], array('css'=>'ptext'));
                el_static_btn($r['button'], array('as'=>'div', 'div'=>'abtn-loop'));                 
            ?>   

        <?php _e($tag[1]); ?>
        
    </div>   

    <?php 
        endforeach;
    endif;
    ?>
</div>
</div>    

<?php div_end(); ?>


<?php 
## Updated    : Apr 15 2023
## Element    : Icons I03
## Group      : Templates [OPT] [1]
## Version    : 0.2
?>