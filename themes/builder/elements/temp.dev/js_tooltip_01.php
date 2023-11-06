<?php 
    global $popico;
    $popico++;

    load_assets(array('tooltip'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    $opt = data_fields($e);
    
    section_class('iconflex-01');
    div_start('dflex', array('data'=>data_set($opt)));   

    $rp = $e['icons'];
    $i = 0;    
?>

<div class="container-xl">         

    <div class="flexic" <?php data_colgap($e); ?>>

        <?php 
        if($rp):
            foreach($rp as $r):
        ?>

        <div class="flex-item" <?php data_colgap($e, 1,'p'); ?>>    
            <div class="item pop-info" 
                data-tooltip-content="#p<?php echo $popico ?>-<?php echo $i; ?>">
                <div>
                <?php 
                    el_img($r['iconn'], array('div'=>'diconn dflex-center')); 
                    el_title($r['title'], array('css'=>'ititle'));
                    el_title($r['mtitle'], array('css'=>'ititle'));
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

    <div class="hide-me">
        <?php 
        $i=0;
        if($rp):
            foreach($rp as $r):
        ?>

        <div class="element icon_tip" id="p<?php echo $popico ?>-<?php echo $i; ?>">
        <div class="dinfo">
            <?php 
                el_title($r['before_title'], array('css'=>'btitle'));
                el_title($r['mtitle'], array('css'=>'ititle'));
                el_title($r['title'], array('css'=>'ititle'));
                el_title($r['after_title'], array('css'=>'atitle'));
                el_text($r['editor']);
                el_text($r['text'], array('css'=>'ptext'));
            ?> 
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

<?php if(!is_admin()): ?>   
<script>
var $ = jQuery.noConflict();
$(function() {

    var screen = $(window);
        if (screen.width() > 992) {

            $('.pop-info').tooltipster({
                animation: 'grow',
                delay: 200,
                speed: 400,
                maxWidth: 350,
                trigger: 'hover',
                position: 'top',
                contentAsHTML: true,
                interactive: true,
                positionTracker: true
            });

        } else {

            $('.pop-info').tooltipster({
                animation: 'grow',
                delay: 200,
                speed: 400,
                maxWidth: 350,
                trigger: 'click',
                position: 'top',
                contentAsHTML: true,
                interactive: true,
                positionTracker: true
            });

        }    

});    
</script>        
<?php endif; ?>