<?php

// Ajoute un élément de menu dans le menu d'administration
function ajouter_menu_mode() {
    add_menu_page(
        'Mode', // Titre de la page
        'Mode', // Nom dans le menu
        'manage_options', // Capacité requise pour y accéder
        'mode', // Slug de la page
        'afficher_page_mode', // Fonction qui affiche la page
        'dashicons-button', // Icône du menu (facultatif, tu peux la modifier)
        7 // Position du menu dans le menu d'administration (plus petit = plus haut)
    );
}
add_action('admin_menu', 'ajouter_menu_mode');

// Fonction qui affiche la page d'options

function afficher_page_mode() {
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Vérifier le nonce pour la sécurité
        check_admin_referer('e2d_mode_options');

        // Enregistrer les options dans la base de données
        update_option('afficher_bouton_essai', isset($_POST['afficher_bouton_essai']));
        update_option('texte_bouton_essai', sanitize_text_field($_POST['texte_bouton_essai']));
        update_option('url_bouton_essai', sanitize_text_field($_POST['url_bouton_essai']));
        update_option('afficher_bouton_inscription', isset($_POST['afficher_bouton_inscription']));
        update_option('texte_bouton_inscription', sanitize_text_field($_POST['texte_bouton_inscription']));
        update_option('url_bouton_inscription', sanitize_text_field($_POST['url_bouton_inscription']));
        update_option('desactiver_bouton_inscription', isset($_POST['desactiver_bouton_inscription']));
        update_option('url_liste_attente', sanitize_text_field($_POST['url_liste_attente'])); // Sauvegarder le champ d'URL
        ?>
<div class="notice notice-success is-dismissible">
    <p>Les options ont été enregistrées avec succès.</p>
</div>
<?php
    }

    // Récupérer les options enregistrées
    $afficher_bouton_essai = get_option('afficher_bouton_essai', false);
    $texte_bouton_essai = get_option('texte_bouton_essai', '');
    $url_bouton_essai = get_option('url_bouton_essai', '');
    $afficher_bouton_inscription = get_option('afficher_bouton_inscription', false);
    $texte_bouton_inscription = get_option('texte_bouton_inscription', '');
    $url_bouton_inscription = get_option('url_bouton_inscription', '');
    $desactiver_bouton_inscription = get_option('desactiver_bouton_inscription', false);
    $url_liste_attente = get_option('url_liste_attente', '');
    ?>
<div class="wrap">
    <h1>Réglages des boutons du site</h1>
    <hr style="border: none; border-top: 1px solid #ccc; margin: 32px 0;">
    <form method="post" action="">
        <?php wp_nonce_field('e2d_mode_options'); ?>
        <h2>Essai</h2>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="afficher_bouton_essai">Afficher le bouton d'essai</label>
                    <p style="font-weight:normal;font-size:13px;opacity:80%;">Uniquement pour les cours</p>
                </th>
                <td>
                    <input type="checkbox" name="afficher_bouton_essai" id="afficher_bouton_essai"
                        <?php checked($afficher_bouton_essai, true); ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="texte_bouton_essai">Texte du bouton d'essai</label>
                </th>
                <td style="width: 20%;">
                    <input type="text" name="texte_bouton_essai" id="texte_bouton_essai"
                        value="<?php echo esc_attr($texte_bouton_essai); ?>" />
                </td>
                <th scope="row">
                    <label for="url_bouton_essai">URL du bouton d'essai</label>
                </th>
                <td>
                    <input type="text" name="url_bouton_essai" id="url_bouton_essai"
                        value="<?php echo esc_attr($url_bouton_essai); ?>" />
                </td>
            </tr>
        </table>

        <h2 style="margin-top:40px;">Inscription</h2>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="afficher_bouton_inscription">Afficher le bouton d'inscription</label>
                </th>
                <td>
                    <input type="checkbox" name="afficher_bouton_inscription" id="afficher_bouton_inscription"
                        <?php checked($afficher_bouton_inscription, true); ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="texte_bouton_inscription">Texte du bouton d'inscription</label>
                </th>
                <td style="width: 20%;">
                    <input type="text" name="texte_bouton_inscription" id="texte_bouton_inscription"
                        value="<?php echo esc_attr($texte_bouton_inscription); ?>" />
                </td>
                <th scope="row">
                    <label for="url_bouton_inscription">URL du bouton d'inscription</label>
                </th>
                <td>
                    <input type="text" name="url_bouton_inscription" id="url_bouton_inscription"
                        value="<?php echo esc_attr($url_bouton_inscription); ?>" />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="desactiver_bouton_inscription">Afficher mais désactiver</label>
                    <p style="font-weight:normal;font-size:13px;opacity:80%;">Visible, mais grisé et inutilisable (ex:
                        avant l'ouverture)</p>
                </th>
                <td style="vertical-align:top; padding-top:21px;">
                    <input type="checkbox" name="desactiver_bouton_inscription" id="desactiver_bouton_inscription"
                        <?php checked($desactiver_bouton_inscription, true); ?> />
                </td>
            </tr>
        </table>

        <hr style="border: none; border-top: 1px solid #ccc; margin: 0px 0 32px;">

        <h2>Lien vers la liste d'attente</h2>
        <p>Apparaît quand les cours sont complets</p>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="url_liste_attente">URL de la liste d'attente</label>
                </th>
                <td>
                    <input type="text" name="url_liste_attente" id="url_liste_attente"
                        value="<?php echo esc_attr($url_liste_attente); ?>" />
                </td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" name="submit" class="button-primary" value="Enregistrer les options" />
        </p>
    </form>
</div>
<?php
}