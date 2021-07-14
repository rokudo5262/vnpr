<?php

//Secure file from direct access
if (!defined('WPINC')) {
	die;
}

//Remove original canonical
if (function_exists('rel_canonical')) {
	remove_action('wp_head', 'rel_canonical');
}

//Remove Jatpack Open graph
add_filter('jetpack_enable_open_graph', '__return_false');

//Remove canonical Yoast Seo
add_filter('wpseo_canonical', '__return_false');
//Remove canonical All in one SEO
add_filter('aioseop_canonical_url', '__return_false');


add_filter('document_title_parts', 'pc_override_post_title', 10);
function pc_override_post_title($title)
{

	if (is_singular('page') and isset($_GET['contest']) and $_GET['contest'] == 'photo-detail') {
		// change title for singular blog post
		$photo_id = $_GET['photo_id'];
		$photo = get_post($photo_id);
		// change title parts here
		$title['title'] = $photo->post_title;
		//$title['page'] = '2'; // optional
		$title['tagline'] = __('Photo Contest', 'photo-contest'); // optional
		$title['site'] = get_bloginfo("name"); //optional
	}

	return $title;
}

function contest_yoast_filter($title)
{
	global $post;
	if (has_shortcode($post->post_content, 'contest-page')) {

		if (isset($_GET['contest'])) {
			if ($_GET['contest'] == 'photo-detail') {

				$photo_id = $_GET['photo_id'];
				$photo = get_post($photo_id);
				$current_page_id = get_the_ID();
				$tagline = get_the_title($current_page_id); // optional

				$title = $photo->post_title . ' - ' . $tagline . ' - ' . get_bloginfo("name");
			}
		}
	}
	return $title;

}

add_filter('wpseo_title', 'contest_yoast_filter');


function remove_all_in_one_title($title)
{
	global $post;

	if (has_shortcode($post->post_content, 'contest-page')) {

		if (isset($_GET['contest'])) {
			if ($_GET['contest'] == 'photo-detail') {

				$photo_id = $_GET['photo_id'];
				$photo = get_post($photo_id);
				$current_page_id = get_the_ID();
				$tagline = get_the_title($current_page_id); // optional

				$title = $photo->post_title . ' - ' . $tagline . ' - ' . get_bloginfo("name");
			}
		}
	}
	return $title;
}

add_filter('aioseop_title', 'remove_all_in_one_title', 1);

function remove_all_in_one_desc($desc)
{
	global $post;
	if (has_shortcode($post->post_content, 'contest-page')) {

		if (isset($_GET['contest'])) {
			if ($_GET['contest'] == 'photo-detail') {
				return false;
			}
		}
	}

}

add_filter('aioseop_description', 'remove_all_in_one_desc', 1);


function add_contest_og_meta()
{
	if (is_singular('page') and isset($_GET['contest']) and $_GET['contest'] == 'photo-detail') {
		$photo_id = $_GET['photo_id'];
		$photo = get_post($photo_id);
		$title = $photo->post_title;
		$image_attributes = wp_get_attachment_image_src($photo_id, 'gallery-middle');
		$all_attachments_id = [];
		$current_url = get_permalink();
		$ogurl = add_query_arg([
			'contest' => 'photo-detail',
			'photo_id' => $_GET['photo_id']
		], $current_url);
		echo '' . "\n";
		echo '<!--Photo Contest Meta -->' . "\n";
		echo '<meta property="og:title" content="' . $title . '" />' . "\n";
		echo '<meta property="og:type" content="article" />' . "\n";
		echo '<meta property="og:image" content="' . $image_attributes[0] . '" />' . "\n";
		echo '<meta property="og:image:width" content="350" />' . "\n";
		echo '<meta property="og:image:height" content="350" />' . "\n";
		echo '<meta property="og:url" content="' . $ogurl . '" />' . "\n";
		if (!empty($photo->post_content)) {
			echo '<meta property="og:description" content="' . strip_tags($photo->post_content) . '" />' . "\n";
		}
		echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '" />' . "\n";
		echo '<!--Photo Contest Meta -->' . "\n";


	}// Facebook Open Graph End
}

add_action('wp_head', 'add_contest_og_meta');

// A copy of rel_canonical but to allow an override on a custom tag
function pc_rel_canonical_with_custom_tag_override()
{
	if (isset ($_GET['contest']) and isset($_GET['photo_id'])) {
		if (!is_singular())
			return;

		global $wp_the_query;
		if (!$id = $wp_the_query->get_queried_object_id())
			return;

		// check whether the current post has content in the "canonical_url" custom field
		$canonical_url = get_post_meta($id, 'canonical_url', true);
		if ('' != $canonical_url) {
			// trailing slash functions copied from http://core.trac.wordpress.org/attachment/ticket/18660/canonical.6.patch
			$link = user_trailingslashit(trailingslashit($canonical_url));
		} else {
			$link = get_permalink($id);
		}
		echo "\n<link rel='canonical' href='" . esc_url($link) . "?contest=photo-detail&photo_id=" . $_GET['photo_id'] . "' />\n";
	}
}

// replace the default WordPress canonical URL function with your own
add_action('wp_head', 'pc_rel_canonical_with_custom_tag_override');

//Remove yoast SEO Open Graph
add_action('wp_head', 'remove_all_wpseo_og', 1);
function remove_all_wpseo_og()
{
	global $post;
	if (has_shortcode($post->post_content, 'contest-page')) {
		if (isset($GLOBALS['wpseo_og'])) {
			remove_action('wpseo_head', [$GLOBALS['wpseo_og'], 'opengraph'], 30);
		}
	}
}

?>
