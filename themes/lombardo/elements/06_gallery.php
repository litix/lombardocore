<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('06_gallery_layout');
div_start('py-[100px]');
?>
<div class="site-container">
    <div class="grid grid-cols-3 tablet:grid-cols-2 mobile:grid-cols-1 gap-[30px] z-0 gallert_list">
        <?php if ($e['list']) : ?>
        <?php foreach ($e['list'] as $list) : ?>
        <div
            class='relative max-h-[277px] tablet:max-h-[100%] after:h-full after:w-full after:top-0 after:left-0 after:absolute after:bg-gradient-to-t after:from-stone-800 after:z-[1] item'>
            <?php if ($list['image_video']['media-type'] == 'm-youtube') :
                        $image_url = wp_get_attachment_image_url($list['image_video']['thumbnail']);
                    ?>
            <a class="item-link" data-fancybox data-caption="<?php echo $list['title']; ?>"
                href="<?php echo $list['image_video']['url']; ?>&amp;autoplay=1&amp;rel=0&amp;controls=0&amp;showinfo=0">
                <img class="w-full !h-full object-cover item-link-image" src="<?php echo $image_url; ?>"
                    alt="<?php echo $list['title']; ?>">
                <div class="play-button absolute-center animate-pulse m-auto z-20"></div>
            </a>

            <h3
                class="absolute bottom-[30px] left-[30px] z-10 text-white text-lg font-normal font-inter leading-[27px]">
                <?php echo $list['title']; ?></h3>
            <?php else :
                        $image_url = wp_get_attachment_image_url($list['image_video']['image']);
                    ?>
            <a class="!cursor-pointer relative z-10 w-full h-full" data-fancybox="images"
                data-caption="<?php echo $list['title']; ?>" href="<?php echo $image_url; ?>">
                <img class="w-full !h-full object-cover" src="<?php echo $image_url; ?>"
                    alt="<?php echo $list['title']; ?>">
            </a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php div_end(); ?>