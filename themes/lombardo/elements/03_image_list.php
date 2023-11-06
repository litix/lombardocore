<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('image_list_layout relative');
div_start('pt-[79px] pb-[100px]');
?>

<div class="site-container relative z-10">
    <?php
    $rp = $e['cfg_content']; //flexible clone
    $div = '';
    if ($rp) :
    ?>
    <div class="heading-box w-full text-center mb-[80px]">
        <?php
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
            ?>
    </div>
    <?php endif; ?>
    <!-- <div class="image_list grid grid-cols-3 gap-[30px]"> -->
    <div class="grid grid-cols-3 gap-[30px] mobile:grid-cols-1 tablet:grid-cols-2 image_list">
        <?php if ($e['list']) : ?>
        <?php foreach ($e['list'] as $list) : ?>
        <a href="<?php echo ($list['link']) ? $list['link']['url'] : '#'; ?>"
            class='group animate-fadein  item cursor-pointer grow-0 shrink-1 basis-[370px]'>
            <img class="w-full !h-[277px] object-cover" src="<?php echo $list['image']['url']; ?>"
                alt="<?php echo $list['image']['title']; ?>">
            <h3
                class="mt-[20px] text-sky-950 text-left text-2xl font-bold !font-barlow !leading-[120%] group-hover:text-[#0090CC]">
                <?php echo $list['title'] ?></h3>
        </a>
        <?php endforeach; ?>
        <?php else : ?>
        <?php $count = 0;
            while ($count < 6) :
            ?>
        <a href="#" class='group animate-pulse  item cursor-pointer grow-0 shrink-1 basis-[370px]'>
            <img class="w-full !h-[277px] object-cover" src="https://placehold.co/370x277" alt="image">
            <h3
                class="animate-pulse h-[15px] bg-slate-600  mt-[20px] text-sky-950 text-center text-2xl font-bold !font-barlow !leading-[120%] ">
            </h3>
        </a>
        <?php $count++;
            endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php div_end(); ?>