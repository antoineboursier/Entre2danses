<?php
	
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails', array('page','post','stages','cours','single'));
	if (function_exists('add_image_size')) {
		add_image_size('thumb_page_mobile',300,300,true);
		add_image_size('thumb_page_cours',435,542,true);
		add_image_size('photo_content_cours',440,240,true);
		add_image_size('tenue_content_cours',592,216,true);
		add_image_size('cours_similaires',220,352,true);
		add_image_size('thumb_vignette',400,292,true);
		add_image_size('thumb_categorie',1120,361,true);
	}
	add_post_type_support('page','excerpt');
	register_nav_menus(array(
		'primary'=>'Menu principal',
		'contact_footerV6'=>'Contact footer'
	));

	function e2d_enqueue_assets() {
		$ver = wp_get_theme()->get('Version');
		wp_enqueue_style('e2d-theme', get_stylesheet_uri(), [], $ver);
		wp_enqueue_style('e2d-fonts', 'https://fonts.googleapis.com/css?family=Poppins:500,700&display=swap', [], null);
		wp_enqueue_script('jquery');
		wp_enqueue_script('anime', get_template_directory_uri().'/anime.js', [], $ver, true);
		wp_enqueue_script('sparkles2', get_template_directory_uri().'/sparkles2.js', ['anime'], $ver, true);
	}
	add_action('wp_enqueue_scripts','e2d_enqueue_assets');

	function e2d_resource_hints($urls,$relation_type){
		if('preconnect'===$relation_type){
			$urls[]=['href'=>'https://fonts.googleapis.com','crossorigin'=>true];
			$urls[]=['href'=>'https://fonts.gstatic.com','crossorigin'=>true];
		}
		return $urls;
	}
	add_filter('wp_resource_hints','e2d_resource_hints',10,2);

	///
	/// Custom post
	///
	
	function custom_post_type() {
		$labels = array(
			'menu_name' =>        __( 'Les cours' ), /*Nom du menu*/
			'name' =>             __( 'Les cours' ), /*ID plural*/
			'singular_name' =>    __( 'Cours' ), /*ID single*/
			'name_admin_bar' =>   __( 'Ajouter un nouveau cours' ),
			'all_items' =>        __( 'Voir tous les cours' ),
			'add_new' =>          _x( 'Ajouter un cours', 'Cours'), /*Menu -> ajout*/
			'add_new_item' =>     __( 'Ajouter un cours' ),
			'edit_item' =>        __( 'Modifier ce cours' )
		);
		$args = array(
			'label'               => __( 'cours', 'twentythirteen' ),
			'description'         => __( 'Movie news and reviews', 'twentythirteen' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'author' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'taxonomies'          => array( 'category','post_tag' ),
			'menu_icon' => get_template_directory_uri() . '/imgs/dashicon_dance.png',
		);

		register_post_type( 'cours', $args );
	}
	add_action( 'init', 'custom_post_type', 0 );

	function custom_post_type_stages() {
		$labels = array(
			'menu_name' =>        __( 'Les stages' ), /*Nom du menu*/
			'name' =>             __( 'Les stages' ), /*ID plural*/
			'singular_name' =>    __( 'Stage' ), /*ID single*/
			'name_admin_bar' =>   __( 'Ajouter un nouveau stage' ),
			'all_items' =>        __( 'Voir tous les stages' ),
			'add_new' =>          _x( 'Ajouter un stage', 'Stages'), /*Menu -> ajout*/
			'add_new_item' =>     __( 'Ajouter un stage' ),
			'edit_item' =>        __( 'Modifier ce stage' )
		);
		$args = array(
			'label'               => __( 'stages', 'twentythirteen' ),
			'description'         => __( 'Movie news and reviews', 'twentythirteen' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'author' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 6,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'taxonomies'          => array( 'category','post_tag' ),
			'menu_icon' => get_template_directory_uri() . '/imgs/dashicon_stage.png',
		);

		register_post_type( 'stages', $args );
	}
	add_action( 'init', 'custom_post_type_stages', 0 );
	
	///
	/// Attribuer le template aux custom pages
	///

	function custom_post_template($template) {
		global $post;
	
		if (is_singular('stages') || is_singular('cours')) {
			$new_template = locate_template(array('single-custompost.php'));
	
			if (!empty($new_template)) {
				return $new_template;
			}
		}
	
		return $template;
	}
	add_filter('single_template', 'custom_post_template');

	///
	/// Icone FB et insta menu
	///

	class Custom_Nav_Walker extends Walker_Nav_Menu {
		public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			// Vérifier si l'élément a l'attribut title "ico-fb" pour en faire une icône SVG personnalisée
			if ($item->attr_title === 'ico-fb') {
				$output .= '<div id="RS"><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-' . $item->ID . '">';
				$output .= '<a href="' . $item->url . '" class="icon">';
				$output .= '<img class="icon-svg" src="' . get_bloginfo('template_url') . '/imgs/ico_fb.svg" alt="Facebook">';
				$output .= '</a>';
				$output .= '</li>';
			}
			// Vérifier si l'élément a l'attribut title "ico-insta" pour en faire une icône SVG personnalisée
			elseif ($item->attr_title === 'ico-insta') {
				$output .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-' . $item->ID . '">';
				$output .= '<a href="' . $item->url . '" class="icon">';
				$output .= '<img class="icon-svg" src="' . get_bloginfo('template_url') . '/imgs/ico_ig.svg" alt="Instagram">';
				$output .= '</a>';
				$output .= '</li></div>';
			} else {
				$output .= '<li id="menu-item-' . $item->ID . '" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-' . $item->ID . '">';
				$output .= '<a href="' . $item->url . '">' . $item->title . '</a>';
				$output .= '</li>';
			}
		}
	}

	///
	/// Modifier le format des dates pour les stages
	///

	function custom_date_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'field_name' => '',
			'format' => 'd/m/y',
		), $atts );
	
		$date_field = get_field( $atts['field_name'] );
	
		if ( $date_field ) {
			$date_obj = DateTime::createFromFormat( 'd/m/Y', $date_field );
			if ( $date_obj ) {
				return $date_obj->format( $atts['format'] );
			}
		}
	
		return '';
	}
	add_shortcode( 'custom_date', 'custom_date_shortcode' );

	///
	/// Taille excerpt
	///

	function custom_excerpt_length($length) {
		return 20; // Remplacez 20 par le nombre de mots souhaité pour l'extrait
	}
	add_filter('excerpt_length', 'custom_excerpt_length');

	///
	/// Insertion d'autres pages
	///

	require 'functions-mode.php';
	require 'functions-btn-inscription.php';
	require 'functions-message.php';
	require 'functions-activestage.php';


	
	
?>