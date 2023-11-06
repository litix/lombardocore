<?php 
    ## LINK assets/theme/css-blog.css
    load_assets(array('height', 'css-blog'));  
    
    $allsearch = new WP_Query("s=$s&showposts=-1"); 
?>
    
<section class="element archive-title top-title">
    <div class="container-xl">
        <div class="row vcenter">
        <div class="col-lg-9">
            <small><?php echo $allsearch ->found_posts.' results found.'; ?></small>       
            <h1 class="dtitle font-1">Search</h1>
        </div>    
        <div class="col-lg-3">
            <?php echo do_shortcode('[search-form]');  ?>
        </div>    
        </div>
    </div>
</section>

<section class="element archive-posts ver-0" >
<div class="wrap">
    <div class="container-xl">
        <?php get_template_part("template-parts/.template/loop/grid", 'default'); ?>
    </div>
</div> 
</section>    




