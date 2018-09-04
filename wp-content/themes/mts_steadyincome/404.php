<?php get_header(); ?>
 <div class="main-container"> 
  	<div id="page">
	    <div class="article">
		    <div id="content_box">
	            <div id="post-<?php the_ID(); ?>" <?php post_class('g post'); ?>>
	                <div class="single_post">
	                    <div class="post-single-content box mark-links entry-content">
	                        <div class="thecontent" itemprop="articleBody">
		                        <article class="latestPost latestarticle excerpt">
									<header>
										<div class="title">
											<h1><?php _e('Error 404 Not Found', 'steadyincome'); ?></h1>
										</div>
									</header>
									<div class="post-content">
										<p><?php _e('Oops! We couldn\'t find this Page.', 'steadyincome'); ?></p>
										<p><?php _e('Please check your URL or use the search form below.', 'steadyincome'); ?></p>
										<?php get_search_form();?>
									</div><!--.post-content--><!--#error404 .post-->
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