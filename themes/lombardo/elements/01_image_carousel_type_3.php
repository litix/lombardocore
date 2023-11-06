<?php
load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
$gallery = $e['gallery'];
section_class('01_image_carousel_type_3');
div_start('pt-[101px] pb-[100px]');

?>
<!--Overlay Background -->
<div class="tw-overlay bg-image1  max-h-[400px] "></div>

<!--Heading Box -->
<div class="site-container">
    <div class="flex flex-col justify-center items-center">
        <?php
        $rp = $e['cfg_content']; //flexible clone
        $div = '';
        if ($rp) :
            foreach ($rp as $r) :
                $row = $r['acf_fc_layout'];
                if ($row == 'main_title') :
                    el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title mt-[10px] text-center', 'div' => $div));
        ?>
        <!-- <div class="tw-border"></div> -->
        <?php
                elseif ($row == 'seo_title') :
                    el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading text-center', 'div' => $div));
                elseif ($row == 'alt_title') :
                    el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title', 'div' => $div));
                elseif ($row == 'text') :
                    if ($r['full'] == true) :
                        el_text($r['text_full'], array('class' => 'tw-description max-w-[770px] text-center mt-[23px]', 'full' => true));
                    else :
                        el_text($r['text'], array('class' => 'tw-description max-w-[770px] text-center mt-[23px]'));
                    endif;
                elseif ($row == 'logo') :
                    el_img($r['logo'], array('div' => $div));
                elseif ($row == 'button') :
                    el_btnloop($r['button_loop'], array('class' => 'btn-3', 'div' => 'btn-loop'));
                endif;
            endforeach;
        endif;
        ?>
    </div>
</div>

<!--Type 3 Carousel -->
<div class="flex justify-center items-center gap-[48px] mt-[26px]">
    <!--prev -->
    <div class="ct3-prev group cursor-pointer laptop_lg:hidden">
        <svg class="group-hover:fill-[#0090CC]" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
            viewBox="0 0 40 40" fill="none">
            <rect x="-0.5" y="0.5" width="39" height="39" rx="19.5" transform="matrix(-1 0 0 1 39 0)"
                stroke="#ABABAB" />
            <path class="group-hover:fill-white"
                d="M22.9231 14.9749C23.1076 15.1409 23.0925 15.355 22.8777 15.6173L18.7485 20.4846L22.8547 25.3714C23.0682 25.6347 23.0823 25.8489 22.8969 26.014L22.1946 26.6402C21.9897 26.8149 21.7805 26.7755 21.567 26.5219L16.7326 20.8157C16.5482 20.5914 16.5487 20.3675 16.7342 20.144L21.5955 14.4607C21.8103 14.2081 22.0197 14.1697 22.2237 14.3454L22.9231 14.9749Z"
                fill="#ABABAB" />
        </svg>
    </div>
    <!--owl-->
    <div class="owl-carousel ct3 basis-[1200px] max-w-[1200px]">
        <?php $item = 1;
        foreach ($gallery as $g) : ?>
        <div data-id="dd-<?php echo $item; ?>" class="group w-[363px] min-h-[308px] !cursor-pointer relative">
            <img src="<?= $g['image']['url'] ?>" alt="<?php echo $g['title']; ?>"
                class="w-full h-full top-0 left-0 object-cover min-h-[308px]">
            <div class="pt-[19px] pb-[10px] px-[20px] z-10 text-center absolute bottom-[27px] left-0">
                <h3
                    class="text-center text-white text-2xl font-bold font-barlow leading-[28.80px]
                        before:inline-block before:content-[''] before:overflow-hidden before:w-0.5 before:h-[22px] before:bg-zinc-300 before:relative before:left-[-5px] before:top-[2px] before:z-10">
                    <?php echo $g['title']; ?></h3>
            </div>
            <div class="w-full h-[140px] mix-blend-multiply bg-gradient-to-t from-zinc-800  absolute bottom-0 left-0">
            </div>
        </div>
        <?php $item++;
        endforeach; ?>
    </div>
    <!--next -->
    <div class="ct3-next group cursor-pointer rotate-180 laptop_lg:hidden">
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

<script>
jQuery(document).ready(function() {
    var owl = $('.ct3').owlCarousel({
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

        $('.owl-item').each(function(index, element) {
            $(this).find('.group').removeClass('active');
        });

        var currentItem = event.item.index;

        $('.owl-item').eq(currentItem).find('.group').addClass('active');

    });

    $(".ct3-prev").click(function() {
        $(".ct3").trigger("prev.owl.carousel");
    });

    $(".ct3-next").click(function() {
        $(".ct3").trigger("next.owl.carousel");
    });
});
</script>
<?php div_end(); ?>