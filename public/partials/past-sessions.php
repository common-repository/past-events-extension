<?php
/**
 * The past-sessions public page
 *
 * @link       https://datamad.co.uk
 * @since      1.0.0
 *
 * @package    Past_Events_Extension
 * @subpackage Past_Events_Extension/public
 */

get_header();

$args = array(
	'post_type'   => array( 'session' ),
	'post_status' => array( 'past-session' ),
	'orderby'     => 'menu_order',
	'order'       => 'ASC',
	'posts_per_page' => -1,
);
$query = new WP_Query( $args );

while ( $query->have_posts() ) : $query->the_post();
	$meta = get_post_meta( get_the_ID() );
	$past_session_markup = Past_Events_Extension_Public::get_past_sessions_markup( $meta );
	echo $past_session_markup;
endwhile;

wp_reset_postdata();

get_footer();
