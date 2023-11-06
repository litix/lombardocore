<?php 
    global $ax;
    $ax++;

    load_assets(array());
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    $col = data_colcount($e);
    
    section_class('axlessd-01');
    div_start('dflex', array('data'=>data_set($opt)));   

    $count = $opt['ctr'];

    $class = 'hide-me';
    if(is_admin())
        $class = '';

?>

<div class="container-xl">      

    <div class="flexic demo" <?php data_colgap($e); ?>>

        <?php 
        $rp = $e['items'];

        $i = 0;
        if($rp):
            foreach($rp as $r):
        ?>

            <div class="flex-item demo-box ax-<?= $ax ?> <?= $class ?>" <?php data_colgap($e, 1,'p'); ?>>
                <div class="pad">
                    <?php echo $r['text']; ?>
                </div>
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
        <a class="a-btn btn btn-2 mt-5" id="loadmore-<?= $ax ?>">
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

/*    
    PURE 

    var item = $('.ax');
    size = item.size();
	
    x = 3;
    adder = 3;

    $('.ax:lt('+x+')').show();
	
    $('#loadmore-3').click(function () {
        
        x = (x+adder <= size) ? x+adder : size;
		
        $('.ax:lt('+x+')').show();
		
        if(x >= size) { 
			$('#loadmore').hide(); 
		}

    });  
*/

});   
</script>         

<?php endif; ?>