<aside class="sidebar" data-design="sidebar-1.0">
<?php 
    $aside = 'template-parts/.template/aside';
    get_template_part( "{$aside}/search" );
    get_template_part( "{$aside}/recent" ); 
    get_template_part( "{$aside}/cats" ); 
    get_template_part( "{$aside}/cats-year" ); 
?>
</aside>