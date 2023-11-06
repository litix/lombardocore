<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('04_accordion_list');
div_start();
?>
<div class="site-container">
    <!--Accodion List-->
    <div class="grid grid-cols-[500px_auto] tablet:grid-cols-1 gap-[99px]">
        <div class="">
            <?php
            $rp = $e['cfg_content']; //flexible clone
            $div = '';
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
                            el_text($r['text_full'], array('class' => 'tw-descriptin', 'full' => true));
                        else :
                            el_text($r['text'], array('class' => 'dtext '));
                        endif;
                    elseif ($row == 'logo') :
                        el_img($r['logo'], array('div' => ''));
                    elseif ($row == 'button') :
                        el_btnloop($r['button_loop'], array('div' => 'btn-loop'));
                    endif;
                endforeach;
            else :
            ?>
            <h2 class="animate-pulse h-2 tw-heading w-2/5 bg-[#002644] rounded"></h2>
            <?php
            endif;
            ?>
            <div class="tw-border"></div>
            <div class="mt-6">
                <div class="">
                    <?php if ($e['list']) : ?>
                    <?php foreach ($e['list'] as $list) : ?>
                    <!-- Accordion Item 1 -->
                    <div class="flex justify-between items-center cursor-pointer">
                        <h3 class="text-sky-950 text-2xl font-bold font-barlow leading-[120%]">
                            <?php echo $list['title']; ?></h3>
                        <div class="text-gray-600">
                            <svg class="transform transition-transform" xmlns="http://www.w3.org/2000/svg" width="13"
                                height="8" viewBox="0 0 13 8" fill="none">
                                <path
                                    d="M0.737665 0.899877C0.903591 0.715311 1.11772 0.73042 1.38004 0.945203L6.24734 5.07448L11.1341 0.96829C11.3975 0.754751 11.6117 0.740656 11.7767 0.926005L12.4029 1.62838C12.5777 1.83322 12.5382 2.04243 12.2846 2.25599L6.57841 7.09034C6.35408 7.27477 6.13018 7.27424 5.90672 7.08875L0.223453 2.22744C-0.02914 2.01268 -0.0675831 1.80329 0.108124 1.59928L0.737665 0.899877Z"
                                    fill="#ABABAB" />
                            </svg>
                        </div>
                    </div>
                    <!-- Accordion Content 1 -->
                    <div class="tw-description mt-[22px]" style="display: none;">
                        <?php echo $list['description']; ?>
                    </div>

                    <div class="w-full h-[1px] mt-[28px] mb-[22px] last:hidden bg-[#D9D9D9]"></div>
                    <?php endforeach; ?>

                    <?php else : ?>
                    <?php $count = 0;
                        while ($count < 4) :
                        ?>
                    <!-- Accordion Item 1 -->
                    <div class="flex justify-between items-center cursor-pointer animate-pulse">
                        <p class="h-2 w-2/3 bg-[#002644] rounded col-span-2"></p>
                        <div class="text-gray-600">
                            <svg class="transform transition-transform" xmlns="http://www.w3.org/2000/svg" width="13"
                                height="8" viewBox="0 0 13 8" fill="none">
                                <path
                                    d="M0.737665 0.899877C0.903591 0.715311 1.11772 0.73042 1.38004 0.945203L6.24734 5.07448L11.1341 0.96829C11.3975 0.754751 11.6117 0.740656 11.7767 0.926005L12.4029 1.62838C12.5777 1.83322 12.5382 2.04243 12.2846 2.25599L6.57841 7.09034C6.35408 7.27477 6.13018 7.27424 5.90672 7.08875L0.223453 2.22744C-0.02914 2.01268 -0.0675831 1.80329 0.108124 1.59928L0.737665 0.899877Z"
                                    fill="#ABABAB" />
                            </svg>
                        </div>
                    </div>
                    <!-- Accordion Content 1 -->
                    <div class="tw-description mt-[22px]" style="display: none;">
                        <p class="h-2 w-1/3 bg-[#777] rounded col-span-2"></p>
                        <p class="h-2 w-2/3 bg-[#777] rounded col-span-2"></p>
                        <p class="h-2  bg-[#777] rounded col-span-2"></p>
                    </div>

                    <div class="w-full h-[1px] mt-[28px] mb-[22px] last:hidden bg-[#D9D9D9]"></div>
                    <?php $count++;
                        endwhile; ?>
                    <?php endif; ?>
                </div>

            </div>

        </div>
        <div class="">
            <?php if ($e['featured_image']) : ?>
            <img class="w-full h-full" src="<?php echo $e['featured_image']['url']; ?>"
                alt="<?php echo $e['featured_image']['title']; ?>">
            <?php else : ?>
            <img class="animate-pulse w-full h-full" src="https://placehold.co/570x380" alt="image">
            <?php endif; ?>
        </div>
    </div>

    <script>
    const accordionItems = document.querySelectorAll('.cursor-pointer');

    accordionItems.forEach(item => {
        item.addEventListener('click', () => {
            const content = item.nextElementSibling;
            if (content.style.display === 'none') {
                content.style.display = 'block';
                item.querySelector('svg').classList.add('rotate-180');
            } else {
                content.style.display = 'none';
                item.querySelector('svg').classList.remove('rotate-180');
            }
        });
    });
    </script>

    <?php div_end(); ?>