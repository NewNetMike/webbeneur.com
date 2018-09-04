<?php get_header(); ?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<div class="main-container">
	<div id="page">
		<div class="<?php mts_article_class(); ?>">
			<div id="content_box">
				<div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
					<div class="single_post">
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
									<?php // Single post parts ordering
									if ( isset( $mts_options['mts_single_post_layout'] ) && is_array( $mts_options['mts_single_post_layout'] ) && array_key_exists( 'enabled', $mts_options['mts_single_post_layout'] ) ) {
										$single_post_parts = $mts_options['mts_single_post_layout']['enabled'];
									} else {
										$single_post_parts = array( 'content' => 'content', 'related' => 'related', 'author' => 'author' );
									} 
									foreach( $single_post_parts as $part => $label ) {
										switch ($part) {
											case 'content': ?>
												<?php if(has_post_thumbnail()) { ?>
													<div class="featured-thumbnail">
														<?php if(empty($header_animation) && has_post_thumbnail()) the_post_thumbnail('steadyincome-featuredfull',array('class' =>
														 'attachment-featured wp-post-image')); ?>
													</div>
												<?php } ?>
												<header>
													<h1 class="title front-view-title single-title">
														<?php the_title(); ?>
													</h1>
													<?php mts_the_postinfo( 'single' ); ?>
												</header>
												<div class="post-single-content box mark-links entry-content content">
													<?php if ($mts_options['mts_posttop_adcode'] != '') { ?>
														<?php $toptime = $mts_options['mts_posttop_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$toptime day")), get_the_time("Y-m-d") ) >= 0) { ?>
															<div class="topad">
																<?php echo do_shortcode($mts_options['mts_posttop_adcode']); ?>
															</div>
														<?php } ?>
													<?php } ?>
													<?php if (isset($mts_options['mts_social_button_position']) && $mts_options['mts_social_button_position'] !== 'bottom') mts_social_buttons(); ?>
													<?php the_content(); ?>
													<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => '<i class="fa fa-angle-right"></i>', 'previouspagelink' => '<i class="fa fa-angle-left"></i>', 'pagelink' => '%','echo' => 1 )); ?>
													<?php if ($mts_options['mts_postend_adcode'] != '') { ?>
														<?php $endtime = $mts_options['mts_postend_adcode_time']; if (strcmp( date("Y-m-d", strtotime( "-$endtime day")), get_the_time("Y-m-d") ) >= 0) { ?>
															<div class="bottomad">
																<?php echo do_shortcode($mts_options['mts_postend_adcode']); ?>
															</div>
														<?php } ?>
													<?php } ?>
													<?php if (empty($mts_options['mts_social_button_position']) || $mts_options['mts_social_button_position'] == 'bottom') mts_social_buttons(); ?>
												</div>
												<?php
											break;

											case 'tags': ?>
												<div class="tags">
													<?php mts_the_tags('<span class="tagtext">
													'.__('Tags','steadyincome').':</span>',', ') ?>
												</div>
												<?php
											break;

											case 'subscribes':
												if (function_exists('wp_subscribe_shortcode')) { // Pro version
													echo wp_subscribe_shortcode();
												} else if (function_exists('wp_subscribe_register_widget')) { // Free version
													echo mts_in_post_wp_subscribe();
												}
											break;

											case 'related':
												mts_related_posts();
											break;

											case 'author': ?>
												<div class="postauthor">
													<h4><?php _e('About the Author','steadyincome'); ?></h4>
													<div class="author_wrap">
														<div class="post-img">
															<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '100' );  } ?>
															<?php $userID = get_the_author_meta( 'ID' );
															$facebook = get_the_author_meta( 'facebook_profile', $userID );
															$twitter = get_the_author_meta( 'twitter_profile', $userID );
															$google = get_the_author_meta( 'google_profile', $userID ); ?>
															<?php if(!empty($facebook) || !empty($twitter) || !empty($google)){ ?>
																<div class="social-icons">
																	<ul>
																		<?php if($facebook !='') { ?>
																			<li class="single_fb"><a href="<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></li>
																		<?php } ?>
																		<?php if($twitter !='') { ?>
																			<li class=""><a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a></li>
																		<?php } ?>
																		<?php if($google !='') { ?>
																			<li class=""><a href="<?php echo $google; ?>"><i class="fa fa-google-plus"></i></a></li>
																		<?php } ?>
																	</ul>
																</div>
															<?php } ?>
														</div>
														<h5 class="vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"/ class="fn"><?php the_author_meta( 'nickname' ); ?>
														</a></h5>
														<div class="readMore">
															<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"/><?php _e('My Other Posts','steadyincome'); ?><i class="fa fa-angle-double-right"></i></a>
														</div>
														<div class="front-view-content">
															<?php the_author_meta('description'); ?>
														</div>
													</div>
												</div>
											<?php break;
										}
									} ?>
									<?php comments_template( '', true ); ?>
								<?php endwhile; /* end loop */ ?>
							</article>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>