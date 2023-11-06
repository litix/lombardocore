<?php
load_assets(array());
$layout = get_row_layout();
$e = get_sub_field($layout);

$opt = data_fields($e);

section_class('heroopt-01');
div_start('flex mobile:!min-h-[500px]', array('data' => data_set($opt), 'style' => data_height($opt, 0)));
?>
<div class="mobile:!min-h-auto"></div>
<?php el_media($e['media'], array('as' => 'overlay')); ?>
<div class="overlay color banner-overlay"></div>

<div class="site-container">
    <div class="relative px-[15px]">
        <?php
        el_img($e['icon'], array('div' => 'diconn'));
        el_title($e['before_title'], array('css' => 'btitle', 'class' => 'text-white font-barlow text-[20px] uppercase font-bold tracking-[4px] pb-[10px]'));
        el_title($e['mtitle'], array('class' => 'text-white !text-banner font-bold font-barlow capitalize leading-[110%] pb-[90px]'));
        el_title($e['title'], array('css' => 'dtitle', 'class' => ''));
        el_title($e['after_title'], array('css' => 'atitle'));
        el_text($e['editor']);
        el_text($e['text'], array('css' => 'ptext'));
        el_btnloop($e['button_loop']);
        ?>
    </div>
</div>

<?php div_end(); ?>