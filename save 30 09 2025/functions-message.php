<?php
// Ajoute un élément de menu dans le menu d'administration
function ajouter_menu_push_site() {
    add_menu_page(
        'Push site', // Titre de la page
        'Push site', // Nom dans le menu
        'manage_options', // Capacité requise pour y accéder
        'push-site', // Slug de la page
        'afficher_page_push_site', // Fonction qui affiche la page
        'dashicons-admin-comments', // Icône du menu (facultatif, vous pouvez la modifier)
        7 // Position du menu dans le menu d'administration (plus petit = plus haut)
    );
}
add_action('admin_menu', 'ajouter_menu_push_site');

// Fonction qui affiche la page d'options du Push site
function afficher_page_push_site() {
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Enregistrer les options dans la base de données
        update_option('message_site_actif', isset($_POST['message_site_actif']));
        update_option('message_site_titre', sanitize_text_field($_POST['message_site_titre']));
        update_option('message_site_texte_court', sanitize_text_field($_POST['message_site_texte_court']));
        update_option('message_site_lien', esc_url($_POST['message_site_lien']));
        update_option('message_site_interface', $_POST['message_site_interface']); // Nouvelle option pour l'interface
        ?>
        <div class="notice notice-success is-dismissible">
            <p>Les options ont été enregistrées avec succès.</p>
        </div>
        <?php
    }

    // Récupérer les options enregistrées
    $message_site_actif = get_option('message_site_actif', false);
    $message_site_titre = get_option('message_site_titre', '');
    $message_site_texte_court = get_option('message_site_texte_court', '');
    $message_site_lien = get_option('message_site_lien', '');
    $message_site_interface = get_option('message_site_interface', 'classic'); // Valeur par défaut : classic
    ?>
    <div class="wrap">
        <h1>Push site</h1>
        <hr style="border: none; border-top: 1px solid #ccc; margin: 32px 0;">
        <form method="post" action="">
            <h2>Mode message fort</h2>
            <p style="font-weight:normal;font-size:13px;opacity:80%;">Place un message sur toutes les pages du site pour relayer une information importante (ex : Erreur blablabla... Inscription / Réinscriptions...)</p>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="message_site_actif">Activer le message sur tout le site</label>
                    </th>
                    <td>
                        <input type="checkbox" name="message_site_actif" id="message_site_actif" <?php checked($message_site_actif, true); ?>>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="message_site_titre">Titre du message</label>
                    </th>
                    <td>
                        <input type="text" name="message_site_titre" id="message_site_titre" value="<?php echo esc_attr($message_site_titre); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="message_site_texte_court">Texte court du message</label>
                    </th>
                    <td>
                        <input type="text" name="message_site_texte_court" id="message_site_texte_court" value="<?php echo esc_attr($message_site_texte_court); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="message_site_lien">Lien</label>
                    </th>
                    <td>
                        <input type="url" name="message_site_lien" id="message_site_lien" value="<?php echo esc_url($message_site_lien); ?>">
                    </td>
                </tr>
            
                <tr>
                    <th scope="row">
                        <label for="message_site_interface">Choix de l'interface</label>
                    </th>
                    <td>
                        <label>
                            <input type="radio" name="message_site_interface" value="classic" <?php checked($message_site_interface, 'classic'); ?>>
                            Classic
                        </label>
                        <br>
                        <label>
                            <input type="radio" name="message_site_interface" value="alerte" <?php checked($message_site_interface, 'alerte'); ?>>
                            Alerte
                        </label>
                    </td>
                </tr>
            </table>

            <hr style="border: none; border-top: 1px solid #ccc; margin: 0px 0 32px;">

            <p class="submit">
                <input type="submit" name="submit" class="button-primary" value="Enregistrer les options">
            </p>
        </form>
    </div>
    <?php
}
