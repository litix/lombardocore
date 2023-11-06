<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
$gallery = $e['gallery'];
section_class('');
div_start('pt-[100px] pb-[35px]');
?>

<div class="site-container">
    <div class="grid grid-cols-2 gap-[100px] tablet:gap-[30px] mobile:grid-cols-1 mobile:gap-[30px]">
        <div class="col-span-1">
            <!--owl -->
            <?php if ($gallery) : ?>
            <div class="owl-carousel idcarousel w-full ">
                <?php $item = 1;
                    foreach ($gallery as $g) : ?>
                <a href="<?= $g['url']; ?>" data-fancybox="gallery" data-caption="<?php echo $g['title']; ?>">
                    <img src="<?= $g['url']; ?>" alt="<?php echo $g['title']; ?>" class="w-full h-full shadow-lg">
                </a>
                <?php $item++;
                    endforeach; ?>
            </div>
            <?php else : ?>
            <div class="owl-carousel idcarousel w-full animate-pulse">
                <?php $count = 0;
                    $init = is_admin() ? 1 : 5;
                    while ($count < $init) : ?>
                <a href="#" data-fancybox="gallery" data-caption="image Title">
                    <img src="https://placehold.co/600x400" class="w-full h-full shadow-lg">
                </a>
                <?php $count++;
                    endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-span-1 flex flex-col justify-center flex-wrap">
            <?php
            $rp = $e['cfg_content']; //flexible clone
            $div = '';
            if ($rp) :
                foreach ($rp as $r) :
                    $row = $r['acf_fc_layout'];
                    if ($row == 'main_title') :
                        el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title', 'div' => $div));
            ?>
            <div class="tw-border"></div>
            <?php
                    elseif ($row == 'seo_title') :
                        el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading', 'div' => $div));
                    elseif ($row == 'alt_title') :
                        el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title', 'div' => $div));
                    elseif ($row == 'text') :
                        if ($r['full'] == true) :
                            el_text($r['text_full'], array('class' => 'tw-description', 'full' => true));
                        else :
                            el_text($r['text'], array('class' => 'tw-description'));
                        endif;
                    elseif ($row == 'logo') :
                        el_img($r['logo'], array('div' => $div));
                    elseif ($row == 'button') :
                        el_btnloop($r['button_loop'], array('div' => 'btn-loop {$div}'));
                    endif;
                endforeach; ?>
            <?php else : ?>
            <p class="h-2 bg-[#777] w-3/5 rounded"></p>
            <div class="tw-border"></div>
            <p class="h-2 bg-[#777] w-2/5 rounded"></p>
            <p class="h-2 bg-[#777] w-3/5 rounded"></p>
            <p class="h-2 bg-[#777] rounded"></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="bottom mt-[65px]">
        <?php
        $rp = $e['bottom_cfg_content']; //flexible clone
        $div = '';
        if ($rp) :
            foreach ($rp as $r) :
                $row = $r['acf_fc_layout'];
                if ($row == 'main_title') :
                    el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title', 'div' => $div));
        ?>
        <div class="tw-border"></div>
        <?php
                elseif ($row == 'seo_title') :
                    el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading', 'div' => $div));
                elseif ($row == 'alt_title') :
                    el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title', 'div' => $div));
                elseif ($row == 'text') :
                    if ($r['full'] == true) :
                        el_text($r['text_full'], array('class' => 'tw-description', 'full' => true));
                    else :
                        el_text($r['text'], array('class' => 'tw-description'));
                    endif;
                elseif ($row == 'logo') :
                    el_img($r['logo'], array('div' => $div));
                elseif ($row == 'button') :
                    el_btnloop($r['button_loop'], array('div' => 'btn-loop {$div}'));
                endif;
            endforeach;
        else : ?>
        <div class="animate-pulse">
            <p class="h-2 w-1/3 bg-slate-700 rounded"></p>
            <p class="h-2 w-2/3 bg-slate-700 rounded"></p>
            <p class="h-2 bg-slate-700 rounded"></p>
            <p class="h-2 bg-slate-700 rounded"></p>
        </div>
        <?php endif;
        ?>
    </div>
</div>

<?php div_end(); ?>
<?php if (!is_admin()) : ?>
<script>
var $ = jQuery.noConflict();
$(function() {
    var owl = $('.idcarousel').owlCarousel({
        items: 1,
        loop: true, // Loop through slides
        margin: 0, // Space between each slide
        nav: false, // Show navigation arrows
        dots: false, // Show navigation dots
        autoWidth: false,
        autoplay: true, // Autoplay slides
        autoplayTimeout: 6000, // Autoplay speed in milliseconds
    });
});
</script>
<?php endif; ?>