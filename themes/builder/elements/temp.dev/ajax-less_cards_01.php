<?php 
    global $ax;
    $ax++;

    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colcount($e);
    
    section_class('axlessc-01');
    div_start('dflex', array('data'=>data_set($opt)));   

    $count = $opt['ctr'];

    $class = 'hide-me';
    if(is_admin())
        $class = '';

?>

<div class="container-xl">         
<div class="row">

    <?php 
    $rp = $e['cards'];

    $i = 0;
    if($rp):
        foreach($rp as $r):
            $tag = el_notlink($r['button']);
    ?>

    <div class="col-md-<?php _e($col); ?> ax-<?= $ax ?> <?= $class ?>">    

        <?php _e($tag[0]); ?>

            <div class="dinfo">

                <div class="dimage">
                    <?php el_img($r['image'], array('class'=>'img-bg')); ?>
                    <div class="overlay color"></div>
                </div>

                <div class="pad">
                    <?php 
                        el_title($r['before_title'], array('css'=>'btitle'));
                        el_title($r['mtitle'], array('css'=>'ititle'));
                        if(!$r['mtitle'])
                            el_title($r['title'], array('css'=>'ititle'));
                        el_title($r['after_title'], array('css'=>'atitle'));
                        el_text($r['editor']);
                        el_text($r['text'], array('css'=>'ptext'));
                    ?>   
                </div>  

            </div>

            <div class="btn-loop">
                <?php el_static_btn($r['button'], array('as'=>'div')); ?>
            </div>

        <?php _e($tag[1]); ?>
        
    </div>   

    <?php 
            $i++;
            if(is_admin())
                if($i == $count) break;

        endforeach;
    endif;
    ?>

</div>

<div class="text-center">
    <a class="a-btn btn-2 mt-5" id="loadmore-<?= $ax ?>">
        <span>Loadmore</span>
    </a>
</div>

</div>    

<?php div_end(); ?>

<?php if(!is_admin()): ?>   
<script>

<?php 
    /* NOTE : change this */
    $item = ".ax-{$ax}"; 
?>    

var $ = jQuery.noConflict();
$(function() {

    var item = $('<?= $item; ?>');
    size_<?= $ax; ?> = item.size();
	
    x_<?= $ax; ?> = <?= $count; ?>;
    adder_<?= $ax; ?> = <?= $count; ?>;

    $('<?= $item; ?>:lt(<?= $count; ?>)').show();
	
    $('#loadmore-<?= $ax ?>').click(function () {
        
        x_<?= $ax; ?> = (x_<?= $ax; ?>+adder_<?= $ax; ?> <= size_<?= $ax; ?>) ? x_<?= $ax; ?>+adder_<?= $ax; ?> : size_<?= $ax; ?>;
		
        $('<?= $item; ?>:lt('+x_<?= $ax; ?>+')').show();
		
        if(x_<?= $ax; ?> >= size_<?= $ax; ?>) { 
			$('#loadmore-<?= $ax ?>').hide(); 
		}

    });  

});   
</script>      
<?php endif; ?>