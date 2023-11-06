<?php 
## https://realfavicongenerator.net/
## just download the package and upload it on 'your-theme/images/favicon' folder

# see [your-theme/images/favicon] folder

function builder_favicon() {
    global $spath;
    $local = $spath . '/images/favicon';
    $color = '#cccccc';
    $bg = '#ffffff';
    echo "\n";
    echo '<link rel="Shortcut Icon" type="image/x-icon" 
    href="' . $local .  '/favicon.ico">' . "\n";    
    echo '<link rel="apple-touch-icon" sizes="180x180" 
    href="' . $local .  '/apple-touch-icon.png">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="32x32" 
    href="' . $local .  '/favicon-32x32.png">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="16x16" 
    href="' . $local .  '/favicon-16x16.png">' . "\n";
    echo '<link rel="manifest" 
    href="' . $local .  '/site.webmanifest">' . "\n";
    echo '<link rel="mask-icon" 
    href="' . $local .  '/safari-pinned-tab.svg" color="' . $color . '">' . "\n";
    echo '<meta name="msapplication-TileColor" content="' . $color . '">' . "\n";
    echo '<meta name="theme-color" content="' . $bg . '">' . "\n";
}

add_action('wp_head', 'builder_favicon');
?>