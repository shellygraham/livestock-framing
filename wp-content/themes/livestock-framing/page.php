<?php
get_header();
if ( $livestock_components->display_default_content() ) { get_template_part( 'parts/part', 'standard-page' ); }
$livestock_components->the_components( $post );
get_footer();