<?php
/*======
*
* Menus
*
======*/
register_nav_menus( 
	array(
		'mainmenu' => esc_html__( 'Main Menu', 'eventchamp' ),
		'onepagemenu' => esc_html__( 'Alternative Menu', 'eventchamp' ),
		'footermenu' => esc_html__( 'Footer Menu', 'eventchamp' ),
	)
);



/*======
*
* Menu Walker
*
======*/
if( !class_exists( 'eventchamp_walker' ) ) {

	class eventchamp_walker extends Walker_Nav_Menu {

		public function start_lvl( &$output, $depth = 0, $args = array() ) {

			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role=\"menu\" class=\" gt-dropdown-menu\">\n";

		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$li_attributes = '';
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			if ($args->has_children){
				$classes[] 		= 'dropdown';
				$li_attributes .= ' data-dropdown="dropdown"';
			}
			$classes[] = 'menu-item-' . $item->ID;
			$classes[] = ($item->current) ? 'active' : '';

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="nav-item ' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

			$attributes = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn ) .'"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
			$attributes .= ! empty( $item->url ) ? ' class="nav-link"' : '';
			$attributes .= ($args->has_children) ? ' ' : ''; 

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before;
				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
			$item_output .= ($args->has_children) ? '<svg class="gt-caret" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>' : '';
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}

		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

			if ( ! $element )
				return;
				$id_field = $this->db_fields['id'];

			// Display this element.
			if ( is_object( $args[0] ) )
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
				parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

		}

	}

}