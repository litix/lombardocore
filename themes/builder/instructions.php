<?php 

load_assets(array('error-css')); 

$admin_url = get_dashboard_url();
$admin_opt = $admin_url . 'options-reading.php';
$admin_theme = $admin_url . 'themes.php';
?>
<section class="element noob">
<div class="container-xl">
    <div class="dtop">
        <h2 class="title">Before you start!</h2>
        <small>Read The last setup to hide this page.</small>
        <!-- <small><?php echo get_template_directory(); ?>/instructions.php</small> -->
    </div>    

    <div class="deck">

    <!-- card -->
    <div class="card">
        <div class="card-header">
            <h5>Use a Child Theme</h5>
        </div>
        <div class="card-body">
            <div class="card-text text-secondary">
            <ol>
                <li><a href="<?php _e($admin_theme); ?>" target="_blank">Change Theme to <strong>The Dev Team</strong></a></li>
                <li>Edit the <small>styles.css</small> and change the <u>Theme Name</u> to the Proper Company Name. <br><em>ie. Catalyst Investors</em></li>
            </ol>
            </div>
        </div>
        <div class="card-footer">
        <div class="btn btn-gg">Done</div>
        </div>
    </div> 

    <!-- card -->
    <div class="card">
        <div class="card-header">
            <h5>Add Local Fonts</h5>
        </div>
        <div class="card-body">
            <div class="card-text text-secondary">
            <ol>
                <li><a href="https://gwfh.mranftl.com/fonts" target="_blank">https://gwfh.mranftl.com/fonts</a></li>
                <li>Enter your font <small>ie: Poppins</small></li>
                <li>Select the font-weight</li>
                <li>Select <u>Modern Browser</u></li>
                <li>Copy the Generated CSS</li>
                <li>Add the CSS <small>in /assets/css/font.css</small></li>
                <li><u>Download zip file</u></li>
                <li>Unzip Fonts <small>in /assets/fonts/</small></li>
            </ol>
            </div>
        </div>
        <div class="card-footer">
        <div class="btn btn-gg">Done</div>
        </div>
    </div> 

    <!-- card -->
    <div class="card">
        <div class="card-header">
            <h5>Add Favicon</h5>
        </div>
        <div class="card-body">
            <div class="card-text text-secondary">
            <ol>
                <li><a href="https://realfavicongenerator.net/" target="_blank">https://realfavicongenerator.net/</a></li>
                <li>Upload your image</li>
                <li>Scroll at the bottom</li>
                <li>Click <u>Generate your Favicon and HTML code</u></li>
                <li>Download the <u>Favicon package</u></li>
                <li>Code is not required!</li>
                <li>Unzip Files <small>in /images/favicon/</small></li>
            </ol>
            </div>
        </div>
        <div class="card-footer">
        <div class="btn btn-gg">Done</div>
        </div>
    </div> 

    <!-- card -->
    <div class="card">
        <div class="card-header">
            <h5>Add Logo</h5>
        </div>
        <div class="card-body">
            <div class="card-text text-secondary">
            <p><small>The logo added acts as a placeholder</small></p>
            <ol>
                <li>In Figma, save the Logo in SVG format </li>
                <li>Save as <small>logo.svg</small></li>
                <li>Save to <small>/images/placeholder/</small></li>
            </ol>
            </div>
        </div>
        <div class="card-footer">
        <div class="btn btn-gg">Done</div>
        </div>
    </div> 

    <!-- card -->
    <div class="card">
        <div class="card-header">
            <h5>Add Plugins</h5>
        </div>
        <div class="card-body">
            <div class="card-text text-secondary">
            <p><small>Essential plugins:</small></p>
            <p class="ctext">Classic Editor, SVG Support, Autoptimize, Gravity Forms, All-in-One WP Migration, iThemes Security Pro</p>
            </div>
        </div>
        <div class="card-footer">
        <div class="btn btn-gg">Done</div>
        </div>
    </div>     
    
    <!-- card -->
    <div class="card">
        <div class="card-header">
            <h5>Last Step</h5>
        </div>
        <div class="card-body">
            <div class="card-text text-secondary">
            <ol>
                <li>Create a new page <small>ie. Home</small></li>
                <li>Open Dashboard</li>
                <li>Go to Settings > Reading Settings</li>
                <li>Set the Static Page</li>
                <li>Homepage > the new page you created</li>
            </ol>
            </div>
        </div>
        <div class="card-footer">           
            <a class="btn btn-bb" href="<?php _e($admin_opt); ?>">Lets Go</a>
        </div>
    </div>      

    </div>

</div>
</section>

<script>
var $ = jQuery.noConflict();
$(function() {
    $(".btn-gg").click(function() {
        $(this).closest('.card').fadeOut("slow");
    });
});    
</script> 