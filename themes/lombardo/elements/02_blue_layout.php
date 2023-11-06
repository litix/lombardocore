<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);

if (is_admin()) :
    section_class('blue_container_layout relative');
else :
    section_class('blue_container_layout relative mt-[-120px] translate-y-[120px] laptop:mt-0 laptop:translate-y-[0] z-10');
endif;

div_start();
?>

<div class="site-container laptop:px-0">
    <div class="bg-primary relative z-10 pb-[46px] pt-[45px] my-0 mx-auto max-w-[1164px] laptop:px-[15px]">
        <?php
        $rp = $e['cfg_content']; //flexible clone
        $div = '';
        if ($rp) :
            foreach ($rp as $r) :
                $row = $r['acf_fc_layout'];
                if ($row == 'main_title') :
                    el_title($r['main_title'], array('css' => 'mtitle', 'class' => '!tw-title !text-white w-full text-center', 'div' => $div));
        ?>
        <div class="flex flex-col w-full justify-center items-center">
            <div class="tw-border"></div>
        </div>
        <?php

                elseif ($row == 'seo_title') :
                    el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading', 'div' => $div));
                elseif ($row == 'alt_title') :
                    el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title', 'div' => $div));
                elseif ($row == 'text') :
                    if ($r['full'] == true) :
                        el_text($r['text_full'], array('class' => 'tw-description !text-white max-w-[870px] mx-auto text-center', 'full' => true));
                    else :
                        el_text($r['text'], array('class' => 'tw-description !text-white max-w-[870px] mx-auto text-center'));
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