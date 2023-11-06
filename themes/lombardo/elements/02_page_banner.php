<?php
load_assets(array());
$layout = get_row_layout();
$e = get_sub_field($layout);
$is_page = (!is_front_page()) ?: '';

section_class("el-flex banner_layout relative ");

if (!is_front_page()) :
    div_start('flex relative !min-h-[413px] banner-overlay');
else :
    div_start('flex relative min-h-[810px] mini:min-h-[500px] banner-overlay');
endif;
?>
<div class="site-container self-end pb-[86px] relative z-20 w-full">

    <?php

    $rp = $e['cfg_content']; //flexible clone
    $div = '';

    if ($rp) :
        foreach ($rp as $r) :

            $row = $r['acf_fc_layout'];

            if ($row == 'main_title') :
                el_title($r['main_title'], array('class' => 'max-w-[870px] text-white text-[55px] font-bold font-barlow capitalize leading-[110%]', 'div' => $div));

            elseif ($row == 'seo_title') :
                el_title($r['seo_title'], array('tag' => 'h1', 'css' => 'text-white font-barlow text-[20px] uppercase font-bold tracking-[4px]', 'div' => $div));

            elseif ($row == 'alt_title') :
                el_title($r['alt_title'], array('css' => 'atitle', 'div' => $div));

            elseif ($row == 'text') :
                if ($r['full'] == true) :
                    el_text($r['text_full'], array("class" => " {$div}", 'full' => true));
                else :
                    el_text($r['text'], array("class" => "dtext {$div}"));
                endif;

            elseif ($row == 'logo') :
                el_img($r['logo'], array('div' => $div));

            elseif ($row == 'button') :
                el_btnloop($r['button_loop'], array('div' => "btn-loop {$div}"));

            endif;

        endforeach;
    endif;
    ?>
</div>

<?php div_end(); ?>

<?php
## Updated    : Mar 21 2023
## Element    : FF Hero FH01
## Group      : Templates [FFX] [1]
## Version    : 0.1
?>