<?php
$mts_options = get_option(MTS_THEME_NAME);
/*------------[ Meta ]-------------*/
if ( ! function_exists( 'mts_meta' ) ) {
    function mts_meta(){
    global $mts_options, $post;
?>
<?php if ( !empty( $mts_options['mts_favicon'] ) ) { ?>
<link rel="icon" href="<?php echo $mts_options['mts_favicon']; ?>" type="image/x-icon" />
<?php } ?>
<?php if ( !empty( $mts_options['mts_metro_icon'] ) ) { ?>
    <!-- IE10 Tile.-->
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="<?php echo $mts_options['mts_metro_icon']; ?>">
<?php } ?>
<!--iOS/android/handheld specific -->
<?php if ( !empty( $mts_options['mts_touch_icon'] ) ) { ?>
    <link rel="apple-touch-icon-precomposed" href="<?php echo $mts_options['mts_touch_icon']; ?>" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php if($mts_options['mts_prefetching'] == '1') { ?>
<?php if (is_front_page()) { ?>
    <?php $my_query = new WP_Query('posts_per_page=1'); while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <link rel="prefetch" href="<?php the_permalink(); ?>">
    <link rel="prerender" href="<?php the_permalink(); ?>">
    <?php endwhile; wp_reset_query(); ?>
<?php } elseif (is_singular()) { ?>
    <link rel="prefetch" href="<?php echo home_url(); ?>">
    <link rel="prerender" href="<?php echo home_url(); ?>">
<?php } ?>
<?php } ?>
    <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
    <meta itemprop="url" content="<?php echo site_url(); ?>" />
    <?php if ( is_singular() ) { ?>
    <meta itemprop="creator accountablePerson" content="<?php $user_info = get_userdata($post->post_author); echo $user_info->first_name.' '.$user_info->last_name; ?>" />
    <?php } ?>
<?php }
}

/*------------[ Head ]-------------*/
if ( ! function_exists( 'mts_head' ) ){
    function mts_head() {
    global $mts_options
?>
<?php echo $mts_options['mts_header_code']; ?>
<?php }
}
add_action('wp_head', 'mts_head');

/*------------[ Copyrights ]-------------*/
if ( ! function_exists( 'mts_copyrights_credit' ) ) {
    function mts_copyrights_credit() { 
    global $mts_options
?>
<!--start copyrights-->
<div class="row" id="copyright-note">
    <span><?php _e('Copyright','steadyincome'); ?> &copy; <?php echo date("Y") ?>. <?php echo $mts_options['mts_copyrights']; ?></span>
    <?php if($mts_options['mts_show_footer_nav']) { ?>
	    <div class="top">
	        <div class="footer-navigation" role="navigation" itemscope="" itemtype="http://schema.org/SiteNavigationElement">
	            <nav class="clearfix">
					<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>
	                    <?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
	                <?php } else { ?>
	                    <ul class="menu clearfix">
	                        <?php wp_list_pages('title_li='); ?>
	                    </ul>
	                <?php } ?>
	            </nav>
	        </div>
	    </div>
	<?php } ?>
</div>
<!--end copyrights-->
<?php }
}

/*------------[ footer ]-------------*/
if ( ! function_exists( 'mts_footer' ) ) {
    function mts_footer() { 
    global $mts_options
?>
<?php if ($mts_options['mts_analytics_code'] != '') { ?>
<!--start footer code-->
<?php echo $mts_options['mts_analytics_code']; ?>
<!--end footer code-->
<?php } ?>
<?php }
}

/*------------[ breadcrumb ]-------------*/
if (!function_exists('mts_the_breadcrumb')) {
    function mts_the_breadcrumb() {
        echo '<div><i class="fa fa-home"></i></div> <div typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
        echo esc_url( home_url() );
        echo '">'.esc_html(sprintf( __( "Home", 'steadyincome' )));
        echo '</a></div><div><i class="fa fa-caret-right"></i></div>';
        if(is_home()) { echo __('Blog','steadyincome'); }
        if (is_single()) {
            $categories = get_the_category();
            $output = '';
            if($categories){
                foreach($categories as $category) {
                    echo '<div typeof="v:Breadcrumb"><a href="'.get_category_link( $category->term_id ).'" rel="v:url" property="v:title">'.$category->cat_name.'</a></div><div><i class="fa fa-caret-right"></i></div>';
                }
            }
            echo "<div><span>";
            the_title();
            echo "</span></div>";
        } elseif (is_page()) {
            echo "<div><span>";
            the_title();
            echo "</span></div>";
        } elseif (is_category()) {
            echo "<div><span>";
            single_cat_title();
            echo "</span></div>";
        } elseif (is_author()) {
            echo "<div><span>";
            if(get_query_var('author_name')) :
                $curauth = get_user_by('slug', get_query_var('author_name'));
            else :
                $curauth = get_userdata(get_query_var('author'));
            endif;
            echo $curauth->nickname;
            echo "</span></div>";
        } elseif (is_search()) {
            echo "<div><span>";
            the_search_query();
            echo "</span></div>";
        } elseif (is_tag()) {
            echo "<div><span>";
            single_tag_title();
            echo "</span></div>";
        }
    }
}

