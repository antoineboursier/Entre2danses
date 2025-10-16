<!doctype html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class();?>>

    <?php wp_body_open(); ?>

    <div id="quicklink" title="Menu d'accessibilité" class="skip-link">
        <a href="#menu">Accéder au menu</a>
        <a href="#main">Aller au contenu</a>
        <a href="#contact_footer_menu">Contact</a>
    </div>

    <header class="header">

        <nav id="menu_nav_container">

            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/imgs/Logo Entre2danses.svg"
                    alt="logo entre2danses" /></a>
            <input class="menu-btn" type="checkbox" id="menu-btn" />
            <label class="menu-icon" for="menu-btn">
                <span class="navicon"></span>
            </label>
            <?php
				$menu_location = 'menuV6';
				if (has_nav_menu($menu_location)) {
					$menu_args = array(
						'theme_location' => $menu_location,
						'container' => false,
						'menu_id' => 'contact_footer_menu',
						'menu_class' => 'menu',
						'walker' => new Custom_Nav_Walker(),
					);
					wp_nav_menu($menu_args);
				}
			?>
        </nav>

    </header>

    <main <?php body_class();?>>

        <?php


// Mode message

if (get_option('message_site_actif', false)) :
	$message_site_titre = get_option('message_site_titre', '');
	$message_site_texte_court = get_option('message_site_texte_court', '');
	$message_site_lien = get_option('message_site_lien', '');
	$message_site_interface = get_option('message_site_interface', 'classic');

	// Vérifier l'interface sélectionnée
	if ($message_site_interface === 'classic') {
		$interface_class = 'classic-interface';
	} elseif ($message_site_interface === 'alerte') {
		$interface_class = 'alerte-interface';
	} else {
		$interface_class = '';
	}
	?>
        <a id="message_alert" title="Infomation importante : <?= esc_html($message_site_titre) ?>"
            class="<?= esc_attr($interface_class) ?>" href="<?= esc_url($message_site_lien) ?>">
            <p>
                <span id="mess_title"><?= esc_html($message_site_titre) ?></span>
                <span id="mess_text"><?= esc_html($message_site_texte_court) ?></span>
            </p>
            <img src="<?php echo get_template_directory_uri() . '/imgs/ico_chevron.svg' ?>" alt="" aria-hidden="true" />
        </a>
        <?php endif; ?>