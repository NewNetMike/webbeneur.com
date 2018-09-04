<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<div class="latestpost_wrap">    
	<header>
	    <h1 class="title front-view-title" itemprop="headline"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
	</header>   
	<?php mts_the_postinfo(); ?>        
	<?php if (empty($mts_options['mts_full_posts'])) : ?>
		<?php if(has_post_thumbnail()) { ?>
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"/ id="featured-thumbnail">
			    <div class="featured-thumbnail">
			        <?php the_post_thumbnail('steadyincome-featuredfull',array('title' => '','itemprop'=>'image')); ?>                       
			        <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
			    </div> 
			</a>
		<?php } ?>
	    <div class="front-view-content">
	        <?php echo mts_excerpt(50); ?>
	    </div>
	    <div class="article_footer">    
	        <?php if(!empty($mts_options['mts_home_social_buttons'])) { ?>    
		        <div class="shareit-blog">
		            <?php echo mts_social_buttons_blog(); ?>
		        </div>
		    <?php } ?>
	        <?php mts_readmore(); ?>
	    </div>
	<?php else : ?>
	    <div class="front-view-content full-post">
	        <?php the_content(); ?>
	    </div>
	    <?php if (mts_post_has_moretag()) : ?>
	        <?php mts_readmore(); ?>
	    <?php endif; ?>
	<?php endif; ?>
</div>