<?php
load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
$gallery = $e['gallery_image'];
$has_background = $e['has_background'];
section_class('04_full_width_carousel');
div_start('pt-[101px] pb-[100px]');

?>

<!--04_full_width_carousel -->
<div class="flex gap-[48px] items-center justify-center ">
    <!--prev -->
    <div class="full_with_carousel-prev group cursor-pointer z-10 laptop_lg:hidden">
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
    <div class="owl-carousel full_with_carousel  basis-[1170px] max-w-[1170px] laptop_lg:flex-1 laptop_lg:px-[15px]">
        <?php $item = 1;
        if ($gallery) :
            foreach ($gallery as $g) : ?>
        <div class="group w-full shadow">
            <img src="<?= $g['url'] ?>" alt="<?php echo $g['title']; ?>" class="w-full h-full object-cover"
                alt="<?php echo $g['title']; ?>" />
        </div>
        <?php $item++;
            endforeach;
        else :
            ?>
        <?php $count = 0;
            while ($count < 6) :
            ?>
        <div class="group w-full shadow">
            <img class="w-full !h-[277px] object-cover" src="https://placehold.co/1170x1000" alt="image">
        </div>
        <?php $count++;
            endwhile;
        endif; ?>

    </div>
    <!--next -->
    <div class="full_with_carousel-next group cursor-pointer rotate-180 laptop_lg:hidden">
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
    var owl = $('.full_with_carousel').owlCarousel({
        items: 1,
        loop: true, // Loop through slides
        margin: 0, // Space between each slide
        nav: false, // Show navigation arrows
        dots: false, // Show navigation dots
        autoWidth: false,
        autoplay: true, // Autoplay slides
        autoplayTimeout: 3000, // Autoplay speed in milliseconds
        // responsive: {
        //     0: {
        //         items: 1 // Number of slides to show at 0px screen width
        //     },
        //     768: {
        //         items: 2 // Number of slides to show at 768px screen width and above
        //     },
        //     1200: {
        //         items: 3 // Number of slides to show at 1200px screen width and above
        //     }
        // }
    });

    owl.on('changed.owl.carousel', function(event) {

        $('.owl-item').each(function(index, element) {
            $(this).find('.group').removeClass('active');
        });

        var currentItem = event.item.index;

        $('.owl-item').eq(currentItem).find('.group').addClass('active');

    });

    $(".full_with_carousel-prev").click(function() {
        $(".full_with_carousel").trigger("prev.owl.carousel");
    });

    $(".full_with_carousel-next").click(function() {
        $(".full_with_carousel").trigger("next.owl.carousel");
    });
});
</script>
<?php div_end(); ?>