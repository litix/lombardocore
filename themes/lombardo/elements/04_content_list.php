<?php
//load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);
section_class('04_content_list');
div_start('pb-[100px]');
?>
<div class="site-container relative z-10">
    <div class="flex gap-[30px]">
        <?php if ($e['list']) : ?>
        <?php foreach ($e['list'] as $list) : ?>
        <div class='item basis-[570px]'>
            <h3 class="tw-title"><?php echo $list['title']; ?></h3>
            <div class="tw-border"></div>
            <div class="tw-description">
                <?php echo $list['description']; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else : ?>

        <?php $count = 0;
            while ($count < 2) :
            ?>
        <div class='animate-pulse item basis-[570px]'>
            <h3 class="tw-title w-2/3 h-2 bg-[#002644] rounded"></h3>
            <div class="tw-border"></div>
            <div class="tw-description">
                <p class="h-2 bg-[#777] rounded"></p>
                <p class="h-2 bg-[#777] rounded"></p>
                <p class="h-2 bg-[#777] rounded"></p>
            </div>
        </div>
        <?php $count++;
            endwhile; ?>

        <?php endif; ?>
    </div>
</div>
<?php div_end(); ?>