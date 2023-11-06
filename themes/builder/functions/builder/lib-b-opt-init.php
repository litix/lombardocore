<?php 
# THEME OPTIONS
# inittialize our options 
# hierarchy : Theme Options > Templates > Controls > Elements

## see Dashboard > Theme Options (company name)



# CREATE THE OPTIONS PAGE
# wp-admin/admin.php?page=options-framework

## LINK functions/wp/wp_features.php#theme_options

function theme_options_menu(){

    $icon = 'dashicons-businessman';

    if( function_exists('acf_add_options_page') ) {
        
        $company_name = apply_filters( 'company_name_fltr', 'Theme Options');

        $option_page = acf_add_options_page(array(
            'page_title'  => $company_name,
            'menu_title'  => $company_name,
            'menu_slug'   => 'options-framework',
            'capability'  => 'edit_posts',
            'icon_url'    => $icon,
            'position'    => '2',
            'redirect'    => false
        ));

    }
}

# CHANGE/EDIT
function company_name() {
    $e = get_field('settings', 'options');

    $company_name = '';
    if(isset($e['site']['company_name']))
        $company_name = $e['site']['company_name'];
    
    if(!$company_name)
        $company_name = get_bloginfo();

    return $company_name;
}

/* ----------------------------------------- */

function catsandbox() {

  global $tpath;
  $protofile = get_template_directory() . '/functions/builder/.prototype/init.php';
  
  if (file_exists($protofile)) { 
      include $protofile;
  }     

}


?>