<?php
/**
 * Template Name: Homepage
 */
?>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<?php get_header(); ?>
<?php if ($mts_options['mts_banner_show'] == '1') { ?>
<div class="b_first">
    <div class="main-container">
        <div class="container">
            <div class="blog_first">
                <!--first content-->
                <div id="first_b">
                    <div class="b_right" <?php if ( isset( $_GET['mailchimp_signup'] ) || !empty( $_GET['aweber_signedup'] ) ) echo 'style="display:none;"'; ?>>
                        <h2 class="front-view-title">
                            <?php echo $mts_options['mts_banner_title']; ?>
                        </h2>
                        <div class="front-view-content">
                            <?php echo $mts_options['mts_banner_texts']; ?>
                        </div>
                        <?php if(!empty($mts_options['mts_button_text'])) { ?>
                            <div class="readMore" style="background:<?php echo $mts_options['mts_banner_button_bg']; ?>">
                                <a href="javascript:void(0);" onclick="hide_b();"><?php echo $mts_options['mts_button_text']; ?></a>
                                <?php if(!empty($mts_options['mts_arrow_image'])) { ?>
                                    <div class="b_dollor">
                                        <img src="<?php echo $mts_options['mts_arrow_image']; ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!--Rightside Content-Option-1-->
                </div>
                <div id="second_b" <?php if ( !isset( $_GET['mailchimp_signup'] ) && empty( $_GET['aweber_signedup'] ) ) echo 'style="display:none;"'; ?>>
                    <div class="blog_first_alternative">
                        <h2 class="front-view-title">
                        <?php echo $mts_options['mts_banner_title']; ?>
                        </h2>
                        <div class="form_wrap">
                            <?php if(!empty($mts_options['mts_form_image'])) { ?>
                                <div class="form_wrap_left">
                                    <img src="<?php echo $mts_options['mts_form_image']; ?>">
                                </div>
                            <?php } ?>
                            <div class="form_wrap_right">
                                <?php dynamic_sidebar('Home Subscribe Widget'); ?>
                            </div>
                        </div>
                    </div>
                    <!--Rightside content alternative option-->
                    <script type="text/javascript">
                        function hide_b() {
                            jQuery('#first_b').hide();
                            jQuery('#second_b').show();
                        }  
                    </script>
                </div>
            </div>
            <!--End of first content-->
        </div>
    </div>
</div>
<?php } ?>
<div class="main-container">
    <div id="page">
        <div class="artcl article">
            <div id="content_box">
                <?php if ($mts_options['mts_banner2_show'] == '1') { ?>
                    <!--Second Content-->
                    <div class="blog_second">
                        <div class="b_left">
                            <h2 class="front-view-title">
                                <?php echo $mts_options['mts_social_title']; ?>
                            </h2>
                            <?php if ( !empty($mts_options['mts_banner_social']) && is_array($mts_options['mts_banner_social'])) { ?>
                                <div class="social-icons">
                                    <ul>
                                        <?php foreach( $mts_options['mts_banner_social'] as $header_icons ) : ?>
                                            <?php if( ! empty( $header_icons['mts_banner_icon'] ) && isset( $header_icons['mts_banner_icon'] ) ) : ?>
                                                <li><a href="<?php print $header_icons['mts_banner_icon_link'] ?>" class="header-<?php print $header_icons['mts_banner_icon'] ?>"><span class="fa fa-<?php print $header_icons['mts_banner_icon'] ?>"></span></a></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="b_right">
                            <h2 class="front-view-title">
                            <?php echo $mts_options['mts_books_title']; ?>
                            </h2>
                            <div class="b_readings">
                                <ul>
                                    <?php if(!empty($mts_options['mts_books_image'])){ ?>
                                        <?php foreach( $mts_options['mts_books_image'] as $slide ) : ?>
                                            <li><a href="<?php echo $slide['mts_book_link']; ?>"> <?php echo wp_get_attachment_image( $slide['mts_book_image'], false, array('title' =>'') ); ?></a></li>
                                        <?php endforeach; ?>
                                        <li class="more-books"><a href="<?php echo $mts_options['mts_more_book_link']; ?>"><?php echo $mts_options['mts_more_book_text']; ?><i class="fa fa-angle-double-right"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($mts_options['mts_featured_posts']) && !empty($mts_options['mts_featured_post_cat'])) { ?>
                    <div class="home_article">
                        <?php 
                        foreach ( $mts_options['mts_featured_post_cat'] as $cat_id ) {
                            $featured_query = new WP_Query( apply_filters( 'steadyincome_featured_posts_query', array(
                                'cat' => $cat_id,
                                'posts_per_page' => 1
                            ) ) );
                            if ($featured_query->have_posts()) : ?>
                                <section class="home_article-cat">
                                    <h3><?php echo get_the_category_by_id( $cat_id ); ?></h3>
                                    <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
                                        <article class="latestPost featuredpost excerpt">
                                            <!--Featured Post-->
                                            <header>
                                                <?php if(has_post_thumbnail()) { ?>
                                                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
                                                        <div class="featured-thumbnail">
                                                            <?php the_post_thumbnail('steadyincome-featured',array('title' => '')); ?> <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                                                        </div>
                                                    </a>
                                                <?php } ?>
                                            </header>
                                            <div class="latestpost_wrap">
                                                <h2 class="front-view-title">
                                                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>
                                                "><?php the_title(); ?></a>
                                                </h2>
                                                <?php mts_the_postinfo( 'home' ); ?>
                                                <div class="front-view-content">
                                                    <?php echo mts_excerpt(45); ?>
                                                </div>
                                                <?php mts_readmore(); ?>
                                            </div>
                                        </article>
                                    <?php endwhile; ?>
                                    <?php wp_reset_query(); ?>
                                </section>
                            <?php endif; ?>
                        <?php } ?>
                        <?php $j = 0; 
                        if (get_query_var('page') > 1) { 
                            $paged = get_query_var('page'); 
                        } elseif (get_query_var('paged')) {
                            $paged = get_query_var('paged'); 
                        } else { 
                            $paged = 1; 
                        } 
                        $args= array('paged' => $paged, 'post_type' => 'post');
                        global $mts_featured_posts;
                        if ( ! empty( $mts_options['mts_featured_post_dedup'] ) ) {
                            $args['post__not_in'] = $mts_featured_posts;
                        }
                        query_posts($args); 
                        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <?php if($j ==0){ ?>
                                <section class="home_article-cat">
                                    <h3><?php _e('Latest Post','steadyincome'); ?></h3>
                                    <article class="latestPost latestpost excerpt">
                                        <!--Latest Post-->
                                        <header>
                                            <a href="<?php the_permalink() ?>" title="Menu widget article" id="featured-thumbnail">
                                                <div class="featured-thumbnail">
                                                    <?php the_post_thumbnail('steadyincome-featured',array('title' => '')); ?>
                                                    <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                                                </div>
                                            </a>
                                        </header>
                                        <div class="latestpost_wrap">
                                            <h2 class="front-view-title">
                                                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                            </h2>
                                            <?php mts_the_postinfo( 'home' ); ?>
                                            <div class="front-view-content">
                                                <?php echo mts_excerpt(40); ?>
                                            </div>
                                            <?php mts_readmore(); ?>
                                        </div>
                                    </article>
                                </section>
                            <?php } ?>
                        <?php $j++; endwhile; wp_reset_query(); endif; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
