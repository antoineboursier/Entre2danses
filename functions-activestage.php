<?php

// Créer une sous-page pour le type de publication personnalisé "stages"
function ajouter_sous_page_activestages() {
    add_submenu_page(
        'edit.php?post_type=stages', // Slug de la page parente (la liste des stages)
        'Activer les stages sur le site ', // Titre de la sous-page
        'Activer les stages' . get_emoticon(), // Titre du menu
        'manage_options', // Capacité requise pour afficher la page
        'activer_stages', // Slug de la sous-page
        'afficher_contenu_activestages' // Fonction d'affichage du contenu de la sous-page
    );
}
add_action('admin_menu', 'ajouter_sous_page_activestages');

// Initialiser les options de l'activé des stages
function initialiser_options_activestages() {
    add_option('activer_stages_site', false);
}
add_action('admin_init', 'initialiser_options_activestages');

// Enregistrer les options de l'activé des stages
function enregistrer_options_activestages() {
    register_setting('activer_stages_options', 'activer_stages_site');
}
add_action('admin_init', 'enregistrer_options_activestages');

// Afficher le contenu de la sous-page "Activer les stages"
function afficher_contenu_activestages() {
    if (isset($_POST['activestages_nonce']) && wp_verify_nonce($_POST['activestages_nonce'], 'enregistrer_activestages')) {
        if (isset($_POST['activer_stages_site'])) {
            update_option('activer_stages_site', true);
        } else {
            update_option('activer_stages_site', false);
        }
    }

    $activer_stages_site = get_option('activer_stages_site', false);
    ?>
<div class="wrap">
    <h1 style="margin-bottom:40px;"><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="">
        <?php wp_nonce_field('enregistrer_activestages', 'activestages_nonce'); ?>
        <p>Lorsque les stages <b>sont activés</b>, les boutons "Voir les stages" apparaissent, ainsi que dans le menu
        </p>
        <p style="margin-bottom:40px;">Lorsque les stages <b>sont désactivés</b>, les boutons "Voir les stages" ne sont
            plus affichés, et les stages n'apparaissent pas dans le menu</p>
        <label for="activer_stages_site">
            <input type="checkbox" id="activer_stages_site" name="activer_stages_site"
                <?php checked($activer_stages_site, true); ?>>
            Afficher les stages sur le site
        </label>
        <?php submit_button('Enregistrer'); ?>
        <p
            style="margin-top:40px; padding:16px; border:1px solid red; color:red; display:inline-block; border-radius:4px;">
            Note : pensez à retirer l'entrée dans le menu</p>
    </form>
</div>
<?php
}

// Fonction pour obtenir l'émoticône en fonction de l'état de la checkbox
function get_emoticon() {
    $activer_stages_site = get_option('activer_stages_site', false);
    $emoticon = '';

    if ($activer_stages_site) {
        $emoticon = ' ✅';
    } else {
        $emoticon = ' ❌';
    }

    return $emoticon;
}