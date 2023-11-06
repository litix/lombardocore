<?php 
#SHORTCODES

/* #region - FOOTER CNA  */
function fn_cta($attr) {
    $args = shortcode_atts( array(
        'echo'  => 0,
        'n'     => 0, /* 1 2 3 4 */
    ), $attr );

    $e  = theme_cta();
    $rp = $e['custom_ctas'];
    $s  = $args['n'];

    if($rp){
        $r = $rp[$s];
        $r = $r['cta'];
        
        $title = el_title($r['title'], array('class'=>'f36', 'echo'=>false));
        $btns = el_btnloop($r['buttons'], array('echo'=>false));
    }

    $output = "
        <section class=\"element ff-cta cta-{$s}\">
        <div class=\"wrap\">
            <div class=\"container-xl\">
                <div class=\"flexic\">
                    {$title}
                    {$btns}
                </div>
            </div>
        </div>
        </section>
    ";

    if($args['echo'] == 1)
        echo $output;

    return $output;
}

add_shortcode('cta-banner', 'fn_cta');
/* #endregion */
