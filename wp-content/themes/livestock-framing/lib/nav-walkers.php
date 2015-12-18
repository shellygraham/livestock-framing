<?php

class Walker_Bootstrap extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth ) {
		$indent = str_repeat( "\t", $depth );
		$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		if (strcasecmp($item->title, 'divider')) {
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = ($item->current) ? 'active' : '';
			$classes[] = 'menu-item-' . $item->ID;
			$classes[] = $item->post_name;

			// echo '<pre>' . print_r( $args, 1 ) . '</pre>';

			if ( $depth == 0 && $args->walker->has_children ) {
				$classes[] = ' dropdown';
			}

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' onclick="_gaq.push([ \'_trackEvent\', \'Navigation\', \'' . str_replace( '\'', '’', $item->post_title ) . '\' ]);"' : '';
			if ( $depth == 0 ) $attributes .= ( $args->walker->has_children )  ? ' data-toggle="dropdown" class="dropdown-toggle"' : '';

			$prepend = '<span>';
			if ( $depth == 0 ) $append = ( $args->walker->has_children ? ' <i class="fa fa-caret-down" data-expanded="fa fa-caret-up" data-collapsed="fa fa-caret-up"></i>' : null ) . '</span>';

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . $prepend . apply_filters( 'the_title', $item->title, $item->ID ) . $append . $args->link_after . '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		} else {
			$output .= $indent . '<li class="divider"></li>';
		}
	}
}
