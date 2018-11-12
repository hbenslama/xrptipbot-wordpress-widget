<?php

class XRPTIPBOT_Widget extends WP_Widget {
	/**
	 * @var array
	 */
	protected $defaults;

	public function __construct() {
		parent::__construct(
			'xrptipbot_widget',
			esc_html__( 'Twitter XRPTIPBOT', 'widget-xrptipbot' ),
			array(
				'classname'   => 'widget-xrptipbot',
				'description' => __( 'Displays a XRPTIPBOT widget.', 'widget-xrptipbot' ),
			)
		);

		$this->defaults = array(
			'title'                => esc_html__( 'XRPTIPBOT Widget', 'widget-xrptipbot' ),
			'amount'          => 1,
			'receiver-account'          => '',
			'label'          => '',
			'thank-you-message'       => ''
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$amount = $instance['amount'];
		$receiver_twitter_username = $instance['receiver-twitter-username'];
		$label = $instance['label'];
		$thank_you_message = $instance['thank-you-message'];

		echo $args['before_widget'];

		if ( $instance['title'] ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
	?>
		<!-- embed snipped code from : https://www.xrptipbot.com/account/embed  -->
		<a
			amount="<?php echo $amount; ?>" 
			size="275" 
			to="<?php echo $receiver_twitter_username; ?>" 
			network="twitter" 
			href="https://www.xrptipbot.com" 
			label="<?php echo $label; ?>"
			labelpt="<?php echo $thank_you_message; ?>"
			target="_blank">
		</a>
		<script async src="https://www.xrptipbot.com/static/donate/tipper.js" charset="utf-8"></script>

	<?php
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
	public function update( $new_instance, $old_instance ) {
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['amount'] = ( 0 !== (int) $new_instance['amount'] ) ? (int) $new_instance['amount'] : null;
		$instance['receiver-twitter-username'] = sanitize_text_field( $new_instance['receiver-twitter-username'] );
		$instance['label'] = sanitize_text_field( $new_instance['label'] );
		$instance['thank-you-message'] = sanitize_text_field( $new_instance['thank-you-message'] );
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'xrptipbot-widget' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><?php esc_html_e( 'Tips amount:', 'xrptipbot-widget' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" type="number" min="0" max="20" value="<?php echo esc_attr( $instance['amount'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'receiver-twitter-username' ); ?>"><?php esc_html_e( 'Receiver Twitter Username:', 'xrptipbot-widget' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'receiver-twitter-username' ); ?>" name="<?php echo $this->get_field_name( 'receiver-twitter-username' ); ?>" type="text" value="<?php echo esc_attr( $instance['receiver-twitter-username'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'label' ); ?>"><?php esc_html_e( 'Tips Button Label:', 'xrptipbot-widget' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'label' ); ?>" name="<?php echo $this->get_field_name( 'label' ); ?>" type="text" value="<?php echo esc_attr( $instance['label'] ); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thank-you-message' ); ?>"><?php esc_html_e( 'Thank You Message:', 'xrptipbot-widget' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'thank-you-message' ); ?>" name="<?php echo $this->get_field_name( 'thank-you-message' ); ?>" type="text" value="<?php echo esc_attr( $instance['thank-you-message'] ); ?>"/>
		</p>

	<?php
	}
}
