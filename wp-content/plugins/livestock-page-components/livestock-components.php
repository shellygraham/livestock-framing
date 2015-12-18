<?php
/*
Plugin Name: Livestock Components
Description: Allows 'components' to be embedded into a page.
Version: 1.0
Author: Joey Yax @ Grady Britton
Author URI: http://gradybritton.com
*/


if ( ! class_exists( 'Livestock_Components' ) ) {
	class Livestock_Components {
		private $nicename = 'livestock_components';

		function __construct() {

			// settings submenu
			add_action( 'admin_menu', array( $this, 'mk_submenu' ) );

			// metaboxes
			wp_register_script( $this->nicename . '-page-script', plugins_url( '/metabox/assets/js.js', __FILE__ ) );
			wp_register_style( $this->nicename . '-page-style', plugins_url( '/metabox/assets/css.css', __FILE__ ) );
			add_action( 'add_meta_boxes', array( $this, 'mk_meta_box' ) ); // create
			add_action( 'save_post',  array( $this, 'metabox_save' ) ); // save

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
			add_meta_box( $this->nicename . '_metabox', 'Components', array( $this, 'metabox_content' ), 'page', 'normal', 'high' );
		}

		public function metabox_content() {
			global $post;

			// custom fields
			$custom = get_post_custom( $post->ID );
			$sections = unserialize( $custom["sections"][0] );
			$options = unserialize( $custom["options"][0] );

			// template
			include_once( plugin_dir_path(__FILE__) . 'metabox/metabox.php' );

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

			wp_localize_script( $this->nicename . '-page-script', $this->nicename, $localized_data );

			// styles
			wp_enqueue_style( $this->nicename . '-page-style' );

			// scripts
			wp_enqueue_script( 'jquery' );
			wp_enqueue_media();
			wp_enqueue_script( $this->nicename . '-page-script' );
		}

		public function metabox_save() {
			global $post;

			// Do nothing on auto save.
			if ( defined( 'DOING_AUTOSAVE' ) && true === DOING_AUTOSAVE ) { return; }

			// Save post meta.
			update_post_meta( $post->ID, "sections", $_POST["sections"] );
			update_post_meta( $post->ID, "options", $_POST["options"] );
		}

		public function get_path() {
			return plugins_url( null, __FILE__ );
		}

		public function the_components( $post ) {

			$custom = get_post_custom( $post->ID );
			$sections = unserialize( $custom['sections'][0] );
			$options = unserialize( $custom['options'][0] );

			if ( $sections && is_array( $sections ) && count( $sections ) > 0 ) {
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

						include( locate_template( 'parts/part-' . $id . '.php' ) );
					}
					else {
						echo 'no type!';
					}
				endforeach;
			}
			else {
				return null;
			}
		}

		public function get_admin_section( ) {

			// check auth
			if( !is_user_logged_in() ) return false;

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
			$dir    = get_theme_root() . '/' . get_template() . '/parts';
			$files = scandir( $dir );
			foreach( $files as $file ) {
				if ( preg_match( "/^part\-[(A-Za-z0-9+)]/", $file ) ) {

					$component_slug = str_replace( 'part-', '', $file );
					$component_slug = str_replace( '.php', '', $component_slug );

					// read the header data
					$headers = array(
						// 'filename' 		=> $file,
						'name'				=> 'Component Name',
						'description'		=> 'Component Description'
					);

					$component_data = get_file_data( get_theme_root() . '/' . get_template() . '/parts/' . $file, $headers, 'plugin' );
					$component_data['slug'] = $component_slug; // add applicable filebane to component data
					$component_data['filename'] = $file; // add raw filename to component data

					// if no name is defined, skip it.
					if ( $component_data['name'] == '' ) continue;

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

		public function display_default_content() {
			global $post;
			$custom = get_post_custom( $post->ID );
			$options = unserialize( $custom['options'][0] );
			$default = ( $options['x']['default_page_content'][0] == 1 ? false : true );
			return $default;
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

	$livestock_components = new Livestock_Components();
}
else {
	throw new Exception( 'The Livestock Components plugin is already active.' );
}
