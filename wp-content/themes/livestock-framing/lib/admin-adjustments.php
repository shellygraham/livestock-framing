<?php

/*
 * ==========================================================================================
 * Disabled unnecessary default dashboard widgets
 * ==========================================================================================
 */
function disable_default_dashboard_widgets() {
	// remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

	// removing plugin dashboard boxes
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget

}
add_action('admin_menu', 'disable_default_dashboard_widgets');


/*
 * ==========================================================================================
 * Remove Parts of WP we don't need
 * ==========================================================================================
 */
add_action( 'admin_menu', 'remove_admin_menus' );
add_action( 'wp_before_admin_bar_render', 'remove_toolbar_menus' );

function remove_admin_menus() {
    // remove_menu_page( 'edit.php' ); // Posts
    remove_menu_page( 'edit-comments.php' ); // Comments
}

function remove_toolbar_menus() {
    global $wp_admin_bar;
    // echo '<pre>' . print_r( $wp_admin_bar, 1 ) . '</pre>';
    $wp_admin_bar->remove_menu( 'wp-logo' ); // remove wp logo from admin bar
    $wp_admin_bar->remove_menu( 'new-post' ); // remove new post from admin bar
    $wp_admin_bar->remove_menu( 'comments' ); // remove comments indicator from admin bar
}

add_action('admin_footer', function(){
    ?>
    <script>
    	;(function( $ ) {
			$( '#dashboard_right_now .posts, #dashboard_right_now .cats, #dashboard_right_now .tags' ).parent().remove();
			$( '#dashboard_right_now .table_discussion' ).remove();
    	})(jQuery);
    </script>
    <?php
});

/*
 * ==========================================================================================
 * Add custom styles to TinyMCE
 * ==========================================================================================
 */
// if ( ! function_exists('entek_tinymce_css') ) {
//     function entek_tinymce_css( $wp ) {
//         echo $wp ;
//         $wp .= ',' . get_bloginfo( 'template_directory' ) . '/assets/css/compiled.min.css';
//         return $wp;
//     }
// }

// add_filter( 'mce_css', 'cleene_tinymce_css' );
