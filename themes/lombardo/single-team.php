<?php
get_header();
get_builder_menu();
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$position = get_field('position');
?>
<main class="single-post py-[100px] relative">
    <div class="tw-overlay bg-overlay"></div>
    <div class="site-container">
        <div class="grid grid-cols-[370px_auto] gap-[130px] tablet:gap-[30px] mobile:grid-cols-1">
            <img class="w-full h-auto shadow-xl" src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>">
            <div>
                <h2 class="tw-title"><?php the_title(); ?></h2>
                <h3 class="position tw-description mt-[10px]"><?php echo $position; ?></h3>
                <div class="tw-description mt-[46px]">
                    <?php echo the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_builder_end();
get_footer();
?>