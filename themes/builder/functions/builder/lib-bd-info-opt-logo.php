<?php 
## LOGO - Heade | Sticky | Footer
## ACF = Theme Options > Company Logo

## usage : builder_logo('main');
## see templates : menu-home-X | footer-X

function builder_logo($menu='')
{
    #FE
    $condition = false;
    $class = '';
    
    $info = get_bloginfo();     
    $src = build_acf_logo($menu);
    $home = home_url();
    $company = company_name();

    $linked_logo = "<a data-location=\"{$menu}\" class=\"navbar-brand {$menu}-logo\" href=\"{$home}\">";
    $linked_logo .= el_img($src, array('echo'=>false,'lazy'=>true,'alt'=>$info, 'll'=>2));

        if($menu == 'main')   
            $linked_logo .= "<span class=\"dnone\">{$company}</span>";
    
    $linked_logo .= "</a>";        
    
    echo $linked_logo;
}

function build_acf_logo($menu='') 
{   
    #NF
    global $spath;         
    $logo = '';
    $placeholder = $spath . '/images/placeholder/logo.svg';

    $e = theme_logos();

    if(!$menu)
        $menu = 'main';
        
    switch($menu) {  

        case 'main':    
            if(isset($e['main_logo']))
                $logo = $e['main_logo'];
        break;            

        case 'float':        
            if(isset($e['sticky_logo']))
                $logo = $e['sticky_logo'];
        break;

        case 'sticky':        
            if(isset($e['sticky_logo']))
                $logo = $e['sticky_logo'];
        break;       

        case 'footer':    
            if(isset($e['footer_logo']))
                $logo = $e['footer_logo'];
        break;   

        case 'mobile':    
            if(isset($e['mobile_logo']))
                $logo = $e['mobile_logo'];
        break;   

        default:
            $logo = $placeholder;    
    }

    if(!$logo)
        if(isset($e['main_logo']))
            $logo = $e['main_logo'];

    if(!$logo)
        $logo = $placeholder;

    return $logo; //src of the logo
}
?>