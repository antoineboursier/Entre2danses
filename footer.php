</main>

<?php 
// Bouton modifier
if (current_user_can('manage_options') && wp_is_mobile() === false) { ?>
<a id="edit" class="btn secondary"
    href="<?php echo get_edit_post_link(); ?>"><?php _e("Modifier la page","ntp_framework"); ?></a>
<?php }
?>

<footer>

    <div class="bloc_footer">
        <?php $menu_location = 'contact_footerV6';
		if (has_nav_menu($menu_location)) {
			$menu_args = array(
				'theme_location' => $menu_location,
				'container' => 'nav',
				'menu_id' => 'contact_footer_menu',
			);
		wp_nav_menu($menu_args);
		} ?>
    </div>

    <div id="ethique" class="bloc_footer">
        <div>
            <div>
                <img width="40px" src="<?php bloginfo('template_url'); ?>/imgs/eco_danse.svg" alt=""
                    aria-hidden="true" />
            </div>
            <p>Ce site pollue moins que 73% des sites web testés par <a target="_blank" rel="external"
                    href="https://www.websitecarbon.com/website/entre2danses-org/">Web4carbon.</a></p>
        </div>
        <div>
            <div>
                <img width="32px" src="<?php bloginfo('template_url'); ?>/imgs/ic-access.svg" alt=""
                    aria-hidden="true" />
            </div>
            <p>Notre site a été pensé accessible à tous. Selon Lighthouse, il est <strong>accessible à hauteur de
                    93/100</strong>, et obtiendrait le niveau "Partiellement conforme" selon les critères du RGAA.</p>
        </div>
    </div>

    <div id="footer_groupe" class="bloc_footer">
        <p class="footer_title text-medium">Les cours de danse collectif en groupe :</p>
        <div class="footer_list">
            <?php
                    $cours_query = new WP_Query(array(
                        'post_type' => 'cours',
                        'posts_per_page' => -1,
                        'no_found_rows' => true,
                        'update_post_term_cache' => false,
                        'update_post_meta_cache' => false,
                    ));
                    if ($cours_query->have_posts()) :
                        while ($cours_query->have_posts()) : $cours_query->the_post();
                    ?>
            <h4>
                <a href="<?php the_permalink(); ?>"><?php the_title();?><span
                        class="subtitle"><?php if( get_field( 'sous_titre' ) ): the_field('sous_titre'); endif; ?></span></a>
            </h4>
            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
        </div>
    </div>

    <div id="footer_stages" class="bloc_footer">
        <p class="footer_title text-medium">Tous les stages de 2023 (atelier ou workshop) :</p>
        <div class="footer_list">
            <?php
                    $stages_query = new WP_Query(array(
                        'post_type' => 'stages',
                        'posts_per_page' => -1,
                        'no_found_rows' => true,
                        'update_post_term_cache' => false,
                        'update_post_meta_cache' => false,
                    ));
                    if ($stages_query->have_posts()) :
                        while ($stages_query->have_posts()) : $stages_query->the_post();
                    ?>
            <h4>
                <a href="<?php the_permalink(); ?>"><?php the_title();?><span
                        class="subtitle"><?php if( get_field( 'sous_titre' ) ): the_field('sous_titre'); endif; ?></span></a>
            </h4>
            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
        </div>
    </div>
    <div id="footer_geo" class="bloc_footer">
        <p class="footer_title text-medium">Zone géographique :</p>
        <div class="footer_list">
            <h4>Villeneuve d'Ascq</h4>
            <h4>Roubaix</h4>
            <h4>Tourcoing</h4>
            <h4>Wasquehal</h4>
            <h4>Croix</h4>
            <h4>Lille</h4>
            <h4>Hellemmes</h4>
            <h4>Fives</h4>
            <h4>Hem</h4>
            <h4>Mouvaux</h4>
        </div>
    </div>

    <div class="bloc_footer">
        <?php
// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (is_user_logged_in() && current_user_can('administrator')) {
	// Ajouter le bouton de menu en tant qu'élément <li> dans le menu existant
	$menu_location = 'lien_footerV6';
	if (has_nav_menu($menu_location)) {
		$menu_args = array(
			'theme_location' => $menu_location,
			'container' => 'nav',
			'menu_id' => 'link_footer_menu'
		);
		wp_nav_menu($menu_args);
	}
} else {
	// Afficher le menu existant
	$menu_location = 'lien_footerV6';
	if (has_nav_menu($menu_location)) {
		$menu_args = array(
			'theme_location' => $menu_location,
			'container' => 'nav',
			'menu_id' => 'link_footer_menu',
		);
		wp_nav_menu($menu_args);
	}
}
?>

    </div>

</footer>

</body>

</html>