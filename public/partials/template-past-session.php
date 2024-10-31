<?php
/**
 * Template Name: Past Session
 *
 * @link       https://datamad.co.uk
 * @since      1.0.0
 *
 * @package    Past_Events_Extension
 * @subpackage Past_Events_Extension/public
 */

get_header();

while (have_posts()) : the_post();
	$meta = get_post_meta( get_the_ID() );
	$past_session_markup = Past_Events_Extension_Public::get_past_sessions_markup( $meta, true );
	echo $past_session_markup;
endwhile;

get_footer();
