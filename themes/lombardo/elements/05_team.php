<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('team_layout');
div_start('relative py-[100px]');
?>

<div class="site-container relative z-10 flex flex-col items-center">
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
                    el_text($r['text_full'], array('class' => 'tw-description text-center max-w-[970px]', 'full' => true));
                else :
                    el_text($r['text'], array('class' => 'tw-description text-center max-w-[970px]'));
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
<div class="tw-"></div>
<div class="site-container !mt-[47px]">
    <div class="team_list flex gap-x-[30px] gap-y-[60px]  flex-wrap laptop:justify-center">
        <?php if ($e['team_list']) : ?>
        <?php foreach ($e['team_list'] as $list) :
                $position = get_field('position', $list->ID);
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($list->ID), 'full');

            ?>
        <a href="<?php echo $list->guid; ?>" class="item group cursor-pointer w-[370px] h-[506px] relative">
            <img class="!w-[370px] !h-[370px] object-cover object-top grayscale group-hover:grayscale-0 "
                src="<?php echo $image[0]; ?>" alt="<?php echo $list->post_title; ?>" />
            <h3 class="text-center text-sky-950 text-2xl mt-[30px] font-bold font-barlow leading-[28.80px]">
                <?php echo $list->post_title; ?></h3>
            <h4 class="text-center text-neutral-500 mt-[10px]  text-base font-normal font-inter leading-tight">
                <?php echo $position; ?></h4>

            <div
                class="relative w-7 h-7 mx-auto mt-[20px] mb-[0] bg-neutral-200 group-hover:bg-sky-600 transition-all ease-in rounded-full">
                <div
                    class="left-[9px] top-[-2px] absolute text-white text-xl font-normal font-barlow leading-normal tracking-[4px]">
                    +</div>
            </div>

        </a>
        <?php endforeach; ?>
        <?php endif; ?>

    </div>



    <?php div_end(); ?>