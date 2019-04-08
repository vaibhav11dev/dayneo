<?php
    /**
     * daydream_Walker_Nav_Menu
     */
    class Daydream_Walker_Nav_Menu extends Walker_Nav_Menu {
	    /**
	     * @see   Walker::start_el()
	     * @since 1.0.0
	     *
	     * @param string $output       Passed by reference. Used to append additional content.
	     * @param object $item         Menu item data object.
	     * @param int    $depth        Depth of menu item. Used for padding.
	     * @param int    $current_page Menu item ID.
	     * @param object $args
	     */
	    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		    /**
		     * Dividers, Headers or Disabled
		     * =============================
		     * Determine whether the item is a Divider, Header, Disabled or regular
		     * menu item. To prevent errors we use the strcasecmp() function to so a
		     * comparison that is not case sensitive. The strcasecmp() function returns
		     * a 0 if the strings are equal.
		     */
		    $class_names	 = $value		 = '';

		    $classes	 = empty( $item->classes ) ? array() : (array) $item->classes;
		    $classes[]	 = 'menu-item-' . $item->ID;

		    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		    if ( $args->has_children ) {
			    $class_names .= ' has-submenu';
		    }

		    if ( in_array( 'current-menu-item', $classes ) ) {
			    $class_names .= ' active';
		    }

		    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		    $id	 = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		    $id	 = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		    $output .= $indent . '<li' . $id . $value . $class_names . '>';

		    /**
		     * 
		     * PolyLang Broken Flag Images
		     * ===========================
		     *
		     */
		    $item->title_2 = $item->title; // Let's take flag image
		    if ( class_exists( 'Polylang' ) ) {
			    if ( preg_match( '/<img src=/', $item->title ) ) {
				    $item->title = strip_tags( $item->title ); // Let's remove flag image
			    }
		    }

		    $atts		 = array();
		    $atts[ 'title' ]	 = ! empty( $item->title ) ? $item->title : '';
		    $atts[ 'target' ]	 = ! empty( $item->target ) ? $item->target : '';
		    $atts[ 'rel' ]	 = ! empty( $item->xfn ) ? $item->xfn : '';
		    $atts[ 'href' ]	 = ! empty( $item->url ) ? $item->url : '';


		    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		    $attributes = '';
		    foreach ( $atts as $attr => $value ) {
			    if ( ! empty( $value ) ) {
				    $value		 = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				    $attributes	 .= ' ' . $attr . '="' . $value . '"';
			    }
		    }

		    $item_output = $args->before;

		    /*
		     * Glyphicons
		     * ===========
		     * Since the the menu item is NOT a Divider or Header we check the see
		     * if there is a value in the attr_title property. If the attr_title
		     * property is NOT null we apply it as the class name for the glyphicon.
		     */
		    if ( daydream_get_option( 'dd_main_menu_hover_effect', 'rollover' ) == 'disable' ) {
			    $item_output .= '<a' . $attributes . '>';
		    } else {
			    $item_output .= '<a' . $attributes . '><span data-hover="' . $item->title . '">';
		    }

		    $item_output	 .= $args->link_before . apply_filters( 'the_title', $item->title_2, $item->ID ) . $args->link_after;
		    $item_output	 .= ( $args->has_children && 0 === $depth ) ? ' <span class="arrow"></span>' : '';
		    if ( daydream_get_option( 'dd_main_menu_hover_effect', 'rollover' ) == 'disable' ) {
			    $item_output .= '</a>';
		    } else {
			    $item_output .= '</span></a>';
		    }
		    $item_output .= $args->after;

		    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	    }

	    /**
	     * Traverse elements to create list from elements.
	     * Display one element if the element doesn't have any children otherwise,
	     * display the element and its children. Will only traverse up to the max
	     * depth and no ignore elements under that depth.
	     * This method shouldn't be called directly, use the walk() method instead.
	     *
	     * @see   Walker::start_el()
	     * @since 2.5.0
	     *
	     * @param object $element           Data object
	     * @param array  $children_elements List of elements to continue traversing.
	     * @param int    $max_depth         Max depth to traverse.
	     * @param int    $depth             Depth of current element.
	     * @param array  $args
	     * @param string $output            Passed by reference. Used to append additional content.
	     *
	     * @return null Null on failure with no changes to parameters.
	     */
	    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		    if ( ! $element ) {
			    return;
		    }

		    $id_field = $this->db_fields[ 'id' ];

		    // Display this element.
		    if ( is_object( $args[ 0 ] ) ) {
			    $args[ 0 ]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		    }

		    parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	    }

    }