<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('$1');
div_start('py-[100px]');
?>

<div class="site-container flex flex-col items-center">

    <?php
    $rp = $e['cfg_content']; //flexible clone
    $div = '';
    if ($rp) :
        foreach ($rp as $r) :
            $row = $r['acf_fc_layout'];
            if ($row == 'main_title') :
                el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title text-center', 'div' => $div));
    ?>
    <div class="tw-border"></div>
    <?php elseif ($row == 'seo_title') : el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading', 'div' =>
                $div));
            elseif ($row == 'alt_title') :
                el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title', 'div' => $div));
            elseif ($row == 'text') :
                if ($r['full'] == true) :
                    el_text($r['text_full'], array('class' => 'tw-description', 'full' => true));
                else :
                    el_text($r['text'], array('class' => 'dtext tw-description'));
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

<div class="site-container mt-[30px]">
    <div
        class="contact_form_box grid grid-cols-[370px_auto]  tablet:grid-cols-[270px_auto] mobile:grid-cols-1 shadow gap-[30px] bg-white">
        <div class="col-span-1 bg-[#002644] px-[60px] py-[60px]">

            <?php if ($e['content_fields']) : ?>
            <?php foreach ($e['content_fields'] as $list) :
                    $rp2 = $list['cfg_content'];
                ?>
            <div
                class="item mb-[55px] relative 
            before:absolute before:left-[-11px] before:top-[47px] before:bg-[#0588BF] before:w-[25px] before:h-[2px] before:origin-top before:rotate-90">
                <?php
                        if ($rp2) :
                            foreach ($rp2 as $r) :
                                $row = $r['acf_fc_layout'];
                                if ($row == 'main_title') :
                                    el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'font-inter !text-[16px] font-normal text-white font-[400] leading-[120%] mb-[10px] pl-[15px]', 'div' => $div));
                                elseif ($row == 'seo_title') : el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading', 'div' =>
                                    $div));
                                elseif ($row == 'alt_title') :
                                    el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title pl-[15px]', 'div' => $div));
                                elseif ($row == 'text') :
                                    if ($r['full'] == true) :
                                        el_text($r['text_full'], array('class' => 'font-inter text-[18px] text-white leading-[120%] pl-[15px]
                                        ', 'full' => true));
                                    else :
                                        el_text($r['text'], array('class' => 'font-inter text-[18px] text-white leading-[120%] absolute  pl-[15px]
                                        before:absolute before:w-[25px] before:h-[2px] before:origin-top before:rotate-90'));
                                    endif;
                                elseif ($row == 'logo') :
                                    el_img($r['logo'], array('div' => $div));
                                elseif ($row == 'button') :
                                    el_btnloop($r['button_loop'], array('div' => 'btn-loop flex flex-col items-start gap-[55px] mt-[3px] children:text-white pl-[15px]'));
                                endif;
                            endforeach;
                        endif;
                        ?>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <div class="col-span-1 bg-white py-[45px] pr-[42px] pl-[20px]">

            <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="false"]')
            ?>
        </div>
    </div>
</div>
<?php div_end(); ?>