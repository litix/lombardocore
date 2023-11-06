<?php 
# FOOTER INSTALL

// see template-parts/footer.php

// see theme-options > Templates > Theme Footer
## LINK template-parts/_template/.template.php

function get_builder_end(){

    $default = true;
    $e = theme_templates();

    $v = tpl_templates('tpl_footer');

    $versions = $v['tpl_array'];

        foreach($versions as $_ver => $_file) 
        {
            if(isset($e['tpl_footer'])) {
                if($e['tpl_footer'] == $_ver){
                    get_template_part($_file);
                    $default = false;
                } 
            }
        }   


    if($default == true)
        get_template_part('template-parts/footer');

}
?>