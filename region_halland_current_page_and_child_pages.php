<?php

	/**
	 * @package Region Halland Current Page and Child Pages
	 */
	/*
	Plugin Name: Region Halland Current Page and Child Pages
	Description: Front-end-plugin som returnerar aktuell sida + alla barn-sidor
	Version: 1.0.0
	Author: Roland Hydén
	License: MIT
	Text Domain: regionhalland
	*/

	// Return all page childs to a page
	function get_region_halland_current_page_and_child_pages()
	{
		
		// Aktuell sida
		global $post;

		// Om det inte är en sida, returnera en tom variabel
		if (!is_a($post, 'WP_Post')) {
			return;
		}

		// Variabel för att lagra page-objektet för aktuell sida
		$pages['current_page'] = $post;

		// Hämta alla barn-sidor
		$args = array( 
			'child_of' => $post->ID, 
			'parent' => $post->ID,
			'hierarchical' => 0,
			'sort_column' => 'menu_order', 
			'sort_order' => 'asc'
		);

		// Variabel för att lagra alla barn-objekt
		$pages['page_children'] = get_pages($args);

		// Loopa igenom alla barn-sidor
		foreach ($pages['page_children'] as $page) {
			
			// Addera länk till sida
			$page->url = get_page_link($page->ID);
		}

		// Returnera alla sidor
		return $pages;
	}

	// Metod som anropas när pluginen aktiveras
	function region_halland_current_page_and_child_pages_activate() {
		// Ingenting just nu...
	}

	// Metod som anropas när pluginen avaktiveras
	function region_halland_current_page_and_child_pages_deactivate() {
		// Ingenting just nu...
	}
	
	// Vilken metod som ska anropas när pluginen aktiveras
	register_activation_hook( __FILE__, 'region_halland_current_page_and_child_pages_activate');
	
	// Vilken metod som ska anropas när pluginen avaktiveras
	register_deactivation_hook( __FILE__, 'region_halland_current_page_and_child_pages_deactivate');

?>