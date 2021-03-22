<?php
/*======
*
* Create Social Media Links for User Profiles
*
======*/
if( !function_exists( 'eventchamp_user_profile_social_media' ) ) {

	function eventchamp_user_profile_social_media( $user_profile_create_fields ) {

		$user_profile_create_fields['facebook'] = esc_html__( 'Facebook', 'eventchamp' );
		$user_profile_create_fields['instagram'] = esc_html__( 'Instagram', 'eventchamp' );
		$user_profile_create_fields['linkedin'] = esc_html__( 'LinkedIn', 'eventchamp' );
		$user_profile_create_fields['vine'] = esc_html__( 'Vine', 'eventchamp' );
		$user_profile_create_fields['twitter'] = esc_html__( 'Twitter', 'eventchamp' );
		$user_profile_create_fields['pinterest'] = esc_html__( 'Pinterest', 'eventchamp' );
		$user_profile_create_fields['youtube'] = esc_html__( 'YouTube', 'eventchamp' );
		$user_profile_create_fields['behance'] = esc_html__( 'Behance', 'eventchamp' );
		$user_profile_create_fields['deviantart'] = esc_html__( 'DeviantArt', 'eventchamp' );
		$user_profile_create_fields['digg'] = esc_html__( 'Digg', 'eventchamp' );
		$user_profile_create_fields['dribbble'] = esc_html__( 'Dribbble', 'eventchamp' );
		$user_profile_create_fields['flickr'] = esc_html__( 'Flickr', 'eventchamp' );
		$user_profile_create_fields['github'] = esc_html__( 'GitHub', 'eventchamp' );
		$user_profile_create_fields['lastfm'] = esc_html__( 'Last.fm', 'eventchamp' );
		$user_profile_create_fields['reddit'] = esc_html__( 'Reddit', 'eventchamp' );
		$user_profile_create_fields['soundcloud'] = esc_html__( 'SoundCloud', 'eventchamp' );
		$user_profile_create_fields['tumblr'] = esc_html__( 'Tumblr', 'eventchamp' );
		$user_profile_create_fields['vimeo'] = esc_html__( 'Vimeo', 'eventchamp' );
		$user_profile_create_fields['vk'] = esc_html__( 'VK', 'eventchamp' );
		$user_profile_create_fields['medium'] = esc_html__( 'Medium', 'eventchamp' );

		return $user_profile_create_fields;

	}
	add_filter( 'user_contactmethods', 'eventchamp_user_profile_social_media', 10, 1 );

}