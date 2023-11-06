<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('qoute_form_layout');
div_start('pt-[99px] pb-[99px]');
?>

<div class="site_container relative z-10  ">
    <div class="flex flex-col justify-center content-center">
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
    <div class="site-container">
        <div class="form_container shadow-custom bg-white mt-[30px] px-[70px] py-[44px] mobile:px-[15px]">
            <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="false"]') ?>
        </div>
    </div>
</div>
<?php div_end(); ?>