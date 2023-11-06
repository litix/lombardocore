<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head();  ?>
</head>

<body <?php if (!is_front_page()) : ?> <?php body_class('is_page'); ?> <?php else : ?> <?php body_class(); ?> <?php endif; ?>>
    <?php
    after_body_hook();


    ## Header Menus
    ## LINK template-parts/header.php
    ?>