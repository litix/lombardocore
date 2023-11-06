<?php 
# WP COMMON PAGES

function get_404_tpl(){
    get_builder_wp('tpl_404', '404');
}

function get_search_tpl(){
    get_builder_wp('tpl_search', 'search');
}

function get_single_tpl(){
    get_builder_wp('tpl_single', 'single');
}

function get_archive_tpl(){
    get_builder_wp('tpl_archive', 'archive');
}

function get_builder_wp($tpl='', $template=''){

    if($tpl):

        $default = true;
        $e = theme_templates();

        $v = tpl_templates($tpl);
        $versions = $v['tpl_array'];

        foreach($versions as $_ver => $_file) 
        {
            if($e[$tpl] == $_ver){
                get_template_part($_file);
                $default = false;
            } 
        }   

        if($default == true) {
            get_template_part("template-parts/{$template}");
        }

    endif;
}
?>