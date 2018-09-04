<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>

<div class="main-container blog-page"> 
  <div id="page">
  		<div class="article <?php echo $mts_options['mts_home_post_layout']; ?>" id="archive">
			<div id="content_box">
				<h1 class="postsby">
					<span><?php _e("Search Results for:", "steadyincome"); ?></span> <?php the_search_query(); ?>
				</h1>
				<?php $j = 0; if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article class="latestPost latestarticle excerpt">
						<!--First Article-->
						<?php mts_archive_post(); ?>
					</article>
				<?php $j++; endwhile; else: ?>
					<div class="no-results">
						<h2><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'steadyincome'); ?></h2>
						<?php get_search_form(); ?>
					</div><!--noResults-->
				<?php endif; wp_reset_query(); ?>
				<?php if ( $j !== 0 ) { // No pagination if there are no posts ?>
                    <?php get_template_part( 'templates/archive-pagination' ); ?>
                <?php } ?>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>