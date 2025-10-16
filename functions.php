<?php
	
	///
	/// Configuration de base du thème
	///

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails', array('page','post','stages','cours','single') );
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'thumb_page_mobile', 300, 300, true );
		add_image_size( 'thumb_page_cours', 435, 542, true );
		add_image_size( 'photo_content_cours', 440, 240, true );
		add_image_size( 'tenue_content_cours', 592, 216, true );
		add_image_size( 'cours_similaires', 220, 352, true );
		add_image_size( 'thumb_vignette', 400, 292, true );
		add_image_size( 'thumb_categorie', 1120, 361, true );
	};

	add_post_type_support( 'page', 'excerpt' );
	
	register_nav_menus(array(
		'menuV6' => 'Menu_V6',
		'lien_footerV6' => 'Footer_V6',
		'contact_footerV6' => 'Contact_Footer_V6',
	));	

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
	/// Icone FB et insta menu
	///

	class Custom_Nav_Walker extends Walker_Nav_Menu {
		public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			// Vérifier si l'élément a l'attribut title "ico-fb" pour en faire une icône SVG personnalisée
			if ($item->attr_title === 'ico-fb') {
				$output .= '<div id="RS"><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-' . $item->ID . '">';
				$output .= '<a href="' . $item->url . '" class="icon">';
				$output .= '<img class="icon-svg" src="' . esc_url(get_template_directory_uri()) . '/imgs/ico_fb.svg" alt="Facebook">';
				$output .= '</a>';
				$output .= '</li>';
			}
			// Vérifier si l'élément a l'attribut title "ico-insta" pour en faire une icône SVG personnalisée
			elseif ($item->attr_title === 'ico-insta') {
				$output .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-' . $item->ID . '">';
				$output .= '<a href="' . $item->url . '" class="icon">';
				$output .= '<img class="icon-svg" src="' . esc_url(get_template_directory_uri()) . '/imgs/ico_ig.svg" alt="Instagram">';
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

	///
	/// Chargement des scripts et styles (Enqueue)
	///

	function e2d_v6_enqueue_assets() {
		$theme_version = wp_get_theme()->get( 'Version' );

		// Polices Google Fonts
		wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:500,700&display=swap', array(), null );

		// Feuille de style principale
		wp_enqueue_style( 'main-style', get_stylesheet_uri(), array(), $theme_version );

		// Scripts JS
		// WordPress inclut déjà jQuery, nous le déclarons comme dépendance.
		// Le 'true' à la fin charge les scripts dans le footer pour de meilleures performances.
		wp_enqueue_script( 'sparkles-js', get_template_directory_uri() . '/sparkles2.js', array('jquery'), $theme_version, false );
		wp_enqueue_script( 'anime-js', get_template_directory_uri() . '/anime.js', array(), $theme_version, true );
	}
	add_action( 'wp_enqueue_scripts', 'e2d_v6_enqueue_assets' );

	// Pré-connexion au domaine Google Fonts pour la performance
	function e2d_v6_preconnect_google_fonts( $hints, $relation_type ) {
		if ( 'preconnect' === $relation_type ) {
			$hints[] = '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
		}
		return $hints;
	}
	add_filter( 'wp_resource_hints', 'e2d_v6_preconnect_google_fonts', 10, 2 );


	
	
?>