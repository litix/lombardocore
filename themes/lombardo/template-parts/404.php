<?php load_assets(array('error-css')); ?>
<section class="el-error light-theme ver-0">
<div class="wrap">
    <div class="container max-1200">

        <?php 
            global $tpath;
            $e = theme_placeholder();
            $pic = $e['404_image'];
            $ph = $tpath . '/images/placeholder/404.svg';
        ?>
        <div class="pic-404">
            <?php 
                if($pic) {
                    el_img($pic);
                } else {
                    el_img($ph);
                }
            ?>    
        </div>     

        <div class="info-404 text-center">
            <div class="text">Oops. The page you're looking for doesn't exist.</div>
            <div class="search"><?php echo do_shortcode('[search-form text="Make a search..."]'); ?></div>
            <a class="btn btn-1" href="<?php echo home_url(); ?>">
                <span>Back Home</span>
            </a>
        </div>

    </div>             
</div>
</section>