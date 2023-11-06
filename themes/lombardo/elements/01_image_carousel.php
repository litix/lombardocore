<?php
load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);

$gallery = $e['gallery'];

section_class('image_carousel_layout');

div_start('type_1_wrapper relative !pt-[65px] !pb-[100px]');
?>

<!--heading box-->
<div class="site-container">
    <div class="w-full flex flex-col justify-center text-center items-center content-center">
        <?php
        $rp = $e['cfg_content']; //flexible clone
        $div = '';
        if ($rp) :
            foreach ($rp as $r) :
                $row = $r['acf_fc_layout'];
                if ($row == 'main_title') :
                    el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title mt-[10px]', 'div' => $div));
                elseif ($row == 'seo_title') :
                    el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading', 'div' => $div));
                elseif ($row == 'alt_title') :
                    el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title', 'div' => $div));
                elseif ($row == 'text') :
                    if ($r['full'] == true) :
                        el_text($r['text_full'], array('class' => '{$div}', 'full' => true));
                    else :
                        el_text($r['text'], array('class' => 'dtext {$div}'));
                    endif;
                elseif ($row == 'logo') :
                    el_img($r['logo'], array('div' => $div));
                elseif ($row == 'button') :
                    el_btnloop($r['button_loop'], array('div' => 'btn-loop {$div}'));
                endif;
            endforeach;
        endif;
        ?>
    </div>
</div>


<?php if ($e['background']) : ?>
<img class="h-[500px] w-full mt-[50px] object-cover laptop:h-auto laptop:object-contain mobile:!h-[300px] mobile:object-cover"
    src="<?php echo $e['background']['url']; ?>" alt="<?php echo $e['background']['title']; ?>">
<?php endif; ?>
<!--type 1 carousel -->
<div class="flex justify-center items-center gap-[48px] translate-y-[-90px] mb-[-90px]">
    <!--prev -->
    <div class="prev group cursor-pointer laptop_lg:hidden">
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
    <div class="owl-carousel carousel max-w-[1170px] !basis-[1170px] shadow-lg">
        <?php $item = 1;
        foreach ($gallery as $g) : ?>
        <div data-id="dd-<?php echo $item; ?>" class="group w-[400px] min-h-[330px] !cursor-pointer
                         hover:bg-sky-700 hover:bg-opacity-75">
            <div class="absolute w-full h-full bg-white z-[2] top-0 left-0 transition-all duration-300 ease
                            group-[.active]:!bg-[#0059A0] group-[.active]:!bg-opacity-80  
                            group-hover:bg-[#0059A0] group-hover:!bg-opacity-80 ">
            </div>
            <img src="<?= $g['image']['url'] ?>" alt="<?php echo $g['title']; ?>" class=" absolute w-full h-full top-0 left-0 object-cover min-h-[330px] !hidden 
                        group-[.active]:!block
                        group-hover:!block">
            <div class="pt-[64px] pb-[10px] px-[20px] relative z-10 ">
                <h3 class="text-sky-950  text-2xl font-bold font-barlow leading-[28.80px]
                            group-[.active]:!text-white
                            group-hover:!text-white ">
                    <?php echo $g['title']; ?>
                </h3>
                <div class="w-[330px] h-[3px] my-[24px] relative">
                    <div class="w-[330px] h-px left-0 top-[1px] absolute bg-zinc-300"></div>
                    <div class="w-[100px] transition-all delay-150 ease-in  h-[3px] left-0 top-0 absolute bg-sky-600  
                        group-hover:w-full group-hover:bg-white
                        group-[.active]:w-full group-[.active]:bg-white
                        ">
                    </div>
                </div>
                <div class="w-[330px] text-neutral-500 text-[16px] font-normal font-['Inter'] leading-[27px]  transition-all ease-in 
                        group-hover:!text-white group-hover:!text-[16px]
                        group-[.active]:!text-white group-[.active]:text-[16px]
                        ">
                    <?php echo $g['description']; ?>
                    <?php if ($g['link']) : ?>
                    <a class="text-sky-600 text-[13px] font-normal font-['Inter'] leading-[18.20px] uppercase"
                        href="<?php echo $g['link']['url']; ?>">Read More</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php $item++;
        endforeach; ?>
    </div>
    <!--next -->
    <div class="next group cursor-pointer rotate-180 laptop_lg:hidden">
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
<div class="bg-overlay tw-overlay z-[-1] top-[unset] bottom-0 max-h-[456px]">
</div>

<div class="site-container mt-[50px]">
    <?php $rp = $e['bottom_content_cfg_content']; //flexible clone
    $div = '';
    ?>
    <div class="flex flex-col justify-center  w-full <?php echo (count($rp) <= 1) ? 'items-center' : ''; ?>">
        <?php
        if ($rp) :
            foreach ($rp as $r) :
                $row = $r['acf_fc_layout'];
                if ($row == 'main_title') :
                    el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title', 'div' => $div));
                elseif ($row == 'seo_title') :
                    el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading', 'div' => $div));
                elseif ($row == 'alt_title') :
                    el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title', 'div' => $div));
                elseif ($row == 'text') :
                    if ($r['full'] == true) :
                        el_text($r['text_full'], array('class' => '{$div}', 'full' => true));
                    else :
                        el_text($r['text'], array('class' => 'tw-description {$div}'));
                    endif;
                elseif ($row == 'logo') :
                    el_img($r['logo'], array('div' => $div));
                elseif ($row == 'button') :
                    el_btnloop($r['button_loop'], array('div' => 'btn-loop {$div}'));
                endif;
            endforeach;
        endif;
        ?>
    </div>
</div>

<script>
jQuery(document).ready(function() {
    var owl = $('.carousel').owlCarousel({
        items: 3,
        loop: true, // Loop through slides
        margin: 0, // Space between each slide
        nav: false, // Show navigation arrows
        dots: false, // Show navigation dots
        autoWidth: false,
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

    $(".prev").click(function() {
        $(".carousel").trigger("prev.owl.carousel");
    });

    $(".next").click(function() {
        $(".carousel").trigger("next.owl.carousel");
    });
});
</script>

<?php div_end(); ?>