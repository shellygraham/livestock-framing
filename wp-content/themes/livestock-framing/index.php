<?php
global $livestock_page_properties;
// get blog page data
$blog_page_id = get_option( 'page_for_posts' );
$blog_page = get_page( $blog_page_id );
get_header();
if ( $livestock_components->display_default_content() ) {
	get_template_part( 'parts/part', 'blog-header' );
}
get_template_part( 'parts/part', 'blog-posts' );
$livestock_components->the_components( $blog_page );
get_footer();