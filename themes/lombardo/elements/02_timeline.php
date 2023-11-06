<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('timeline_layout');
div_start('pb-[107px] pt-[100px]');
?>
<div class="site-container">
    <!--heading-box-->
    <div class="heading_box flex flex-col justify-center text-center">
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
    <!--timeline-box-->
    <?php if ($e['list']) : ?>
    <div
        class="timeline_list grid grid-cols-[270px_270px_270px_270px] laptop:grid-cols-3 mobile:grid-cols-1 desktop:justify-start gap-[30px] mt-[47px]">
        <?php foreach ($e['list'] as $list) : ?>
        <a href="<?php echo $list['featured_image']['url']; ?>"
            class="h-[270px] mobile:h-[270px] col-span-1 relative !bg-cover group cursor-pointer" data-fancybox
            data-caption="<?php echo $list['description'] ?>"
            style="background:url('<?php echo $list['featured_image']['url']; ?>')">
            <div
                class="absolute w-full h-full tablet:bg-black tablet:bg-opacity-75 group-hover:bg-black group-hover:bg-opacity-75 z-[2] top-0 left-0 transition-all duration-300 ease">
            </div>
            <div class="w-[251px] h-[30px] justify-start items-center inline-flex mt-[18px]">
                <div
                    class="hidden tablet:inline-block group-hover:inline-block w-[30px] h-[3px] relative z-10 -rotate-90 bg-sky-600">
                </div>
                <div
                    class="hidden tablet:inline-block group-hover:inline-block w-[233px] text-white text-[24px] font-bold font-['Barlow'] leading-9  z-10 relative ">
                    <?php echo $list['year']; ?></div>
            </div>
            <div
                class="hidden z-10 relative tablet:flex group-hover:flex justify-center mt-[18px] transition-all duration-300 ease">
                <div class="cursor-pointer w-[223px] text-white text-[18px] font-normal font-['Inter'] leading-[150%]">
                    <?php echo $list['description']; ?>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
<?php div_end(); ?>