<?php 
    global $post;
    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = data_fields($e);
    $col = data_colcount($e);
    $c = $opt['col_count'];
   
    section_class('gpost-01');
    div_start('dflex', array('data'=>data_set($opt)));  

    $loop = $e['post_loop'];
    $select = $loop['post_display'];
    $count = $loop['post_count'];  
?>

<div class="container-xl">   

    <div class="dinfo dflex-between">
        <div>
        <?php 
            $d = $e['extra']; 
            
            el_img($d['icon'], array('div'=>'diconn'));
            el_title($d['before_title'], array('css'=>'btitle'));
            el_title($d['mtitle']);
            el_title($d['title'], array('css'=>'dtitle'));
            el_title($d['after_title'], array('css'=>'atitle'));
            el_text($d['editor']);
            el_text($d['text'], array('css'=>'ptext'));
        ?>
        </div>
        <?php el_btnloop($d['button_loop']); ?>
    </div>
    

    <div class="row">       
        <?php 

            if($select == 'rc'):

                $array = array(
                            'type'=>'recent', 
                            'col'=>$c,
                            'count'=>$count,
                            'div'=>"col-md-{$col}"
                        );

                el_loop('', $array);

            endif;


            ## *NOTE - FEATURED 

            if($select == 'fp'):

                $array = array(
                            'type'=>'relationship', 
                            'col'=>$c,
                            'count'=>$count,
                            'div'=>"col-md-{$col}"                        
                        );
                
                el_loop($loop['posts'], $array);

            endif;


            ## *NOTE - FEATURED

            if($select == 'rd'):
                
                $array = array(
                            'type'=>'random', 
                            'col'=>$c,
                            'count'=>$count,
                            'div'=>"col-md-{$col}"                        
                        );
                
                el_loop('', $array);

            endif;

        ?>
    </div>

</div>    

<?php div_end(); ?>