/*------------[ schema.org-enabled the_category() and the_tags() ]-------------*/
function mts_the_category( $separator = ', ' ) {
    $categories = get_the_category();
    $count = count($categories);
    foreach ( $categories as $i => $category ) {
        echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'steadyincome' ), $category->name ) . '" ' . '>' . $category->name.'</a>';
        if ( $i < $count - 1 )
            echo $separator;
    }
}
function mts_the_tags($before = null, $sep = ', ', $after = '') {
    if ( null === $before ) 
        $before = __('Tags: ', 'steadyincome');
    
    $tags = get_the_tags();
    if (empty( $tags ) || is_wp_error( $tags ) ) {
        return;
    }
    $tag_links = array();
    foreach ($tags as $tag) {
        $link = get_tag_link($tag->term_id);
        $tag_links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $tag->name . '</a>';
    }
    echo $before.join($sep, $tag_links).$after;
}

/*------------[ pagination ]-------------*/

if (!function_exists('mts_pagination')) {
    /**
     * Display the pagination.
     *
     * @param string $pages
     * @param int $range
     */
    function mts_pagination($pages = '', $range = 3) {
        $mts_options = get_option(MTS_THEME_NAME);
        if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { // numeric pagination
            the_posts_pagination( array(
                'mid_size' => 3,
                'prev_text' => '<i class="fa fa-angle-left"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>',
            ) );
        } else { // traditional or ajax pagination
            ?>
            <div class="pagination pagination-previous-next">
            <ul>
                <li class="nav-previous"><?php next_posts_link( '<i class="fa fa-angle-left"></i> ' ); ?></li>
                <li class="nav-next"><?php previous_posts_link( ' <i class="fa fa-angle-right"></i>' ); ?></li>
            </ul>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'mts_cart' ) ) {
    /**
     * Display the woo-commerce login/register link and the cart.
     */
    function mts_cart() { 
       if (mts_is_wc_active()) {
       global $mts_options;
?>
<div class="mts-cart">
    <?php global $woocommerce; ?>
    <span>
        <i class="fa fa-user"></i> 
        <?php if ( is_user_logged_in() ) { ?>
            <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('My Account', 'steadyincome' ); ?>"><?php _e('My Account', 'steadyincome' ); ?></a>
        <?php } 
        else { ?>
            <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('Login / Register', 'steadyincome' ); ?>"><?php _e('Login ', 'steadyincome' ); ?></a>
        <?php } ?>
    </span>
    <span>
        <i class="fa fa-shopping-cart"></i> <a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e('View your shopping cart', 'steadyincome' ); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'steadyincome' ), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    </span>
</div>
<?php } 
    }
}

