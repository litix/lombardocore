<?php 
# ELEMENT | LAYOUT
# Settings 3.0  | B2 Element Settings [element_settings] | Layout [b2_layout] 

## see /wp-admin/post.php?post=17&action=edit

## Settings 3.0 > Layout

## Settings ~ Volume
function el_settings_volume($field=''){
    $acf = get_sub_field('element_settings');
    $s = $acf['b2_volume'];

    if($field) {
        return $s[$field];
    } else {
        return $s;
    }
}

## Settings ~ Theme
function el_settings_theme($field=''){
    $acf = get_sub_field('element_settings');
    $s = $acf['b2_theme'];

    if($field) {
        return $s[$field];
    } else {
        return $s;
    }
}

## Settings ~ Background Color
function el_settings_background($field=''){
    $acf = get_sub_field('element_settings');
    $s = $acf['b2_background'];

    if($field) {
        return $s[$field];
    } else {
        return $s;
    }
}

## Settings ~ Advanced
function el_settings_advanced($field=''){
    $acf = get_sub_field('element_settings');
    $s = $acf['b2_advanced'];

    if($field) {
        return $s[$field];
    } else {
        return $s;
    }
}

## Settings ~ Mobile
function el_settings_mobile($field=''){
    $acf = get_sub_field('element_settings');
    $s = $acf['b2_mobile'];

    if($field) {
        return $s[$field];
    } else {
        return $s;
    }
}

## Settings ~ Content
function el_settings_content($field=''){
    $acf = get_sub_field('element_settings');
    $s = $acf['b2_content'];

    if($field) {
        return $s[$field];
    } else {
        return $s;
    }
}

## Settings ~ Hidden
function el_settings_hidden($field=''){
    $acf = get_sub_field('element_settings');
    $s = $acf['b2_hidden'];

    if($field) {
        return $s[$field];
    } else {
        return $s;
    }
}
