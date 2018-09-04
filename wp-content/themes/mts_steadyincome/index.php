<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div class="main-container blog-page">
    <div id="page">
        <div class="article <?php echo $mts_options['mts_home_post_layout']; ?>">
            <div id="content_box">
                <?php $j = 0; if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <article class="latestPost latestarticle excerpt">
                        <?php mts_archive_post(); ?>
                    </article>
                <?php $j++; endwhile; ?>

                <?php if ( $j !== 0 ) { // No pagination if there are no posts ?>
                    <?php get_template_part( 'templates/archive-pagination' ); ?>
                <?php } ?>

                <?php endif; wp_reset_query(); ?>
                <?php if (function_exists('wp_subscribe_shortcode')) echo wp_subscribe_shortcode(); ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>