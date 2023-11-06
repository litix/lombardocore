<?php

/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<div id="bitems" class="page_contents">
    <?php
    if ($query->have_posts()) : $num = $query->post_count;   ?>

        <div class="page_col_3">
            <?php while ($query->have_posts()) : $query->the_post();
                $terms = get_the_category();
                $terms_array = array();
                $title = get_the_title();
                foreach ($terms as $term) {
                    $terms_array[] = $term->name;
                }
                $terms_string = join(', ', $terms_array);
            ?>
                <div class="bl_item_content">
                    <a href="<?php the_permalink(); ?>">
                        <div class="bl_image background_style" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                            <div class="tips_overlay smooth"></div>
                        </div>
                        <div class="bl_text">
                            <h3><?= limit_text($title, 10); ?></h3>
                            <div class="bl_cat"><?= $terms_string; ?></div>
                            <div class="bl_excerpt"><?= excerpt(18); ?></div>
                        </div>
                    </a>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
        Page <?php echo $query->query['paged']; ?> of <?php echo $query->max_num_pages; ?><br />
        <div class="pagination">
            <div class="nav-previous"><?php previous_posts_link('Back'); ?></div>
            <div class="nav-next"><?php next_posts_link('Next', $query->max_num_pages); ?></div>

            <?php
            /* example code for using the wp_pagenavi plugin */
            if (function_exists('wp_pagenavi')) {
                echo '<br />';
                wp_pagenavi(array('query' => $query));
            }
            ?>
        </div>
</div>
<?php else : ?>
    <div class="search-result-end search-filter-results-list" data-search-filter-action="infinite-scroll-end" hidden>
        <span>End of Results</span>
    </div>
<?php endif; ?>