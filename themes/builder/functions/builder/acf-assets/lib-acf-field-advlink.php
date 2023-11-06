<?php 
## ACF - Element
## ACF Extended Advanced Link
## Adds extra options for Advanced Link element
## Custom 'cfg_link' button on Staging Elements

## see shortcode/code-button.php

add_filter('acfe/fields/advanced_link/sub_fields/name=cfg_link', 'bd_acf_advanced_link_sub_fields', 10, 3);
function bd_acf_advanced_link_sub_fields($sub_fields, $field, $value){
    
    $sub_fields[] = array(
        'name'      => 'popup',
        'label'     => 'Popup',
        'type'      => 'true_false',
        'message'   => 'Open in popup (recommended for media)',
        'ui'        => false,
        'value' => isset($value['popup']) ?  $value['popup'] : "",
        'conditional_logic' => array(
            array(
                array(
                    'field'    => 'modal', 
                    'operator' => '!=', 
                    'value'    => 1
                ),
                array(
                    'field'    => 'type', 
                    'operator' => '==', 
                    'value'    => 'url'
                ),                  
            )
        )         
    );

    $sub_fields[] = array(
        'name'      => '',
        'label'     => 'Design Options',
        'type'      => 'accordion',
    );       

    $sub_fields[] = array (
        'name' => 'design',        
        'label' => 'Button Design',
        'type' => 'select',
        'choices' => array(
            'more' => 'Text',
            'btn-d' => 'Button 1',
            'btn-s' => 'Button 2',
            'btn-a' => 'Button 3',
            'btn-icon-text' => 'Button Icon',
            'b-icon' => 'Plain Icon',
            'pre-icon' => '[Pre] Text Icon',
            'post-icon' => '[Post] Text Icon',
        ),
        'value' => isset($value['design']) ?  $value['design'] : "",
    );  


    $sub_fields[] = array (
        'label' => 'Icon',
        'name' => 'icon',
        'library' => 'all',
        'type' => 'image',
        'required' => 0,
        'acfe_thumbnail' => 0,
        'return_format' => 'url',	
        'preview_size' => 'medium',	
        'value' => isset($value['icon']) ?  $value['icon'] : "",
        'conditional_logic' => array(
            array(
                array('field' => 'design', 'operator' => '!=', 'value' => 'more'),
                array('field' => 'design', 'operator' => '!=', 'value' => 'btn-d'),
                array('field' => 'design', 'operator' => '!=', 'value' => 'btn-s'),
                array('field' => 'design', 'operator' => '!=', 'value' => 'btn-a')
            )
        ) 
    );

    $sub_fields[] = array(
        'name'      => 'modal',
        'label'     => 'Modal',
        'type'      => 'true_false',
        'message'   => 'Iframe Modal (iFrame Popup)',
        'ui'        => false,
        'value' => isset($value['modal']) ?  $value['modal'] : "",
        'conditional_logic' => array(
            array(
                array(
                    'field'    => 'popup', 
                    'operator' => '!=', 
                    'value'    => 1
                ),
                array(
                    'field'    => 'type', 
                    'operator' => '==', 
                    'value'    => 'url'
                ),
            )
        )         
    );

    return $sub_fields;
    
}

?>