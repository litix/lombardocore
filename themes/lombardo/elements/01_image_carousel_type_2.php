<?php
load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
$gallery = $e['gallery'];
section_class('01_image_carousel_type_2');
div_start('pt-[101px] pb-[100px]');
?>

<div class="site-container">
    <div class="flex justify-between">
        <div class="basis-[770px]">
            <?php
            $rp = $e['cfg_content']; //flexible clone
            $div = '';
            if ($rp) :
                foreach ($rp as $r) :
                    $row = $r['acf_fc_layout'];
                    if ($row == 'main_title') :
                        el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title mt-[10px]', 'div' => $div));
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
                    ?>
            <?php
                    endif;
                endforeach;
            endif;
            ?>
        </div>

        <?php
        if ($rp) :
            foreach ($rp as $r) :
                $row = $r['acf_fc_layout'];
                if ($row == 'button') :
                    el_btnloop($r['button_loop'], array('div' => 'flex-1 self-center text-right'));
                endif;
            endforeach;
        endif;
        ?>
    </div>
</div>
<!--type 1 carousel -->
<div class="flex justify-center items-center gap-[48px] mt-[51px]">
    <!--prev -->
    <div class="ct2-prev group cursor-pointer laptop_lg:hidden">
        <svg class="group-hover:fill-[#0090CC]" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
            viewBox="0 0 40 40" fill="none">
            <rect x="-0.5" y="0.5" width="39" height="39" rx="19.5" transform="matrix(-1 0 0 1 39 0)"
                stroke="#ABABAB" />
            <path class="group-hover:fill-white"
                d="M22.9231 14.9749C23.1076 15.1409 23.0925 15.355 22.8777 15.6173L18.7485 20.4846L22.8547 25.3714C23.0682 25.6347 23.0823 25.8489 22.8969 26.014L22.1946 26.6402C21.9897 26.8149 21.7805 26.7755 21.567 26.5219L16.7326 20.8157C16.5482 20.5914 16.5487 20.3675 16.7342 20.144L21.5955 14.4607C21.8103 14.2081 22.0197 14.1697 22.2237 14.3454L22.9231 14.9749Z"
                fill="#ABABAB" />
        </svg>
    </div>
    <!--owl -->
    <div class="owl-carousel ct2 !basis-[1200px] max-w-[1200px]">
        <?php $item = 1;
        foreach ($gallery as $g) : ?>
        <div data-id="dd-<?php echo $item; ?>" class="group w-[370px] min-h-[330px] !cursor-pointer relative">
            <img src="<?= $g['image']['url'] ?>" alt="<?php echo $g['title']; ?>"
                class="w-full h-full top-0 left-0 object-cover min-h-[450px]">
            <h3
                class="bg-gradient-to-r from-sky-700  absolute bottom-[46.8%] right-[152.5%] w-full p-[11px] pl-[30px] font-inter text-[13px] font-[400] tracking-[2.6px] w-[cal(100% + 80px)] rotate-[-90deg]">
                <span class="relative z-10 text-white"><?php echo $g['image']['title']; ?></span>
            </h3>

            <div class="pt-[19px] pb-[10px] px-[20px] relative z-10 text-center">
                <h3 class="text-center text-sky-950 text-2xl font-bold font-barlow leading-[28.80px]">
                    <?php echo $g['title']; ?></h3>
                <h4
                    class="w-full mt-[10px] text-center text-zinc-400 text-[13px] font-normal font-inter leading-[18.20px]">
                    <?php echo $g['sub_title']; ?></h3>
            </div>
        </div>
        <?php $item++;
        endforeach; ?>
    </div>
    <!--next -->
    <div class="ct2-next group cursor-pointer rotate-180 laptop_lg:hidden">
        <svg class="group-hover:fill-[#0090CC]" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
            viewBox="0 0 40 40" fill="none">
            <rect x="-0.5" y="0.5" width="39" height="39" rx="19.5" transform="matrix(-1 0 0 1 39 0)"
                stroke="#ABABAB" />
            <path class="group-hover:fill-white"
                d="M22.9231 14.9749C23.1076 15.1409 23.0925 15.355 22.8777 15.6173L18.7485 20.4846L22.8547 25.3714C23.0682 25.6347 23.0823 25.8489 22.8969 26.014L22.1946 26.6402C21.9897 26.8149 21.7805 26.7755 21.567 26.5219L16.7326 20.8157C16.5482 20.5914 16.5487 20.3675 16.7342 20.144L21.5955 14.4607C21.8103 14.2081 22.0197 14.1697 22.2237 14.3454L22.9231 14.9749Z"
                fill="#ABABAB" />
        </svg>
    </div>
</div>
<?php if ($e['link_2']) : ?>
<div class="flex justify-center mt-[69px]">
    <a class="btn btn-1" href="<?php echo $e['link_2']['url']; ?>"><span><?php echo $e['link_2']['title']; ?></span></a>
</div>
<?php endif; ?>

<script>
jQuery(document).ready(function() {
    var owl = $('.ct2').owlCarousel({
        items: 3,
        loop: true, // Loop through slides
        margin: 30, // Space between each slide
        nav: false, // Show navigation arrows
        dots: false, // Show navigation dots
        autoWidth: true,
        center: true,
        autoplay: true, // Autoplay slides
        autoplayTimeout: 6000, // Autoplay speed in milliseconds
        responsive: {
            0: {
                items: 1 // Number of slides to show at 0px screen width
            },
            768: {
                items: 2 // Number of slides to show at 768px screen width and above
            },
            1200: {
                items: 3 // Number of slides to show at 1200px screen width and above
            }
        }
    });

    owl.on('changed.owl.carousel', function(event) {

        $(' .owl-item').each(function(index, element) {
            $(this).find('.group').removeClass('active');
        });

        var currentItem = event.item.index;

        $('.owl-item').eq(currentItem).find('.group').addClass('active');

    });

    $(".ct2-prev").click(function() {
        $(".ct2").trigger("prev.owl.carousel");
    });

    $(".ct2-next").click(function() {
        $(".ct2").trigger("next.owl.carousel");
    });
});
</script>
<?php div_end(); ?>