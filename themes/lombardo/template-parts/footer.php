<?php

## LINK assets/theme/tpl-footer-1.css
load_assets(array('menu-config', 'tpl-footer-1', 'owl'));

$e = theme_utility();

$page_settings = get_field('page_settings', $post->ID);

$cta = get_field('cta', 'options');

$footer_slider = get_field('footer_slider', 'options');

$footer_slider_title = get_field('footer_slider_title', 'options');

?>
<footer class="element relative min-h-[745px] bg-transparent
    before:absolute  before:top-0 before:left-0 before:z-[2] before:w-full before:h-auto before:bg-[#F9F9F9] before:!min-h-[392px]
    after:absolute after:z-[-1] after:left-0 after:bottom-0 after:w-full after:h-auto after:min-h-[545px] after:!bg-[#002644]
    laptop:before:min-h-auto 
    mobile:after:!min-h-full
" data-tpl="default">
    <div class="pt-[60px]">
        <!-- Footer Logo Carousel -->
        <div class="site-container">
            <div class="footer_slider">
                <div class="flex flex-col items-center">
                    <div class="tw-title">
                        <?php echo $footer_slider_title; ?>
                    </div>
                </div>
                <div class="my-[40px]">
                    <div class="flex items-center ft_slider owl-carousel owl-theme" id="ft_slider">
                        <?php if ($footer_slider) : ?>
                            <?php foreach ($footer_slider as $item) : ?>
                                <a class="flex items-center h-[88px]" href="<?php echo  $item['link']['url'] ?>">
                                    <img class="w-[86px] h-auto object-contain" src="<?php echo $item['item']['url'] ?>" alt="<?php echo $item['item']['title']; ?>">
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function() {
                var owl = $('.ft_slider').owlCarousel({
                    items: 5,
                    loop: true,
                    margin: 108,
                    autoplay: true,
                    slideTransition: 'linear',
                    // autoplayTimeout: 0,
                    autoplaySpeed: 5000,
                    center: true,
                    autoplayHoverPause: false,
                    autoWidth: true,
                    dots: false,
                    nav: false,
                    // items: 5,
                    // loop: true, // Loop through slides
                    // margin: 108, // Space between each slide
                    // nav: false, // Show navigation arrows
                    // dots: false, // Show navigation dots
                    // autoWidth: true,
                    // center: true,
                    // autoplay: true, // Autoplay slides
                    // autoplayTimeout: 4000, // Autoplay speed in milliseconds
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
            });
        </script>

        <!--Footer CTA -->
        <div class="site-container mobile:px-0 laptop:px-[0]">
            <div class="flex justify-between items-center bg-[#0059A0] pt-[40px] pb-[37px] px-[43px] 
                    laptop:flex-col laptop:justify-center laptop:items-center laptop:text-center">
                <div class="flex-grow-0 basis-auto flex-shrink-1">
                    <h3 class="text-white text-[34px] font-barlow font-[700] leading-[120%]">
                        <?php echo $cta['heading']; ?></h3>
                    <p class="text-white font-inter text-[18px] font-[400] leading-[150%] mt-[6px]">
                        <?php echo $cta['title']; ?></p>
                </div>
                <div class="basis-[200px] grow-0 shrink-0 text-right laptop:mt-[40px] laptop:flex-1 mobile:mt-[10px]">
                    <a class="btn btn-2" target="<?php echo ($cta['link']['target']) ? '_blank' : '_self'; ?>" href="<?php echo $cta['link']['url']; ?>" class=""><?php echo $cta['link']['title']; ?></a>
                </div>
            </div>
        </div>

        <!--Footer Navigation -->
        <div class="site-container">
            <div class="relative z-[2] py-[31px] flex justify-between laptop:flex-col laptop:gap-[60px]  items-center">
                <?php echo do_shortcode('[company-logo location="footer"]'); ?>
                <?php echo do_shortcode('[child-footer-menu desktop-class="foot-m"  menu="0"]'); ?>
            </div>

            <div class="w-full h-[1px] bg-[#5B6F8C]"></div>

            <div class="grid grid-cols-4 py-[53px] mobile:grid-cols-1 mobile:gap-[30px] mobile:items-center">
                <div class="flex items-center col-span-1">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 0.625C8.17664 0.625 6.42795 1.34933 5.13864 2.63864C3.84933 3.92795 3.125 5.67664 3.125 7.5C3.125 11.1313 9.25 18.8125 9.5125 19.1437C9.57106 19.2167 9.64527 19.2757 9.72965 19.3161C9.81402 19.3566 9.90641 19.3776 10 19.3776C10.0936 19.3776 10.186 19.3566 10.2704 19.3161C10.3547 19.2757 10.4289 19.2167 10.4875 19.1437C10.75 18.8125 16.875 11.1313 16.875 7.5C16.875 5.67664 16.1507 3.92795 14.8614 2.63864C13.572 1.34933 11.8234 0.625 10 0.625ZM10 9.375C9.50555 9.375 9.0222 9.22838 8.61107 8.95367C8.19995 8.67897 7.87952 8.28852 7.6903 7.83171C7.50108 7.37489 7.45157 6.87223 7.54804 6.38727C7.6445 5.90232 7.8826 5.45686 8.23223 5.10723C8.58186 4.7576 9.02732 4.5195 9.51227 4.42304C9.99723 4.32657 10.4999 4.37608 10.9567 4.5653C11.4135 4.75452 11.804 5.07495 12.0787 5.48607C12.3534 5.8972 12.5 6.38055 12.5 6.875C12.5 7.53804 12.2366 8.17393 11.7678 8.64277C11.2989 9.11161 10.663 9.375 10 9.375Z" fill="#0090CC" />
                    </svg>
                    <?php echo do_shortcode('[contact-address]') ?>
                </div>
                <div class="flex items-center col-span-1">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.7766 1.43555C15.0989 1.52344 15.3333 1.78711 15.3333 2.10938C15.3333 9.63867 9.2395 15.7031 1.7395 15.7031C1.38794 15.7031 1.12427 15.498 1.03638 15.1758L0.333252 12.1289C0.274658 11.8066 0.421143 11.4551 0.743408 11.3086L4.02466 9.90234C4.31763 9.78516 4.63989 9.87305 4.84497 10.1074L6.30981 11.8945C8.59497 10.8105 10.4407 8.93555 11.4954 6.70898L9.70825 5.24414C9.47388 5.03906 9.38599 4.7168 9.50317 4.42383L10.9094 1.14258C11.0559 0.820312 11.4075 0.644531 11.7297 0.732422L14.7766 1.43555Z" fill="#0090CC" />
                    </svg>
                    <?php echo do_shortcode("[child-contact-phone]"); ?>
                </div>
                <div class="flex items-center col-span-1">
                    <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.3737 4.29883C15.4908 4.21094 15.6666 4.29883 15.6666 4.44531V10.4219C15.6666 11.2129 15.0221 11.8281 14.2604 11.8281H2.07288C1.28186 11.8281 0.666626 11.2129 0.666626 10.4219V4.44531C0.666626 4.29883 0.81311 4.21094 0.930298 4.29883C1.60413 4.82617 2.45374 5.4707 5.44202 7.63867C6.05725 8.07812 7.11194 9.04492 8.16663 9.04492C9.19202 9.04492 10.276 8.07812 10.8619 7.63867C13.8502 5.4707 14.6998 4.82617 15.3737 4.29883ZM8.16663 8.07812C7.4635 8.10742 6.4967 7.22852 5.99866 6.87695C2.10217 4.06445 1.8092 3.80078 0.930298 3.09766C0.754517 2.98047 0.666626 2.77539 0.666626 2.54102V1.98438C0.666626 1.22266 1.28186 0.578125 2.07288 0.578125H14.2604C15.0221 0.578125 15.6666 1.22266 15.6666 1.98438V2.54102C15.6666 2.77539 15.5494 2.98047 15.3737 3.09766C14.4948 3.80078 14.2018 4.06445 10.3053 6.87695C9.80725 7.22852 8.84045 8.10742 8.16663 8.07812Z" fill="#0090CC" />
                    </svg>
                    <?php echo do_shortcode("[contact-email]"); ?>
                </div>
                <div class="flex items-center justify-end col-span-1 social mobile:justify-center">
                    <?php echo do_shortcode("[social-icons]"); ?>
                </div>
            </div>

            <!--border-->
            <div class="w-full h-[1px] bg-[#5B6F8C]"></div>

        </div>

        <!--Copyright -->
        <div class="site-container flex justify-between pb-[26px] pt-[22px] w-full mobile:gap-[30px] copyright">
            <?php do_shortcode("[copyright echo=1]"); ?>
            <?php do_shortcode("[web-design echo=1]"); ?>
        </div>

    </div>

</footer>

<?php do_shortcode('[scroll-up echo="1"]'); ?>