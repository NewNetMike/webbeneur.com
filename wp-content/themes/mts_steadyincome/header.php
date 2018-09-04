<!DOCTYPE html>
<?php $mts_options = get_option(MTS_THEME_NAME); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"> 
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<?php mts_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>
	" />
	<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace( /\bno-js\b/,'js' );</script>
	<?php wp_head(); ?>
</head>
<body id="blogs" <?php body_class('main'); ?> itemscope itemtype="http://schema.org/WebPage">
	<div class="header-wrapper">
		<header id="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
			<div class="main-container">
			<?php if( $mts_options['mts_sticky_nav'] == '1' ) { ?>
				<div id="catcher" class="clear" ></div>
				<div class="nav_wrap sticky-navigation">
			<?php } else { ?>
				<div class="nav_wrap sticky-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<?php } ?>
					<div class="container">
						<div class="logo-wrap">
							<?php if ($mts_options['mts_logo'] != '') { ?>
								<?php
								$logo_id = mts_get_image_id_from_url( $mts_options['mts_logo'] );
								$logo_w_h = '';
								if ( $logo_id ) {
		        					$logo     = wp_get_attachment_image_src( $logo_id, 'full' );
		        					$logo_w_h = ' width="'.$logo[1].'" height="'.$logo[2].'"';
		        				}
		        				if( is_front_page() || is_home() || is_404() ) { ?>
									<h1 id="logo" class="image-logo" itemprop="headline">
										<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( $mts_options['mts_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"<?php echo $logo_w_h; ?><?php if (!empty($mts_options['mts_logo2x'])) { echo ' data-at2x="'.esc_attr( $mts_options['mts_logo2x'] ).'"'; } ?>></a>
									</h1><!-- END #logo -->
								<?php } else { ?>
									<h2 id="logo" class="image-logo" itemprop="headline">
										<a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( $mts_options['mts_logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"<?php echo $logo_w_h; ?><?php if (!empty($mts_options['mts_logo2x'])) { echo ' data-at2x="'.esc_attr( $mts_options['mts_logo2x'] ).'"'; } ?>></a>
									</h2><!-- END #logo -->
								<?php } ?>
							<?php } else { ?>
								<?php if( is_front_page() || is_home() || is_404() ) { ?>
									<h1 id="logo" class="text-logo" itemprop="headline">
										<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
									</h1><!-- END #logo -->
								<?php } else { ?>
								    <h2 id="logo" class="text-logo" itemprop="headline">
										<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
									</h2><!-- END #logo -->
								<?php } ?>
								<div class="site-description" itemprop="description">
									<?php bloginfo( 'description' ); ?>
								</div>
							<?php } ?>
						</div>
						<?php if ( $mts_options['mts_show_primary_nav'] == '1' ) { ?>
							<div id="primary-navigation" class="primary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
								<a href="#" id="pull" class="toggle-mobile-menu"><?php _e('Menu', 'steadyincome' ); ?></a>
								<?php if ( has_nav_menu( 'mobile' ) ) { ?>
									<nav class="navigation clearfix">
										<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
											<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
										<?php } else { ?>
											<ul class="menu clearfix">
												<?php wp_list_categories('title_li='); ?>
											</ul>
										<?php } ?>
									</nav>
									<nav class="navigation mobile-only clearfix mobile-menu-wrapper">
										<?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
									</nav>
								<?php } else { ?>
									<nav class="navigation clearfix mobile-menu-wrapper">
										<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
											<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '', 'walker' => new mts_menu_walker ) ); ?>
										<?php } else { ?>
											<ul class="menu clearfix">
												<?php wp_list_categories('title_li='); ?>
											</ul>
										<?php } ?>
									</nav>
								<?php } ?>
								<div class="search-style-one">
									<a id="trigger-overlay">
										<i class="fa fa-search"></i>
									</a>
									<div class="overlay overlay-slideleft">
										<div class="search-row">
											<form method="get" id="searchform" class="search-form" action="<?php echo home_url(); ?>" _lpchecked="1">
												<button type="button" class="overlay-close"><?php _e('Close','steadyincome'); ?></button>
												<input type="text" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search Keyword ...','steadyincome'); ?>" <?php if (!empty($mts_options['mts_ajax_search'])) echo ' autocomplete="off"'; ?>/>
											</form>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</header>
	</div>
	<?php if(!is_page_template('page-home.php')) {
		if (!empty($mts_options['mts_breadcrumb']) || !empty($mts_options['mts_header_bottom_text']) || !empty($mts_options['mts_header_bottom_button_link'])) { ?>
			<div class="breadcrumb_wrap">
				<div class="main-container">
					<?php if ($mts_options['mts_breadcrumb'] == '1') { ?>
						<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
							<?php mts_the_breadcrumb(); ?>
						</div>
					<?php } ?>
					<?php if (!empty($mts_options['mts_header_bottom_text']) || !empty($mts_options['mts_header_bottom_button_link'])) { ?>
						<div class="breadcrumb_right">
							<?php if (!empty($mts_options['mts_header_bottom_text'])) { ?>
								<div><?php echo $mts_options['mts_header_bottom_text']; ?></div>
							<?php } ?>
							<?php if (!empty($mts_options['mts_header_bottom_button_link'])) { ?>
								<div class="readMore">
									<a href="<?php echo $mts_options['mts_header_bottom_button_link']; ?>"> <?php echo $mts_options['mts_header_bottom_button_text']; ?>
									</a>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
	<?php }
	} ?>