<!-- search -->
<div class="widget as-common cats">
    <h4 class="wtitle">By Category</h4>
    <ul class="bullet">
    <?php 
      $categories = get_categories( array(
          'parent'   => '0',
          'orderby' => 'description',
          'order'   => 'ASC',
          'hide_empty' => '0'		  
      ) );
       
      foreach( $categories as $category ):
          $category_link = esc_url(get_category_link( $category->term_id)); 
    ?>
        <li>
            <a href="<?php echo $category_link; ?>">
                <?php echo $category->name; ?>
            </a>
        </li>
    <?php 
        endforeach; 
    ?>
    </ul> 
</div>