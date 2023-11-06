<?php 
# THEME OPTIONS > HELPER

/* ----------------------------------------- */

function dev_notes(){  

    global $tpath;
    $file = $tpath . "/helper.html";

    if(file_get_contents($file)) {
      $msg = file_get_contents($file);
    } else {
      $msg = 'Help FIle not found';
    }  

    echo '<div class="p-3 help-box">' . $msg . '</div>';
    
}
  
add_action('acf/render_field/key=field_629540f58021a', 'dev_notes');

/* ----------------------------------------- */

## SITE INFORMATION
function display_site_info() {

    $site_previewer = get_template_directory() . '/functions/builder/site-information.php';
    if (file_exists($site_previewer)) { 
      include $site_previewer;
    } 
}

add_action('acf/render_field/key=field_63ea82b670a49', 'display_site_info');

## SITE CONFIGURATION
function display_site_conf() {

  $site_previewer = get_template_directory() . '/functions/builder/site-configuration.php';
  if (file_exists($site_previewer)) { 
    include $site_previewer;
  } 
}

add_action('acf/render_field/key=field_641e937e961ae', 'display_site_conf');


/* ----------------------------------------- */




function dev_qa_list( $field ) {
  
  $name = $field['name'];
  // reset choices
  $field['choices'] = array();

  $link1 = 'https://sites.google.com/thomasdigital.com/helpcenter/articles/gravityforms-notification-configuration';
  $link2 = 'https://sites.google.com/thomasdigital.com/helpcenter/articles/recommended-discussion-settings';
  $link3 = 'https://sites.google.com/thomasdigital.com/helpcenter/articles/ithemes-security-configuration';
  $link4 = 'https://pagespeed.web.dev/';
  $link5 = 'https://validator.w3.org/';
  $link6 = 'https://jigsaw.w3.org/css-validator/';

  switch ($name):

    case "dev_qa1":
      $choices = "
      Developed site must follow the right - fonts / spacings / colors / etc on the design,
      Upload favicon based on the logo via the Customizer,
      Update the GravityForms error styles,
      The 404 page must be updated to match the design,
      Project Notes must be updated,
      Single custom post type pages should have a Back button (onclick=\"history.back()\"),
      Submitted site must have most of the content from the Website Contents folder and/or the live site content if an old site exists
      ";
    break;
    
    case "dev_qa2":
      $choices = "
      All GravityForm notifications must be <a class=\"nu\" href=\"{$link1}\" target=\"_blank\">configured</a> properly,
      Back-end should be <a class=\"nu\" href=\"{$link2}\" target=\"_blank\">configured</a> properly (e.g. no Just another wordpress site),
      Remove the default WordPress themes,
      iThemes Security plugin must be installed and <a class=\"nu\" href=\"{$link3}\" target=\"_blank\">configured</a>
      ";
    break;    

    case "dev_qa3":
      $choices = "
      Every page should have one &lt;h1> tag (visible or hidden),
      <a class=\"nu\" href=\"{$link4}\" target=\"_blank\">PageSpeed score</a> should be 60 or higher on mobile and 80 or higher on desktop,
      Link should be on San Francisco Web Design
      ";
    break;   

    case "dev_qa4":
      $choices = "
      There should be no browser console errors (non-plugin related),
      There should be no <a class=\"nu\" href=\"{$link5}\" target=\"_blank\">HTML Validator errors</a> (non-plugin related),
      There should be no <a class=\"nu\" href=\"{$link6}\" target=\"_blank\">CSS Validator errors</a> (non-plugin related),
      If we are hosting the current live site / tracking and SEO-related scripts from the header and footer should be transferred to the new site. This includes Google Analytics/Tag Manager scripts
      ";
    break;     

  endswitch;
  
  $choices = explode(",", $choices); 
  $choices = array_map('trim', $choices);

  if( is_array($choices) ) {     
      foreach( $choices as $choice ) {
          $field['choices'][ $choice ] = $choice;         
      }
  }
  
  return $field;
}

add_filter('acf/load_field/name=dev_qa1', 'dev_qa_list');
add_filter('acf/load_field/name=dev_qa2', 'dev_qa_list');
add_filter('acf/load_field/name=dev_qa3', 'dev_qa_list');
add_filter('acf/load_field/name=dev_qa4', 'dev_qa_list');

function count_check_list($field = ''){
    $i = 0;
    
    if($field):
    foreach($field as $f) {
      $i++;    
    }
    endif;

    return $i;
}