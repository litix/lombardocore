<?php 
    global $up;
    $up++;
    load_assets(array('counter', 'aos'));
    $layout = get_row_layout();   
    $e = get_sub_field($layout);

    ## options
    $opt = data_fields($e);
    $col = data_colcount($e);

    section_class('count-01');
    div_start('dflex', array('data'=>data_set($opt)));  
?>

<div class="container-xl">         
<div class="row dcounters dcounters-<?php _e($up); ?>">
    <?php 
    $rp = $e['items'];

    if($rp):
        foreach($rp as $r):

        $c = $r['counter'];

        $pre = $c['pre'];
        if($pre)
            $pre = "<span class=\"cpre\">{$pre}</span>";

        $post = $c['post'];       
        if($post)
            $post = "<span class=\"cpos\">{$post}</span>";

        $count = $c['count'];
        if($count) {
            $dec = '';
            if(strpos($count, '.') > 0) 
                $dec = 'data-decimals="1"';
                
            $count = "<span class=\"ct\" {$dec} 
            data-to=\"{$count}\" 
            data-speed=\"5000\">0</span>";
        }
    ?>

    <div class="col-md-<?php _e($col); ?> cc">    

        <div class="item">
            <?php 
                el_title($r['before_title'], array('css'=>'btitle')); 
                el_img($r['icon'], array('div'=>'diconn'));                
            ?>
            
            <div class="count_up">
                <?php echo "{$pre}{$count}{$post}"; ?>
            </div>

            <div class="dinfo">
            <?php 

                el_title($r['mtitle']);
                el_title($r['title'], array('css'=>'ititle'));
                el_title($r['after_title'], array('css'=>'atitle'));
                el_text($r['editor']);
                el_text($r['text'], array('css'=>'ptext'));
            ?>   
            </div>
        </div>
        
    </div>   

    <?php 
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
    $('.dcounters-<?php _e($up); ?>').appear(function() {
        $('.dcounters-<?php _e($up); ?> .ct').countTo();
    },{accY: -100});      
});   
</script>
<?php endif; ?>