<?php
/**
 * Widget Name: Post List Widget
 * Widget Description: Easily add post list along with post featured image to the theme's sidebar.
 *
 * @package Perennial
 */

/**
* Register the widget for use in Appearance -> Widgets
*/
add_action( 'widgets_init', 'perennial_postlist_widget_init' );
function perennial_postlist_widget_init() {
	register_widget( 'Perennial_Postlist_Widget' );
}

/**
 * Post List widget class
 */
class Perennial_Postlist_Widget extends WP_Widget {

	/**
	 * Registers the widget with WordPress.
	 */
	function __construct() {

		parent::__construct(
			'postlist-perennial',
			apply_filters( 'perennial_widget_name', esc_html__( 'Perennial: Post List', 'perennial-pro' ) ),
			array(
				'classname'   => 'widget-postlist-perennial',
				'description' => esc_html__( 'Display a post list.', 'perennial-pro' )
			)
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
	function widget( $args, $instance ) {

		// Defaults
		$defaults = $this->defaults();

		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Open the output of the widget.
		echo $args['before_widget'];

?>
		<?php if ( ! empty( $instance['title'] ) ) : ?>
			<?php echo $args['before_title'] . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $args['after_title']; ?>
		<?php endif; ?>

		<?php
		// Query Args
		$query_args = array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $instance['postlist_limit'] );

		// Post Category
		if ( $instance['postlist_category'] > 0 ) {
			$query_args['cat'] = $instance['postlist_category'];
		}

		// Post Tag
		if ( ! empty( $instance['postlist_tag'] ) ) {
			$query_args['tag'] = $instance['postlist_tag'];
		}

		// Post Order
		if ( 2 === $instance['postlist_orderby'] ) {
			$query_args['orderby'] = 'comment_count';
		}

		// WP Query
		$postlist_query = new WP_Query( $query_args );
		if ( $postlist_query->have_posts() ) :
		?>
		<ul>
		<?php
		// Loop
		while( $postlist_query->have_posts() ) : $postlist_query->the_post();

		// Post Thumbnail Logic
		$post_thumbnail       = false;
		$post_thumbnail_class = '';

		if( has_post_thumbnail() ) {
			$post_thumbnail       = true;
			$post_thumbnail_class = 'class="has-post-thumbnail"';
		}
		?>
			<li <?php echo $post_thumbnail_class ?>>
				<?php if ( true === $post_thumbnail ) : ?>
				<div class="postlist-thumbnail">
					<a href="<?php echo esc_url( get_permalink() ); ?>">
						<?php the_post_thumbnail( 'perennial-thumbnail', array( 'class' => 'img-postlist img-responsive' ) ); ?>
					</a>
				</div>
				<?php endif; ?>
				<div class="postlist-content">
					<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" class="postlist-title" rel="bookmark">', '</a>' ); ?>
					<span class="postlist-date"><?php echo esc_html( get_the_date() ); ?></span>
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php
		endif;
		// Reset Post Data
		wp_reset_postdata();
		?>

<?php

		/** Close the output of the widget. */
		echo $args['after_widget'];

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
	function update( $new_instance, $old_instance ) {

		// Instance
		$instance = $old_instance;

		// Sanitization
		$instance['title']             = strip_tags( $new_instance['title'] );
		$instance['postlist_category'] = absint( $new_instance['postlist_category'] );
		$instance['postlist_tag']      = wp_kses( stripslashes( trim( $new_instance['postlist_tag'] ) ), array() );
		$instance['postlist_orderby']  = absint( $new_instance['postlist_orderby'] );
		$instance['postlist_limit']    = absint( $new_instance['postlist_limit'] );

		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	function form( $instance ) {

		// Defaults
		$defaults = $this->defaults();

		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Controls
		$postlist_orderby = array (
			1 => esc_html__( 'Recent Posts',  'perennial-pro'),
			2 => esc_html__( 'Popular Posts', 'perennial-pro'),
		);
		$postlist_limit = range( 1, 20 );
?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'perennial-pro' ); ?>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postlist_category' ) ); ?>">
				<?php esc_html_e( 'Select Category:', 'perennial-pro' ); ?>
				<?php
				$args = array(
					'show_option_all'  => esc_html__( 'All Categories', 'perennial-pro' ),
					'selected'         => $instance['postlist_category'],
					'name'             => $this->get_field_name( 'postlist_category' ),
					'class'            => 'widefat',
				);
				wp_dropdown_categories( $args );
				?>
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postlist_tag' ) ); ?>">
				<?php esc_html_e( 'Enter Tags (Optional): e.g. tag1,tag2', 'perennial-pro' ); ?>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postlist_tag' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postlist_tag' ) ); ?>" value="<?php echo esc_attr( $instance['postlist_tag'] ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postlist_orderby' ) ); ?>">
				<?php esc_html_e( 'Post Order:', 'perennial-pro' ); ?>
	            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postlist_orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postlist_orderby' ) ); ?>">
	              <?php foreach ( $postlist_orderby as $key => $val ): ?>
				    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $instance['postlist_orderby'], $key ); ?>><?php echo esc_html( $val ); ?></option>
				  <?php endforeach; ?>
	            </select>
            </label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postlist_limit' ) ); ?>">
				<?php esc_html_e( 'Number of posts to display:', 'perennial-pro' ); ?>
	            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postlist_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postlist_limit' ) ); ?>">
	              <?php foreach ( $postlist_limit as $key => $val ): ?>
				    <option value="<?php echo esc_attr( $val ); ?>" <?php selected( $instance['postlist_limit'], $val ); ?>><?php echo esc_html( $val ); ?></option>
				  <?php endforeach; ?>
	            </select>
            </label>
		</p>

<?php
	}

	// Defaults
	function defaults() {

		$defaults = array (
			'title'             => esc_html__( 'Post List', 'perennial-pro'),
			'postlist_category' => 0,
			'postlist_tag'      => '',
			'postlist_orderby'  => 1,
			'postlist_limit'    => 5
		);

		return $defaults;

	}

}
