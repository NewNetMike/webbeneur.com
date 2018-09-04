<?php
/*-----------------------------------------------------------------------------------

    Plugin Name: MyThemeShop About Author
    Description: A widget for Author Box
    Version: 1.0

-----------------------------------------------------------------------------------*/
class about_author_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'about_author_widget', // Base ID
            __( 'MyThemeShop: About Author ', 'steadyincome' ), // Name
            array( 'description' => __( 'Author box widget', 'steadyincome' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        if(is_single()) {
            echo $args['before_widget'];
            if ( ! empty( $instance['title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            } ?>
            <div id="sidebar-author"> 
                <div id="" class="widget_text">
                    <div class="horizontal-container-inner">
                        <div class="post-img">
                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="Parallax post">
                                <?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '147' );  } ?>
                            </a>
                            <?php $userID = get_current_user_id();
                            $facebook = get_the_author_meta( 'facebook_profile', $userID );
                            $twitter = get_the_author_meta( 'twitter_profile', $userID );
                            $google = get_the_author_meta( 'google_profile', $userID );
                            if(!empty($facebook) || !empty($twitter) || !empty($google)){ ?>
                                <div class="social-icons">
                                    <ul>
                                        <?php if($facebook !=''){ ?>
                                            <li class="single_fb"><a href="<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                                        <?php } ?>
                                        
                                        <?php if($twitter !='') { ?>
                                            <li class=""><a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a></li>
                                        <?php } ?>

                                        <?php if($google !=''){ ?>
                                            <li class=""><a href="<?php echo $google; ?>"><i class="fa fa-google-plus"></i></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="post-data">
                            <div class="post-data-container">
                                <div class="post-title">
                                    <?php the_author_meta('description') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            echo $args['after_widget'];
        }
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'About Me', 'steadyincome' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','steadyincome' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

} // class about_author_Widget

// register about_author_Widget widget
function register_about_author_widget() {
    register_widget( 'about_author_Widget' );
}
add_action( 'widgets_init', 'register_about_author_widget' );
?>