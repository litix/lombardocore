
<?php 
    global $acf_error, $acfe_error, $np_error, $no_fields, $t_assets; 
    global $js;
    $bs = $js . 'bootstrap/css/bootstrap.min.css';

    get_header();
    wp_enqueue_style( 'mbootstrap', $bs);

    wp_register_style('afont', $t_assets . 'fonts/raleway/font.css','','1.0');  
    wp_enqueue_style('afont');    

    load_assets(array('error-css'));
    
    //echo $acf_error . ' ' . $acfe_error;
?>

<div class="container-sm mt-5 error-plugin">
    <div class="mx-auto">

    <?php 
    if($acfe_error == 1 or $acf_error == 1): 
        echo '<div class="alert alert-danger mb-4" role="alert"><h3>You have a Plugin error!</h3></div>';
    endif;

    if($acfe_error != 1 and $acf_error != 1):    
        if($no_fields == 1): 
           echo '<div class="alert alert-danger mb-4" role="alert"><h3>Configuration Error!</h3></div>';
        endif; 
    endif; 
    ?>
    
    <?php if($acf_error == 1): ?>
    <div class="card mb-4">
        <h5 class="card-header">Advanced Custom Fields</h5>
        <div class="card-body">
            <p class="card-text text-secondary">
                This plugin is neither activated or intalled.<br>
                Version : 6+<br>
                Note : <span class="text-danger">Pro version is required!</span>
            </p>
            <a href="https://www.advancedcustomfields.com/pro/" target="_blank" 
            class="btn btn-info">Download Plugin</a>
        </div>
    </div>   
    <?php else: 
            echo '<div class="alert alert-success mb-4" role="alert"><h3>ACF Installed</h3></div>';
    endif; 
    ?>

    <?php if($acfe_error == 1): ?>
    <div class="card">
        <h5 class="card-header">Advanced Custom Fields : Extended</h5>
        <div class="card-body">
            <p class="card-text text-secondary">
                This plugin is neither activated or intalled.<br>
                Version : 0.8+
            </p>
            <a href="https://wordpress.org/plugins/acf-extended/" target="_blank" 
            class="btn btn-info">Download Plugin</a>
        </div>
    </div>
    <?php else: 
            echo '<div class="alert alert-success mb-4" role="alert"><h3>ACF Extension Installed</h3></div>';
    endif; 
    ?>  

    <?php if($no_fields == 1): ?>
        <div class="card mb-4">
            <h5 class="card-header">Import the Template Fields</h5>
            <div class="card-body">
                <ol>
                    <li>Increase your Wordpress Upload size.<br>
                        <small>on .htaccess file add :</small><br>
                        <code>
                            php_value upload_max_filesize 512M<br>
                            php_value post_max_size 512M<br>
                            php_value max_execution_time 300<br>
                            php_value max_input_time 300
                        </code>
                    </li>
                    <li>Navigate the (parent/child) assets folder  for: <strong>acf-export-20xx-xx-xx.xml</strong></li>
                    <li><strong>Import the xml</strong> on the ACF Dashboard : <strong>ACF > Tools > Import</strong></li>
                </ol>
            </div>
        </div>    
    <?php endif; ?>

    </div>

    <div class="text-center mt-5">
        <a href="<?php echo get_dashboard_url(); ?>" class="link-more btn btn-primary">Return to Dashboad</a>    
    </div>

</div>

<?php 
    get_footer();
    die(); 
?>