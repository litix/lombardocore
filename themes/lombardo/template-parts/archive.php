<?php 
    ## LINK assets/theme/css-blog.css
    load_assets(array('height', 'css-blog'));

    if(is_tag()) { $title = 'Tags'; }
    if(is_category()) { $title = 'Category'; }
?>
<section class="element archive-title top-title">
    <div class="container-xl">
        <small><?php echo $title; ?></small>
        <h1 class="dtitle font-1"><?php single_cat_title(); ?></h1>
    </div>
</section>

<section class="element archive-posts ver-0" >
<div class="wrap">
    <div class="container-xl">
        <?php  

            ## LINK template-parts/.template/loop/grid-default.php
            get_template_part("template-parts/.template/loop/grid", 'default'); 

        ?>
    </div>
</div> 
</section>  