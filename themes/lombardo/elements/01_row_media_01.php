<?php
load_assets(array());
$layout = get_row_layout();
$e = get_sub_field($layout);

$opt = data_fields($e);

$s = check_media($e['media']);
$alignment =  ($opt['center_items']) ? 'true' : 'false';

///
//display_fields // columns
$col = data_colsize($e);

section_class('rowmedia-01');
div_start('flex ', array('data' => data_set($opt)));
?>

<div class="site-container relative z-10 justify-center">
    <div class="grid grid-cols-12 mobile:grid-cols-1 gap-[30px]">
        <div <?= create_data_attributes($e, 'full'); ?> class="flex col-span-<?php echo $col[0]; ?>  data-[rtl=true]:order-last data-[rtl=true]:justify-end">
            <div <?= create_data_attributes($e, 'full'); ?> class="w-full flex flex-col max-w-[100%] data-[hasmedia=true]:!max-w-[500px] data-[alignment=true]:items-center  data-[vertical=true]:justify-center">
                <?php
                el_img($e['icon'], array('div' => 'diconn'));
                el_title($e['before_title'], array('css' => 'btitle', 'class' => 'tw-heading'));
                el_title($e['mtitle'], array('data' => 'data-alignment=' . $alignment, 'class' => 'tw-title data-[alignment=true]:text-center'));
                el_title($e['title'], array('css' => 'dtitle'));
                el_title($e['after_title'], array('css' => 'atitle'));

                if ($e['editor']) :
                ?>
                    <div class="tw-border"></div>
                <?php
                endif;

                el_text($e['editor'], array('data' => 'data-alignment=' . $alignment, 'css' => 'tw-description data-[alignment=true]:text-center'));

                el_text($e['text'], array('css' => 'ptext'));

                el_btnloop($e['button_loop']);

                ?>
            </div>
        </div>
        <?php if ($s) : ?>
            <div class="col-span-<?php echo $col[1]; ?>">
                <?php el_media($e['media'], array('class' => 'aspect-auto !max-w-[570px]')); ?>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php div_end(); ?>