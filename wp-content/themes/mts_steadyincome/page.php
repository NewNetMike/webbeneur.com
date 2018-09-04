<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<div class="main-container">
	<div id="page">
		<div class="<?php mts_article_class(); ?>">
			<div id="content_box">
				<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
					<div class="single_page single_post">
						<div class="post-single-content box mark-links entry-content">
							<div class="thecontent">
								<?php $header_animation = mts_get_post_header_effect(); ?>
								<?php if ( 'parallax' === $header_animation ) {?>
									<?php if (mts_get_thumbnail_url()) : ?>
										<div id="parallax" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');" '; ?>>
										</div>
									<?php endif; ?>
								<?php } else if ( 'zoomout' === $header_animation ) {?>
									<?php if (mts_get_thumbnail_url()) : ?>
										<div id="zoom-out-effect">
											<div id="zoom-out-bg" <?php echo 'style="background-image: url('.mts_get_thumbnail_url().');" '; ?>>
											</div>
										</div>
									<?php endif; ?>
								<?php } ?>
								<article class="latestPost latestarticle excerpt">
									<!--article-1, first content-->
									<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
										<header>
											<h1 class="title front-view-title">
												<?php the_title(); ?>
											</h1>
										</header>
										<div class="post-content box mark-links entry-content">
											<?php the_content(); ?>
											<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => '<i class="fa fa-angle-right"></i>', 'previouspagelink' => '<i class="fa fa-angle-left"></i>', 'pagelink' => '%','echo' => 1 )); ?>
										</div>
										<?php comments_template( '', true ); ?>
									<?php endwhile; ?>
								</article>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>