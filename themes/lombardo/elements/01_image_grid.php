<?php
load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('image_grid_layout');
div_start('py-[100px]');
?>

<div class="site-container relative z-10">
    <div class="flex gap-[100px]">
        <!-- <div class="flex-shrink-1 flex-grow-0 basis-[570px] grid grid-rows-2 grid-flow-col gap-[8.57px]"> -->
        <div class="flex-shrink-1 flex-grow-0 basis-[570px] grid grid-rows-2 grid-flow-col gap-[8.57px]">
            <?php $count = 1;
            if ($e['gallery']) : ?>
            <?php foreach ($e['gallery'] as $list) : ?>
            <a class="<?php echo ($count == 1) ? 'row-span-2' : 'col-span-1' ?>" href="<?php echo $list['url']; ?>"
                data-fancybox>
                <img src="<?php echo $list['url']; ?>" alt="<?php echo $list['url']; ?>" class="zoom-element">
            </a>
            <?php $count++;
                endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="basis-[500px] flex-grow-0 flex-shrink-0 laptop:!flex-1">
            <?php
            $rp = $e['cfg_content']; //flexible clone
            $div = '';
            if ($rp) :
                foreach ($rp as $r) :
                    $row = $r['acf_fc_layout'];
                    if ($row == 'main_title') :
                        el_title($r['main_title'], array('css' => 'mtitle', 'class' => 'tw-title text-white mt-[10px]', 'div' => $div));
            ?>
            <div class="tw-border"></div>
            <?php
                    elseif ($row == 'seo_title') :
                        el_title($r['seo_title'], array('css' => 'btitle', 'class' => 'tw-heading', 'div' => $div));
                    elseif ($row == 'alt_title') :
                        el_title($r['alt_title'], array('css' => 'atitle', 'class' => 'tw-title', 'div' => $div));
                    elseif ($row == 'text') :
                        if ($r['full'] == true) :
                            el_text($r['text_full'], array('class' => 'tw-description text-white', 'full' => true));
                        else :
                            el_text($r['text'], array('class' => 'tw-description text-white'));
                        endif;
                    elseif ($row == 'logo') :
                        el_img($r['logo'], array('div' => $div));
                    elseif ($row == 'button') :
                        el_btnloop($r['button_loop'], array('class' => ' flex gap-[19px] mt-[30px]', 'div' => 'btn-loop'));
                    ?>
            <?php
                    endif;
                endforeach;
            endif;
            ?>

        </div>
    </div>
</div>

<?php div_end(); ?>