<article class="element single-post ver-1">
<div class="wrap">
    <div class="container-xl">
        <div class="row">

        <div class="col-lg-9">

            <div class="post-content content mr-md-5">
                <div class="post-thumb">
                    <?php bd_post_thumbnail($posts->ID, 'full', 'img'); ?>
                </div>

                <div class="post-title">
                    <?php bd_tag(get_the_title(), 'h1', 'main-title') ?>
                </div>

                <div class="post-text dtext">
                    <?php the_content(); ?>
                </div>

                <div class="post-meta dflex-space">
                    <div>
                        <?php #bd_post_meta('avatar'); ?>
                        By : <?php bd_post_meta('name'); ?>
                        <span class="mx-2">|</span>
                        Posted In : <?php bd_post_category($post->ID); ?>                    
                    </div>
                    <div>
                        <?php bd_post_meta('date'); ?>
                    </div>
                </div>
                
                <?php 
                    bd_show_tags('post-tags'); 
                    /*
                    #post-tags

                    #comments
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    } 

                    #post-navigation
                    the_post_navigation(
                        array(
                            'next_text' => '<div class="post-prev">%title</div>',
                            'prev_text' => '<div class="post-next">%title</div>',
                            'screen_reader_text' => ' '
                        )
                    );                       
                    */               
                ?>                    

            </div>
        </div>
        <div class="col-lg-3">
            <aside class="sidebar ml-md-3">
                <?php get_template_part( 'template-parts/sidebar', 'default' ); ?>
            </aside>
        </div>
    </div>
</div>
</article>            