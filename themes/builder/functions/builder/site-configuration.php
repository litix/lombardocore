<?php 
    $h = theme_config_header();
    $m = theme_config_mobile();
    $t = theme_config_th();
    $f = theme_config_feats();

    $checks = 15;
    $uncheck = 0;
    $offcheck = 0;

    if($qa = theme_dev_list()) {
       $qa1 = count_check_list($qa['dev_qa1']);
       $qa2 = count_check_list($qa['dev_qa2']);
       $qa3 = count_check_list($qa['dev_qa3']);
       $qa4 = count_check_list($qa['dev_qa4']);

       $uncheck = $qa1 + $qa2 + $qa3 + $qa4;

       $offcheck = $checks - $uncheck;
    }    
?>

<div class="admin-site-header">
    <span>Advance Settings</span>
    <div class="hflex">
        <div class="-icon a-si" data-trigger="toggle_information" data-group="3">
            Toggle <?php fa_icon('toggle', 1); ?>
        </div>

        <div class="cus-si opened" data-trigger="main_option">
            Main <?php fa_icon('meatballs', 1); ?>
        </div>

        <?php 
            /*
            if($uncheck < $checks):  ?>
            <div class="a-si" data-trigger="dev_guidelines" data-group="5">
                QA Checklist <small><?php _e($offcheck); ?></small>
            </div>
        <?php 
            endif; 
            */
        ?>
    </div>
</div>

<section class="admin-site-info" data-design="site-preview">
<div class="wrap">
<div class="si-panel" id="si-panel">

    <div class="si-group">

        <?php $unset = '<em class="empty">~</em>'; ?>

        <?php 
        ## Header
        $data = '';

        if(isset($h)) {
            $width = $h['menu_width'];
            $width = "<span class=\"bub\">{$width}</span>";

            $sticky = $h['menu_sticky'];
            $sticky = "<span class=\"bub\">{$sticky}</span>";

            $pos = $h['menu_position'];
            if($pos == 'leftext') { $pos = "left + ext"; }
            $pos = "<span class=\"bub\">{$pos}</span>";

            $trigger = $h['menu_dropdown_trigger'];
            $trigger = "<span class=\"bub\">{$trigger}</span>";

            $drop = $h['menu_dropdown_display'];
            $drop = "<span class=\"bub\">drop-{$drop}</span>";

            $base = array($width, $sticky, $pos, $trigger, $drop);
            $data = implode(" ", $base);
            
        }       
        ?>
        <div class="si-info" data-trigger="header" data-group="3">
            <div class="si-label">Header Menu</div>
            <div class="si-data">
                <div><?php _e($data); ?></div>
                <span class="editme"><?php fa_icon('edit', 1); ?></span>
            </div>
        </div>


        <?php 
        ## Header
        $data = '';

        if(isset($m)) {
            $display = $m['mobile_menu_display'];
            $display = "<span class=\"bub\">{$display}</span>";

            $base = array($display);
            $data = implode(" ", $base);
        }       
        ?>
        <div class="si-info" data-trigger="mobile" data-group="3">
            <div class="si-label">Mobile Menu</div>
            <div class="si-data">
                <div><?php _e($data); ?></div>
                <span class="editme"><?php fa_icon('edit', 1); ?></span>
            </div>
        </div>        



    </div>

    

    <div class="si-group rr">
        
        <div class="si-info" data-trigger="wp_features" data-group="3">
            <div class="si-label">Config <?php fa_icon('settings', 1); ?></div>
            <div class="si-data">Filter Setup <span class="editme"><?php echo fa_icon('edit'); ?></span></div>
        </div>       

        <!--
        <div class="si-info" data-trigger="toggle_information" data-group="3">
            <div class="si-label">Toggle <?php fa_icon('toggle', 1); ?></div>
            <div class="si-data">~ <span class="editme"><?php echo fa_icon('edit'); ?></span></div>
        </div>       
        -->


    </div>

</div> <!-- SI Panel -->   
 </div> <!-- wrap -->   
</section>    


<script>
var $ = jQuery.noConflict();
(function($){

    $('.btn-loop a').removeAttr('href');

    function click_tab(g){
        $('.acf-tab-group li:nth-child(' + g + ') a').click();
    }
    
    $('.si-info, .a-si').each(function(){
        
        $(this).click(function() { 

            var g = $(this).data('group');
            click_tab(g);

            var trigger = $(this).data('trigger');
            $('div[data-name="'+ trigger +'"] a[data-modal]').click();
        });
    });

    setTimeout(function(){ 
        $('.cus-si').trigger('click'); 
    }, 0);

    $('.cus-si').click(function() { 
        $(this).toggleClass('opened');
        $('div#acf-group_5f6d7a886dfab').toggleClass('hide-nyan');
    });
    


})(jQuery)
</script>