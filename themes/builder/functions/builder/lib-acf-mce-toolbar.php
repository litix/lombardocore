<?php 
## ACF : WYSIWYG Content
## This the custom Toolbar for WYSIWYG in ACF
## Set as option as : ('Simple Title' | 'Simple Text')

# see WYSIWYG at ACF | see shortcode/code-text.php

function custom_toolbars( $toolbars )
{
    $title = array(
        'forecolor',                
        'bold',
        'italic',
        'underline',
        'strikethrough',
        'customFont',
        'removeformat',
    );

    $text = array(
        'forecolor',                
        'bold',
        'italic',
        'bullist',
        'numlist',
        'link',       
        'alignleft',
        'aligncenter',
        'alignright',
        'customFont',
        'removeformat',
    );

    $toolbars['Simple Text'] = array();
    $toolbars['Simple Text'][1] = $text;

    $toolbars['Simple Title'] = array();
    $toolbars['Simple Title'][1] = $title;


    if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
    {
        unset( $toolbars['Full' ][2][$key] );
    }
    // remove the 'Basic' toolbar completely
    //unset( $toolbars['Basic' ] );

    // return $toolbars - IMPORTANT!
    return $toolbars;
}

add_filter( 'acf/fields/wysiwyg/toolbars' , 'custom_toolbars'  );
?>