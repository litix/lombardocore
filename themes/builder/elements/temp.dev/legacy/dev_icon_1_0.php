<?php  
    global $tpath;
    $layout = get_row_layout();    
    $e = get_sub_field($layout);

    load_assets(array('height'));
    section_class("el-icons");
    div_start();

    $arc = $tpath . '/images/icons/icon-arc.svg';
?>
<div class="container-max">
<div class="flexic">
    <?php 
        $rp = $e['icons'];
        if($rp):
        foreach( $rp as $r ) :

          $btn = link_meta($r['link']);
          
          if($btn[0] != '') {
              $tag1 = "<a href=\"{$btn[0]}\" target=\"{$btn[2]}\" class=\"iconic\">";
              $tag2 = '</a>';
          } else {
              $tag1 = '<div class="iconic">';
              $tag2 = '</div>';
          }

          $icon1 = $r['icon_1'];
          $icon2 = $r['icon_2'];
          if($icon2 == '') {
            $icon2 = $icon1;
          }
    ?>
        <?php echo $tag1; ?>
        
        <!--
        <div class="more-bg">
            <span class="link-more"><?php echo $btn[1]; ?></span>
        </div>
        -->
        <div class="front match-h">
            <div class="icon-div">
                <?php 
                    bd_img($icon1,'','icon-1');
                    bd_img($icon2,'','icon-2');                     
                ?> 
            </div>
            <?php bd_text($r['initial'], 'dtext initial'); ?>
            <?php bd_text($r['text'], 'dtext full'); ?>
            <?php bd_img($arc, '', 'arc'); ?>    
        </div>
        <?php echo $tag2; ?>    

    <?php 
        endforeach; 
        endif;
    ?>  
</div>
</div>       
<?php div_end(); ?>