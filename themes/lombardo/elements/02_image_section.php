<?php
load_assets(array('owl'));
$layout = get_row_layout();
$e = get_sub_field($layout);

section_class('image_section_layout');
div_start();
?>

<div class="container-xl">
    <?php if ($e['is_gallery'] === false) : ?>
        <img class="single_image" src="<?php echo $e['image']['url']; ?>" alt="<?php echo $e['image']['title']; ?>">
    <?php elseif ($e['gallery'] && $e['is_gallery']) : ?>
        <div class="images">
            <?php foreach ($e['gallery'] as $image) : ?>
                <div class="item">
                    <img src="<?php echo $image['url'];  ?>" alt="<?php echo $image['title']; ?>">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php div_end(); ?>