<?php $mts_options = get_option(MTS_THEME_NAME);
// default = 3
$first_footer_num  = empty($mts_options['mts_first_footer_num']) ? 3 : $mts_options['mts_first_footer_num'];
if(!empty($mts_options['mts_footer_slider'])) { ?>
    <div class="footer_featured">
        <div class="main-container">
            <div class="customNavigation">
                <div class="custom_featured">
                    <?php _e('Featured in:','steadyincome'); ?>
                </div>
                <a class="btn footer-prev"><i class="fa fa-angle-left"></i></a>
                <a class="btn footer-next"><i class="fa fa-angle-right"></i></a>
            </div>
            <div id="owl-demo" class="owl-carousel owl-theme">
                <?php foreach( $mts_options['mts_footer_slider'] as $slide ) : ?>
                <div class="item" style="width:167px; margin-right:40px">
                    <a href="<?php echo $slide['mts_footer_slider_link']; ?>"> <?php echo wp_get_attachment_image( $slide['mts_footer_slider_image'], false, array('title' =>
                     '') ); ?> </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php } ?>
</div><!--#page-->
	<footer id="site-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
		<div class="main-container">
            <?php if ($mts_options['mts_first_footer']) : ?>
                <div class="footer-widgets first-footer-widgets widgets-num-<?php echo $first_footer_num; ?>">
                    <?php for ( $i = 1; $i <= $first_footer_num; $i++ ) {
                        $sidebar = ( $i == 1 ) ? 'footer-first' : 'footer-first-'.$i;
                        $class = ( $i == $first_footer_num ) ? 'f-widget last f-widget-'.$i : 'f-widget f-widget-'.$i;
                        ?>
                        <div class="<?php echo $class;?>">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar( $sidebar ) ) : ?><?php endif; ?>
                        </div>
                        <?php
                    } ?>
                </div><!--.first-footer-widgets-->
            <?php endif; ?> 
		</div><!--.container-->
        <div class="copyrights">
            <div class="main-container">
                <?php mts_copyrights_credit(); ?>
            </div>
        </div>
	</footer><!--footer-->
</div><!--.main-container-->
<?php mts_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>