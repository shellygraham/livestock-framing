<?php
/*
Plugin Name: Clean Energy Works Inline Pages
Description: Adds metabox to pages so children pages can be set to be displayed inline
Version: 1.0
Author: Joey Yax @ Grady Britton
Author URI: http://gradybritton.com
*/


if ( ! class_exists( 'CEW_Inline_Pages' ) ) {
	class CEW_Inline_Pages {
		private $nicename = 'cewip';

		function __construct() {

			// settings submenu
			add_action( 'admin_menu', array( $this, 'mk_submenu' ) );

			// metaboxes
			wp_register_script( $this->nicename . '-page-script', plugins_url( '/metaboxes/parent/assets/js.js', __FILE__ ) );
			wp_register_style( $this->nicename . '-page-style', plugins_url( '/metaboxes/parent/assets/css.css', __FILE__ ) );
			add_action( 'add_meta_boxes', array( $this, 'mk_meta_box' ) ); // create
			add_action( 'save_post',  array( $this, 'metabox_parent_save' ) ); // save

			// custom columns
			add_filter( 'manage_edit-' . $this->nicename . '_columns', array( $this, 'custom_columns' ) ); // create
			add_action( 'manage_' . $this->nicename . '_posts_custom_column', array( $this, 'columns_output' ), 1000, 2 ); // output

			// hooks for ajax
			add_action( 'wp_ajax_' . $this->nicename . '_get_section', array( $this, 'get_admin_section' ) );
			add_action( 'wp_ajax_nopriv_' . $this->nicename . '_get_section', array( $this, 'get_admin_section_nopriv' ) );
			add_action( 'wp_ajax_' . $this->nicename . '_get_section_options', array( $this, 'get_admin_section_options' ) );
			add_action( 'wp_ajax_nopriv_' . $this->nicename . '_get_section_options', array( $this, 'get_admin_section_options_nopriv' ) );
		}

		// create submenu
		public function mk_submenu() {
			add_submenu_page(
      	'options-general.php', // parent
        'Components', // page title
        'Components', // menu title
        'manage_options', // capability
        'components-settings', // menu slug
        array( $this, 'components_settings_content' ) // content
    	);
		}

		public function components_settings_content() {

			include_once( plugin_dir_path( __FILE__ ) . 'submenus/settings/settings.php' );

		}

		// create meta box
		public function mk_meta_box() {
			global $post;
			if ( $post->post_parent == 0 ) {
				add_meta_box( $this->nicename . '_inline_pages', 'Inline Pages', array( $this, 'metabox_parent_content' ), 'page', 'normal', 'high' );
			}
			add_meta_box( $this->nicename . '_inline_pages', 'Inline Pages', array( $this, 'metabox_parent_content' ), 'cew_services', 'normal', 'high' );
		}

		public function metabox_parent_content() {
			global $post;

			// custom fields
			$custom = get_post_custom( $post->ID );
			$sections = unserialize( $custom["sections"][0] );
			$options = unserialize( $custom["options"][0] );

			// template
			include_once( plugin_dir_path(__FILE__) . 'metaboxes/parent/parent.php' );

			// inject selections
			$nonce = wp_create_nonce( $this->nicename . '_get_section' );
			$url = admin_url( 'admin-ajax.php' );
			$data = 'action=' . $this->nicename . '_get_section&post_id=' . $post->ID . '&nonce=' . $nonce;

			$localized_data = array(
				'sections' => $sections,
				'url' => $url,
				'url_data' => $data,
				'post_id' => $post->ID,
				'options' => $options
			);

			wp_localize_script( $this->nicename . '-page-script', $this->nicename . '_properties', $localized_data );

			// styles
			wp_enqueue_style( $this->nicename . '-page-style' );

			// scripts
			wp_enqueue_script( 'jquery' );
			wp_enqueue_media();
			wp_enqueue_script( $this->nicename . '-page-script' );
		}

		public function metabox_parent_save() {
			global $post;

			// Do nothing on auto save.
			if ( defined( 'DOING_AUTOSAVE' ) && true === DOING_AUTOSAVE ) { return; }

			// Save post meta.
			update_post_meta( $post->ID, "sections", $_POST["sections"] );
			update_post_meta( $post->ID, "options", $_POST["options"] );
		}

		// columns
		public function custom_columns() {
			$columns['cb'] = '<input type="checkbox" />';
			$columns['photo'] = _x('Photo');
			$columns['title'] = _x('Title');
	    $columns['types'] = _x('Type(s)');
	    $columns['locations'] = _x('Location(s)');
	    $columns['date'] = _x('Date', 'column name');

	    return $columns;
		}

		public function columns_output( $column ) {
			global $post;

			$custom = get_post_custom( $post->ID );

			switch( $column ) {
				case 'photo':
					$photo = $custom["photo"][0];
					echo ( $photo != '' ? '<div class="overflow"><img src="' . $photo . '" alt="" title="" /></div>' : '<span style="color: #a00;">Not defined</span>' );
					echo '<style>.column-photo{ width: 100px; } .column-photo img{ width: 100px; } .overflow{ display: block; margin: 0; padding: 0; width: 100%; height: 100px; overflow: hidden; }</style>';
					break;
				case 'types':
					$types = wp_get_post_terms( $post->ID, $this->nicename . '_type' );
					foreach( $types as $type ) $names[] = $type->name;
					echo implode( ', ', $names );
					break;
				case 'locations':
					$locations = wp_get_post_terms( $post->ID, $this->nicename . '_location' );
					foreach( $locations as $location ) $names[] = $location->name;
					echo implode( ', ', $names );
					break;
			}
		}

		public function get_path() {
			return plugins_url( null, __FILE__ );
		}

		public function the_inline_sections( $post ) {

			$custom = get_post_custom( $post->ID );
			$sections = unserialize( $custom['sections'][0] );
			$options = unserialize( $custom['options'][0] );

			foreach( $sections as $key => $section ) :

				// split section data | type:id
				$parts = explode( ':', $section );
				$type = $parts[0];
				$id = $parts[1];

				if ( $type == 'page' ) {
					$section_options = $options[$key];

					wp_reset_postdata();
					wp_reset_query();

					$post = get_page( $id );
					setup_postdata( $post );

					$page_template = get_post_meta( $post->ID, '_wp_page_template', true );

					if ( $page_template != '' && $page_template != 'default' ) {
						$page_template = str_replace( 'templates/template-', '', $page_template ); // remove prefix
						$page_template = str_replace( '.php', '', $page_template ); // remove prefix
						$parent_id = $post->ID;
					}
					else {
						$page_template = 'page';
					}

					include( locate_template( 'parts/part-' . $page_template . '.php' ) ); // get_template_part( 'part', $page_template ); doesn't pass vars
				}
				else if ( $type == 'component' ) {
					$section_options = $options[$key];

					include( locate_template( 'components/component-' . $id . '.php' ) );
				}
				else {
					echo 'no type!';
				}
			endforeach;

			// echo '<pre>' . print_r( $pages, 1 ) . '</pre>';
		}

		public function get_admin_section( ) {

			// check auth
			if( !is_user_logged_in() ) return false;

			// make sure this is an ajax request
			// **

			// get ajax params
			$params = $_GET;

			// parse params
			if ( is_array( $params ) ) {
				// allowed atts
				$allowed = array( 'action', 'post_id', 'nonce', 'type', 'id', 'index' );

				// discard unexpected atts
				foreach( $params as $key => $param ) {
					if ( ! in_array( strtolower($key), $allowed ) ) {
						unset( $params[$key] );
					}
				}
			}

			// get children pages
			$pages = get_pages( array(
				'parent' => $params['post_id'],
				'sort_column' => 'menu_order'
			) );

			if ( count( $pages ) > 0 ) {
				$pages_output = '<optgroup label="Child Pages">';
				foreach( $pages as $page ) {
			    $pages_output.= '<option value="page:' . $page->ID . '" ' .  ( $params['type'] == 'page' && $params['id'] == $page->ID ? 'selected' : null ) . '>' . $page->post_title . '</option>';
			  }
				$pages_output.= '</optgroup>';
			}
			else {
			 $pages = null;
			}

			$components = $this->get_components();

			$components_output = '<optgroup label="Component">';
			foreach( $components as $component ) {
				$components_output.= '<option value="component:' . $component['slug'] . '" ' .  ( $params['type'] == 'component' && $params['id'] == $component['slug'] ? 'selected' : null ) . '>' . $component['name'] . '</option>';
			}
			$components_output.= '</optgroup>';

			$output = '<li class="section" id="' . uniqid( $this->nicename, true ) . '">
				<div class="row">
					<div class="handle"><i class="fa fa-bars"></i></div>
					<div class="title">
						<select name="sections[]" style="width: 50%">
							<option value="">-- Select --</option>
							' . $pages_output . '
							' . $components_output . '
						</select>
						<a class="action action-remove"><i class="fa fa-times"></i></a>
						<a class="action action-toggle"><i class="fa fa-chevron-down flip"></i></a>
					</div>
					<div class="options-toggle"></div>
				</div>
				<div class="row">
					<div class="options">
						Select a component above. If it has options they will appear here.
					</div>
				</div>
			</li>';

			echo $output;
			die();
		}

		public function get_admin_section_nopriv() {
			echo 'You need to be signed in to do that.';
		}

		public function get_admin_section_options( $section_id=null ) {

			// check auth
			if( !is_user_logged_in() ) return 'You need to be signed in to do that.';

			$get = $_GET;

			$index = $get['index'];

			$post = get_post( $get['post_id'] );
			$custom = get_post_custom( $get['post_id'] );
			$options = unserialize( $custom['options'][0] );

			$template = dirname( __FILE__ ) . '/components/' . $get['section_name'] . '.php';

			if ( file_exists( $template ) ) {
				include( $template );
			}
			else {
				echo 'No options';
			}

			die();
		}

		public function get_admin_section_options_nopriv() {
			echo 'not allowed';
		}

		public function get_components() {
			// get available components
			$dir    = get_theme_root() . '/' . get_template() . '/components';
			$files = scandir( $dir );
			foreach( $files as $file ) {
				if ( preg_match( "/^component\-[(A-Za-z0-9+)]/", $file ) ) {

					$component_slug = str_replace( 'component-', '', $file );
					$component_slug = str_replace( '.php', '', $component_slug );

					// read the header data
					$headers = array(
						// 'filename' 		=> $file,
						'name'				=> 'Component Name',
						'description' => 'Component Description'
					);

					$component_data = get_file_data( get_theme_root() . '/' . get_template() . '/components/' . $file, $headers, 'plugin' );
					$component_data['slug'] = $component_slug; // add applicable filebane to component data
					$component_data['filename'] = $file; // add raw filename to component data

					$components[] = $component_data;
				}
			}

			return $components;
		}

		public function open_component_container( $name, $value ) {

			echo '<div class="has-dependency" data-dependency="' . $name . '" data-dependency-value="' . $value . '">';

		}

		public function close_component_container() {

			echo '</div>';

		}

		public function the_component_field( $args ) {

			$required = array( 'index', 'post_id', 'name' );
			foreach( $required as $req ) {
				if ( !isset( $args[$req] ) ) { echo '<p style="color: #a00;"><strong>Missing attribute: ' . $req . '</strong>. Cannot generate field.</p>'; return false; }
			}

			$defaults = array(
				'index' => null, // required
				'post_id' => null, // required
				'type' => 'input', // accepts: input, checkbox, radio select, textarea
				'available_options' => array(), // used for checkbox and select
				'value' => null,
				'name' => null,
				'label' => null,
				'classes' => '',
				'helptext' => null,
				'dependency' => null
			);
			foreach( array_merge( (array)$defaults, (array)$args ) as $k => $v ) { $$k = $v; }


			// get field values
			$custom = get_post_custom( $post_id );
			$options = unserialize( $custom['options'][0] );

			$has_dependency =  ( $dependency != null && is_array( $dependency ) && count( $dependency ) == 2 ? true : false );

			// field markup
			$output = '<div class="field ' . ( $has_dependency ? 'has-dependency' : null ) . '" data-dependency="' . $dependency[0] . '" data-dependency-value="' . $dependency[1] . '">';
			switch( $type ) {
				case 'input':
				$output.= ( $label != null ? '<label>' . $label . '</label>' : null );
				$output.= '<input class="' . $name . ' ' . $classes . '" name="options[' . $index . '][' . $name . ']" value="' . ( $options[$index][$name] === null ? ( $value ? $value : null ) : esc_attr( $options[$index][$name] ) ) . '" />';
				break;
				case 'url':
				$output.= ( $label != null ? '<label>' . $label . '</label>' : null );
				$output.= '<input class="' . $name . ' ' . $classes . '" name="options[' . $index . '][' . $name . ']" value="' . ( $options[$index][$name] === null ? ( $value ? $value : null ) : esc_url( $options[$index][$name] ) ) . '" />';
				break;
				case 'upload':
				$output.= ( $label != null ? '<label>' . $label . '</label>' : null );
				$output.= '<input class="' . $name . ' ' . $classes . '" id="' . $name . '" name="options[' . $index . '][' . $name . ']" value="' . ( $options[$index][$name] === null ? ( $value ? $value : null ) : $options[$index][$name] ) . '" />';
				$output.= '<a class="button button-upload" href="#" data-uploader-title="' . $label . '" data-uploader-button-text="Insert" data-input-field="options[' . $index . '][' . $name . ']">Upload / Select</a>';
				break;
				case 'textarea':
				$output.= ( $label != null ? '<label>' . $label . '</label>' : null );
				$output.= '<textarea class="' . $name . ' ' . $classes . '" id="' . $name . '" name="options[' . $index . '][' . $name . ']">' . ( $options[$index][$name] === null ? ( $value ? $value : null ) : $options[$index][$name] ) . '</textarea>';
				break;
				case 'checkbox':
				if ( is_array( $available_options ) && !empty( $available_options ) ) {
					$value = ( $options[$index][$name] === null ? ( $value ? $value : null ) : $options[$index][$name] );
					$output.= ( $label != null ? '<label>' . $label . '</label>' : null );
					foreach( $available_options as $key => $option ) {
						$output.= '<label class="checkbox">';
						$output.= '<input type="checkbox" class="' . $name . ' ' . $classes . '" id="' . $name . '" name="options[' . $index . '][' . $name . '][]" value="' . $key . '" ' . ( in_array( $key, $value ) ? 'checked' : null ) . '>';
						$output.= $option;
						$output.= '</label>';
					}
					unset( $value );
				}
				break;
				case 'radio':
				if ( is_array( $available_options ) && !empty( $available_options ) ) {
					$value = ( $options[$index][$name] === null ? ( $value ? $value : null ) : $options[$index][$name] );
					$output.= ( $label != null ? '<label>' . $label . '</label>' : null );
					foreach( $available_options as $key => $option ) {
						$output.= '<label class="checkbox">';
						$output.= '<input type="radio" class="' . $name . ' ' . $classes . '" id="' . $name . '" name="options[' . $index . '][' . $name . ']" value="' . $key . '" ' . ( $value == $key ? 'checked' : null ) . '>';
						$output.= $option;
						$output.= '</label>';
					}
					unset( $value );
				}
				break;
				case 'select':
				if ( is_array( $available_options ) && !empty( $available_options ) ) {
					$value = ( $options[$index][$name] === null ? ( $value ? $value : null ) : $options[$index][$name] );
					$output.= ( $label != null ? '<label>' . $label . '</label>' : null );
					$output.= '<select class="' . $name . ' ' . $classes . '" id="' . $name . '" name="options[' . $index . '][' . $name . ']">';
					foreach( $available_options as $key => $option ) {
						$output.= '<option value="' . $key . '" ' . ( $value == $key ? 'selected' : null ) . '>' . $option . '</option>';
					}
					$output.= '</select>';
					unset( $value );
				}
				break;
			}
			$output.= ( $helptext != null ? '<div class="help-text">' . esc_attr( $helptext ) . '</div>' : null );
			$output.= '</div>';

			echo $output;

		}
	}

	$cewip = new CEW_Inline_Pages();
}
else {
	throw new Exception( 'Clean Energy Works Inline Pages plugin is already active.' );
}
