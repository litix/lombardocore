<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('icon_list_layout');
div_start('relative pt-[96px] pb-[100px]');
?>

<div class="tw-overlay bg-servicesoverlay2 z-0"></div>

<div class="site-container">

    <div class="flex flex-col justify-center content-center relative z-10">
        <?php
        $rp = $e['cfg_content']; //flexible clone
        $div = '';
        if ($rp) :
            foreach ($rp as $r) :
                $row = $r['acf_fc_layout'];
                if ($row == 'main_title') :
                    el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title text-center', 'div' => $div));
        ?>
        <div class="flex justify-center">
            <div class="tw-border"></div>
        </div>
        <?php
                elseif ($row == 'seo_title') :
                    el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading', 'div' => $div));
                elseif ($row == 'alt_title') :
                    el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title', 'div' => $div));
                elseif ($row == 'text') :
                    if ($r['full'] == true) :
                        el_text($r['text_full'], array('class' => 'tw-description text-center', 'full' => true));
                    else :
                        el_text($r['text'], array('class' => 'tw-description text-center'));
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

    <div class="list !flex  justify-center flex-wrap !gap-[30px] mt-[80px] relative z-10 ">
        <?php if ($e['list']) : ?>
        <?php foreach ($e['list'] as $list) : ?>
        <div
            class="!bg-[#fff] basis-[369px] pt-[37px] pb-[92.88px] min-h-[450px] !flex flex-col items-center shrink-0 grow-0 tw-shadow shadow-xl">
            <img class="!w-[30px] !h-[39px]" src="<?php echo $list['image']['url']; ?>"
                alt="<?php echo $list['image']['title']; ?>">
            <h3 class="text-center text-sky-950 text-2xl font-bold font-['Barlow'] !leading-[120%] mt-[20px] px-[15px]">
                <?php echo $list['title']; ?></h3>
            <div class="tw-description max-w-300px w-[300px] text-center mt-[20px]">
                <?php echo $list['description']; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="tw-description text-center pt-[70px]">
        <?php
        $rp = $e['bottom_cfg_content']; //flexible clone
        $div = '';
        if ($rp) :
            foreach ($rp as $r) :
                $row = $r['acf_fc_layout'];
                if ($row == 'main_title') :
                    el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title !text-center', 'div' => $div));
        ?>
        <div class="flex justify-center">
            <div class="tw-border"></div>
        </div>
        <?php
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

<?php div_end(); ?>