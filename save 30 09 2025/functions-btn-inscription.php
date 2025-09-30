<?php

function button_inscription($param, $content) {
    // Vérifie si la fonction ACF `get_field` existe
    if (!function_exists('get_field')) {
        return '<p>Le plugin ACF est désactivé. Les informations d’inscription ne sont pas disponibles actuellement.</p>';
    }

    // Récupérer les options enregistrées
    $afficher_bouton_essai = get_option('afficher_bouton_essai', false);
    $texte_bouton_essai = get_option('texte_bouton_essai', '');
    $url_bouton_essai = get_option('url_bouton_essai', '');
    $afficher_bouton_inscription = get_option('afficher_bouton_inscription', false);
    $texte_bouton_inscription = get_option('texte_bouton_inscription', '');
    $url_bouton_inscription = get_option('url_bouton_inscription', '');
    $desactiver_bouton_inscription = get_option('desactiver_bouton_inscription', false);

    $output = '';

    // Vérifier si le cours est complet
    $cours_complet = get_field('complete_cours');

    // Si le cours est complet, afficher les boutons "Cours complet" et "M'inscrire sur la liste d'attente"
    if ($cours_complet) {
        $output .= '<a class="btn primary desactived complet" id="inscription">Cours complet</a>';
        $url_liste_attente = get_option('url_liste_attente', '');
        $output .= '<a class="btn secondary" id="attente" target="_blank" href="' . esc_url($url_liste_attente) . '">M\'inscrire sur la liste d\'attente</a>';
    } else {
        // Si le cours n'est pas complet, afficher les boutons d'inscription et d'essai selon les options
        if ($afficher_bouton_inscription) {
            // Vérifier si le bouton d'inscription est désactivé
            if ($desactiver_bouton_inscription) {
                $output .= '<span class="btn primary desactived" id="inscription">' . esc_html($texte_bouton_inscription) . '</span>';
            } else {
                $output .= '<a class="btn primary" id="inscription" target="_blank" href="' . esc_url($url_bouton_inscription) . '">' . esc_html($texte_bouton_inscription) . '</a>';
            }
        }

        if ($afficher_bouton_essai) {
            $output .= '<a class="btn secondary" id="essai" target="_blank" href="' . esc_url($url_bouton_essai) . '">' . esc_html($texte_bouton_essai) . '</a>';
        }
    }

    return $output;
}
add_shortcode('button_inscription', 'button_inscription');

function button_contact($param, $content) {
    // Utiliser la fonction `site_url()` pour générer dynamiquement l'URL
    $contact_url = site_url('/contact/');
    return '<a href="' . esc_url($contact_url) . '" class="btn primary">Nous contacter</a>';
}
add_shortcode('button_contact', 'button_contact');

?>