/*------------[ Related Posts ]-------------*/
if (!function_exists('mts_related_posts')) {
    function mts_related_posts() {
        global $post;
        $mts_options = get_option(MTS_THEME_NAME);
        //if(!empty($mts_options['mts_related_posts'])) { ?>    
            <!-- Start Related Posts -->
            <?php 
            $empty_taxonomy = false;
            if (empty($mts_options['mts_related_posts_taxonomy']) || $mts_options['mts_related_posts_taxonomy'] == 'tags') {
                // related posts based on tags
                $tags = get_the_tags($post->ID); 
                if (empty($tags)) { 
                    $empty_taxonomy = true;
                } else {
                    $tag_ids = array(); 
                    foreach($tags as $individual_tag) {
                        $tag_ids[] = $individual_tag->term_id; 
                    }
                    $args = array( 'tag__in' => $tag_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' =>@$mts_options['mts_related_postsnum'], 
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             } else {
                // related posts based on categories
                $categories = get_the_category($post->ID); 
                if (empty($categories)) { 
                    $empty_taxonomy = true;
                } else {
                    $category_ids = array(); 
                    foreach($categories as $individual_category) 
                        $category_ids[] = $individual_category->term_id; 
                    $args = array( 'category__in' => $category_ids, 
                        'post__not_in' => array($post->ID), 
                        'posts_per_page' => @$mts_options['mts_related_postsnum'],  
                        'ignore_sticky_posts' => 1, 
                        'orderby' => 'rand' 
                    );
                }
             }
            if (!$empty_taxonomy) {
            $my_query = new wp_query( $args ); if( $my_query->have_posts() ) {
                echo '<div class="related-posts">';
                echo '<h4>'.__('Related Posts','steadyincome').'</h4>';
                echo '<div class="clear">';
                $posts_per_row = 2;
                $j = 0;
                while( $my_query->have_posts() ) { $my_query->the_post(); ?>

                <article class="excerpt <?php echo (++$j % $posts_per_row == 0) ? 'last' : ''; ?>"> 
                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" id="featured-thumbnail">
                        <?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('steadyincome-widgetthumb',array('title' => '')); echo '</div>'; ?>  
                    </a>
                    <header>
                        <h3 class="title front-view-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3> 
                        <div class="post-info">
                            <span class="theauthor">
                                <span>
                                    <?php _e('By','steadyincome'); ?> <?php the_author_posts_link(); ?>
                                </span>
                            </span>
                        </div>
                    </header> 
                </article> 
    
                <?php } echo '</div></div>'; }} wp_reset_query(); ?>
            <!-- .related-posts -->
        <?php //}
    }
}


if ( ! function_exists('mts_the_postinfo' ) ) {
    function mts_the_postinfo( $section = 'home' ) {
        $mts_options = get_option( MTS_THEME_NAME );
        $opt_key = 'mts_'.$section.'_headline_meta_info';
        
        if ( isset( $mts_options[ $opt_key ] ) && is_array( $mts_options[ $opt_key ] ) && array_key_exists( 'enabled', $mts_options[ $opt_key ] ) ) {
            $headline_meta_info = $mts_options[ $opt_key ]['enabled'];
        } else {
            $headline_meta_info = array();
        }
        if ( !isset( $headline_meta_info['date'] ) ) { // datePublished is reqired in schema ?>
            <meta content="<?php the_time( get_option( 'date_format' ) ); ?>">
        <?php
        }
        if ( ! empty( $headline_meta_info ) ) { ?>
            <div class="post-info">
                <?php foreach( $headline_meta_info as $key => $meta ) { mts_the_postinfo_item( $key ); } ?>
            </div>
        <?php }
    }
}
if ( ! function_exists('mts_the_postinfo_item' ) ) {
    function mts_the_postinfo_item( $item ) {
        switch ( $item ) {
            case 'author':
            ?>
                <span class="theauthor"><?php _e('By','steadyincome'); ?>&nbsp;<?php the_author_posts_link(); ?></span>
            <?php
            break;
            case 'date':
            ?>
                <span class="thetime updated"><?php _e('Posted on','steadyincome'); ?>&nbsp;<?php the_time( get_option( 'date_format' ) ); ?></span>
            <?php
            break;
            case 'category':
            ?>
                <span class="thecategory"><?php _e('In','steadyincome'); ?>&nbsp;<?php mts_the_category(', ') ?></span>
            <?php
            break;
            case 'comment':
            ?>
                <span class="thecomment"><a href="<?php comments_link(); ?>" itemprop="interactionCount"><?php echo comments_number();?></a></span>
            <?php
            break;
        }
    }
}

if (!function_exists('mts_social_buttons')) {
    function mts_social_buttons() {
        $mts_options = get_option( MTS_THEME_NAME );

        if ( isset( $mts_options['mts_social_buttons'] ) && is_array( $mts_options['mts_social_buttons'] ) && array_key_exists( 'enabled', $mts_options['mts_social_buttons'] ) ) {
            $buttons = $mts_options['mts_social_buttons']['enabled'];
        } else {
            $buttons = array();
        }

        if ( ! empty( $buttons ) ) {
        ?>
            <!-- Start Share Buttons -->
            <div class="shareit <?php echo $mts_options['mts_social_button_position']; ?>">
                <?php foreach( $buttons as $key => $button ) { mts_social_button( $key ); } ?>
            </div>
            <!-- end Share Buttons -->
        <?php
        }
    }
}

if ( ! function_exists('mts_social_button' ) ) {
    function mts_social_button( $button ) {
        $mts_options = get_option( MTS_THEME_NAME );
        switch ( $button ) {
            case 'facebookshare':
            ?>
                <!-- Facebook Share-->
                <span class="share-item facebooksharebtn">
                    <div class="fb-share-button" data-layout="button_count"></div>
                </span>
            <?php
            break;
            case 'twitter':
            ?>
                <!-- Twitter -->
                <span class="share-item twitterbtn">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo esc_attr( $mts_options['mts_twitter_username'] ); ?>"><?php esc_html_e( 'Tweet', 'steadyincome' ); ?></a>
                </span>
            <?php
            break;
            case 'gplus':
            ?>
                <!-- GPlus -->
                <span class="share-item gplusbtn">
                    <g:plusone size="medium"></g:plusone>
                </span>
            <?php
            break;
            case 'facebook':
            ?>
                <!-- Facebook -->
                <span class="share-item facebookbtn">
                    <div id="fb-root"></div>
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
                </span>
            <?php
            break;
            case 'pinterest':
            ?>
                <!-- Pinterest -->
                <span class="share-item pinbtn">
                    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal"><?php esc_html_e( 'Pin It', 'steadyincome' ); ?></a>
                </span>
            <?php
            break;
            case 'linkedin':
            ?>
                <!--Linkedin -->
                <span class="share-item linkedinbtn">
                    <script type="IN/Share" data-url="<?php echo esc_url( get_the_permalink() ); ?>"></script>
                </span>
            <?php
            break;
            case 'stumble':
            ?>
                <!-- Stumble -->
                <span class="share-item stumblebtn">
                    <su:badge layout="1"></su:badge>
                </span>
            <?php
            break;
        }
    }
}

//for blog
if (!function_exists('mts_social_buttons_blog')) {
    function mts_social_buttons_blog() {
        $mts_options = get_option( MTS_THEME_NAME );

        if ( isset( $mts_options['mts_social_buttons'] ) && is_array( $mts_options['mts_social_buttons'] ) && array_key_exists( 'enabled', $mts_options['mts_social_buttons'] ) ) {
            $buttons = $mts_options['mts_social_buttons']['enabled'];
        } else {
            $buttons = array();
        }

        if ( ! empty( $buttons ) ) {
        ?>
            <!-- Start Share Buttons -->
            <div class="shareit <?php echo $mts_options['mts_social_button_position']; ?>">
                <?php foreach( $buttons as $key => $button ) { mts_social_button_blog( $key ); } ?>
            </div>
            <!-- end Share Buttons -->
        <?php
        }
    }
}

if ( ! function_exists('mts_social_button_blog' ) ) {
    function mts_social_button_blog( $button ) {
        $mts_options = get_option( MTS_THEME_NAME );
        switch ( $button ) {
            case 'facebookshare':
            ?>
                <!-- Facebook Share-->
                <span class="share-item facebooksharebtn">
                    <div class="fb-share-button" data-layout="button_count"></div>
                </span>
            <?php
            break;
            case 'twitter':
            ?>
                <!-- Twitter -->
                <span class="share-item twitterbtn">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo esc_attr( $mts_options['mts_twitter_username'] ); ?>"><?php esc_html_e( 'Tweet', 'steadyincome' ); ?></a>
                </span>
            <?php
            break;
            case 'gplus':
            ?>
                <!-- GPlus -->
                <span class="share-item gplusbtn">
                    <g:plusone size="medium"></g:plusone>
                </span>
            <?php
            break;
            case 'facebook':
            ?>
                <!-- Facebook -->
                <span class="share-item facebookbtn">
                    <div id="fb-root"></div>
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
                </span>
            <?php
            break;
            case 'pinterest':
            ?>
                <!-- Pinterest -->
                <span class="share-item pinbtn">
                    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal"><?php esc_html_e( 'Pin It', 'steadyincome' ); ?></a>
                </span>
            <?php
            break;
            case 'linkedin':
            ?>
                <!--Linkedin -->
                <span class="share-item linkedinbtn">
                    <script type="IN/Share" data-url="<?php echo esc_url( get_the_permalink() ); ?>"></script>
                </span>
            <?php
            break;
            case 'stumble':
            ?>
                <!-- Stumble -->
                <span class="share-item stumblebtn">
                    <su:badge layout="1"></su:badge>
                </span>
            <?php
            break;
        }
    }
}
/*------------[ Class attribute for <article> element ]-------------*/
if ( ! function_exists( 'mts_article_class' ) ) {
    function mts_article_class() {
        $mts_options = get_option( MTS_THEME_NAME );
        $class = '';
        
        // sidebar or full width
        if ( mts_custom_sidebar() == 'mts_nosidebar' ) {
            $class = 'ss-full-width';
        } else {
            $class = 'article';
        }
        
        echo $class;
    }
}

/*------------[ Class attribute for #page element ]-------------*/
if ( ! function_exists( 'mts_single_page_class' ) ) {
    function mts_single_page_class() {
        $class = '';

        if ( is_single() || is_page() ) {

            $class = 'single';

            $header_animation = mts_get_post_header_effect();
            if ( !empty( $header_animation )) $class .= ' '.$header_animation;
        }

        echo $class;
    }
}

if ( ! function_exists( 'mts_archive_post' ) ) {
    function mts_archive_post( $layout = '' ) {

        $mts_options = get_option(MTS_THEME_NAME);

        if ( empty( $layout ) || !is_string( $layout ) ) {
            $archive_post_layout = isset( $mts_options['mts_home_post_layout'] ) ? $mts_options['mts_home_post_layout'] : 'layout-1';
        } else {
            $archive_post_layout = $layout;
        }

        get_template_part( 'templates/archive-post', $archive_post_layout );
    }
} ?>