<?php
/**
 * Template Name: Custom Post Template
 */
?>

<?php get_header(); ?>

<div class="type-page content-area template_cours_stage">

    <?php while ( have_posts() ) :
			the_post();?>


    <?php if( get_field('complete_cours') ): ?>
    <div id="cours_complet">
        <img src="<?php echo get_template_directory_uri() . '/imgs/sad-emoji.svg'; ?>" alt="" aria-hidden="true" />
        <div>
            <p class="complete_title">Cours complet pour cette année</p>
            <p>Une inscription en liste d’attente est possible,mais ne garantie pas une place.</p>
        </div>
    </div>
    <?php endif; ?>

    <section id="principale">

        <div id="princ_thumb">

            <?php the_post_thumbnail('thumb_page_cours' , ['class' => 'thumb']); ?>

        </div>

        <div id="princ_info">

            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p class="breadcrumbs reduce">','</p>');} ?>

            <h1 class="title">
                <?php the_title();?>
                <?php if( get_field( 'sous_titre' ) ): echo "<span>"; the_field('sous_titre'); echo "</span>"; endif; ?>
            </h1>

            <?php
                        $users = get_field("prof_user");
                        if ($users) :
                            $user_names = array();
                            foreach ($users as $user) {
                                if ($user->user_url) {
                                    $user_names[] = '<a href="' . esc_attr($user->user_url) . '">' . $user->display_name . '</a>';
                                } else {
                                    $user_names[] = $user->display_name;
                                }
                            }
                            $user_count = count($user_names);
                            $user_list = implode(' et ', $user_names);
                            ?>
            <p class="professor-list">avec <?php echo $user_list; ?></p>
            <?php endif; ?>

            <div class="infos_cours">
                <div id="jour" class="info">
                    <img id="ico_calendar" aria-hidden="true"
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/imgs/calendar.svg" />
                    <div class="text-column">
                        <?php if (is_singular('cours')) : ?>
                        <?php if( get_field( 'jour_de_cours' ) ): echo "<p class='day'>"; the_field('jour_de_cours'); echo "</p>"; endif; ?>
                        <?php elseif (is_singular('stages')) : ?>
                        <?php
                                    if (get_field('date_stage')) {
                                        $date_debut = get_field('date_stage'); // Récupérer la valeur du champ de date
                                        $date_debut = str_replace('/', '-', $date_debut); // Remplacer le slash par un tiret

                                        $date_obj = DateTime::createFromFormat('d-m-Y', $date_debut); // Créer un objet DateTime à partir de la date

                                        if ($date_obj) {
                                            $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE); // Créer un formateur de date avec la localisation française
                                            $formatted_date = $formatter->format($date_obj); // Formater la date au format souhaité
                                            echo "<p class='day'>" . $formatted_date . "</p>";
                                        }
                                    }
                                    ?>
                        <?php endif; ?>
                        <?php if( get_field( 'heure_debut' ) ): echo "<p class='horaire'>"; the_field('heure_debut'); echo " - "; echo the_field('heure_de_fin'); echo "</p>"; endif; ?>
                    </div>
                </div>
                <?php if (is_singular('stages')) : ?>
                <div class="info" id="other_date">
                    <p>Autres dates :</p>
                    <div class="text-column">
                        <?php
                                    $featured_posts = get_field('other_date');
                                    if ($featured_posts) :
                                        foreach ($featured_posts as $post) :
                                            setup_postdata($post);

                                            $date_debut = get_field('date_stage'); // Récupérer la valeur du champ de date
                                            $date_debut = str_replace('/', '-', $date_debut); // Remplacer le slash par un tiret

                                            $date_obj = DateTime::createFromFormat('d-m-Y', $date_debut); // Créer un objet DateTime à partir de la date

                                            if ($date_obj) {
                                                $date_expiration = $date_obj->format('d/m/y'); // Formater la date au format souhaité

                                                // Vérifier si la date est antérieure à aujourd'hui
                                                $class = ($date_obj->getTimestamp() < strtotime('today')) ? 'desactived' : '';

                                                ?>
                        <a href="<?php the_permalink(); ?>" class="<?php echo $class; ?>">
                            <span><?php echo $date_expiration; ?></span>
                        </a>
                        <?php
                                            }

                                        endforeach;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                    </div>
                </div>
                <?php endif; ?>
                <div id="lieu" class="info">
                    <img id="ico_map" aria-hidden="true"
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/imgs/map.svg" />
                    <div class="text-column">
                        <?php $lieu = get_field('lieu_txt');
                                if ($lieu === 'odeya') {
                                    echo '<p class="lieu_name">École de danse Odeya</p><p class="lieu_adress reduce">202 rue Jean Jaurès à Villeneuve d\'ascq</p>';
                                } elseif ($lieu === 'autre') {
                                } ?>
                    </div>
                </div>
                <div id="price" class="info">
                    <img id="ico_bank" aria-hidden="true"
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/imgs/piggy-bank.svg" />
                    <div class="text-column">
                        <?php if( get_field( 'tarif_cours' ) ): echo '<p class="tarif">'; the_field('tarif_cours'); echo '€</p>' ; echo '<p class="tarif_asso reduce">dont 5€ d’adhésion (obligatoire pour assurer l’élève)</p>'; endif; ?>
                        <?php if( get_field( 'tarif_1' ) ): echo '<p class="tarif">'; the_field('tarif_1'); echo '</p>' ; endif; ?>
                        <?php if( get_field( 'tarif_2' ) ): echo '<p class="tarif">'; the_field('tarif_2'); echo '</p>' ; endif; ?>
                        <?php if( get_field( 'tarif_3' ) ): echo '<p class="tarif">'; the_field('tarif_3'); echo '</p>' ; endif; ?>
                    </div>
                </div>
                <div id="supp" class="info">
                    <img id="ico_thumb" aria-hidden="true"
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/imgs/thumbs-up.svg" />
                    <div class="text-column">
                        <p class="info_comp">Prévoir une tenue et chaussures adaptées au cours</p>
                    </div>
                </div>
            </div>

            <?php if( get_field( 'description' ) ): ?>
            <div class="description"><?php the_field('description'); ?></div>
            <?php endif; ?>

            <?php if (is_singular('cours')) {
                        echo do_shortcode('[button_inscription]');
                    } elseif (is_singular('stages')) {
                        $url_reservation = get_field('url_de_reservation');
                        echo '<a href="' . esc_url($url_reservation) . '" class="btn primary">Réserver ma place</a>';
                    }; ?>

        </div>

    </section>

    <?php if (is_singular('cours')) : ?>

    <!-- ------------------------------------- -->
    <!-- SEPARATOR -->
    <!-- ------------------------------------- -->

    <div class="separator" aria-hidden="true"></div>

    <!-- ------------------------------------- -->
    <!-- SECTION DETAILS -->
    <!-- ------------------------------------- -->

    <section id="details">

        <div id="apprentissage" class="details-part">
            <?php if (get_field('details_du_cours')) : ?>
            <?php $details_du_cours = get_field('details_du_cours'); ?>
            <?php if (isset($details_du_cours['photo_du_cours'])) : ?>
            <?php $photo_du_cours_id = $details_du_cours['photo_du_cours']; ?>
            <?php if ($photo_du_cours_id) : echo wp_get_attachment_image($photo_du_cours_id, 'photo_content_cours', false, array('alt' => '')); ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php if (isset($details_du_cours['apprentissage'])) : ?>
            <div>
                <h2 class="signature">Mais qu’apprennent-ils exactement ?</h2>
                <p><?php echo wp_kses_post($details_du_cours['apprentissage']); ?></p>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>

        <div id="deroulement" class="details-part">
            <?php if( have_rows( 'details_du_cours' ) ): ?>
            <?php while( have_rows( 'details_du_cours' ) ): the_row(); ?>
            <h2 class="signature">Comment se déroule un cours ?</h2>
            <div>
                <div class="deroul_bloc">
                    <img src="<?php echo get_template_directory_uri() . '/imgs/wind.svg'; ?>" alt=""
                        aria-hidden="true" />
                    <p class="deroul_time signature"><?php the_sub_field('echauffement_time'); ?></p>
                    <p class="deroul_title">Échauffement</p>
                    <p class="deroul_desc text-information"><?php the_sub_field('echauffement_description'); ?></p>
                </div>
                <div class="deroul_bloc">
                    <img src="<?php echo get_template_directory_uri() . '/imgs/ruler.svg'; ?>" alt=""
                        aria-hidden="true" />
                    <p class="deroul_time signature"><?php the_sub_field('exercice_time'); ?></p>
                    <p class="deroul_title">Exercice</p>
                    <p class="deroul_desc text-information"><?php the_sub_field('exercice_description'); ?></p>
                </div>
                <div class="deroul_bloc">
                    <img src="<?php echo get_template_directory_uri() . '/imgs/target.svg'; ?>" alt=""
                        aria-hidden="true" />
                    <p class="deroul_time signature"><?php the_sub_field('choregraphie_time'); ?></p>
                    <p class="deroul_title">Chorégraphie</p>
                    <p class="deroul_desc text-information"><?php the_sub_field('choregraphie_description'); ?></p>
                </div>
            </div>
            <div id="style_music" class="deroul_bloc">
                <img src="<?php echo get_template_directory_uri() . '/imgs/music-2.svg'; ?>" alt=""
                    aria-hidden="true" />
                <p><span>Styles de musiques :</span> <?php the_sub_field('styles_musiques'); ?></p>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <div id="tenue" class="details-part">
            <?php if (have_rows('details_du_cours')) : ?>
            <?php while (have_rows('details_du_cours')) : the_row(); ?>
            <div>
                <h2 class="signature">Quelle tenue ?</h2>
                <p><?php the_sub_field('tenue'); ?></p>
            </div>
            <?php $photo_du_cours_id = get_sub_field('photo_tenue'); ?>
            <?php if ($photo_du_cours_id) : 
                echo wp_get_attachment_image($photo_du_cours_id, 'tenue_content_cours', false, array('alt' => ''));
            ?>
            <?php else : ?>
            <img src="<?php echo esc_url(get_template_directory_uri() . '/imgs/tenue-danse.jpg'); ?>"
                id="tenue-defaut-img" alt="" />
            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>


    </section>

    <!-- ------------------------------------- -->
    <!-- SECTION VIDEO -->
    <!-- ------------------------------------- -->

    <?php if( get_field( 'video_1' ) || get_field( 'video_2' ) || get_field( 'video_3' ) ): ?>
    <section id="video">
        <?php if( get_field( 'video_1' ) ): ?>
        <div class="video-embed">
            <?php the_field( 'video_1' ); ?>
        </div>
        <?php endif; ?>

        <?php if( get_field( 'video_2' ) ): ?>
        <div class="video-embed">
            <?php the_field( 'video_2' ); ?>
        </div>
        <?php endif; ?>

        <?php if( get_field( 'video_3' ) ): ?>
        <div class="video-embed">
            <?php the_field( 'video_3' ); ?>
        </div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php endif; ?>

    <?php endwhile; ?>

</div>

<!-- ------------------------------------- -->
<!-- SEPARATOR -->
<!-- ------------------------------------- -->

<div class="separator" aria-hidden="true"></div>

<!-- ------------------------------------- -->
<!-- COURS SIMILAIRES -->
<!-- ------------------------------------- -->

<?php
$args = array(
    'post_type' => array('cours', 'stages'), // Types de publications à récupérer
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'post__not_in' => array(get_the_ID()),
);
$query = new WP_Query($args);

// Vérifier si des cours et stages similaires ont été trouvés
if ($query->have_posts()) {
    ?>
<div class="cours-similaires">
    <h2>Ces cours et stages peuvent aussi vous faire kiffer !</h2>
    <div>
        <?php while ($query->have_posts()) : $query->the_post();
                if (get_post_type() === 'stages' && get_field('date_stage')) {
                    $date_debut = get_field('date_stage');
                    $date_debut = str_replace('/', '-', $date_debut);
                    $date_obj = DateTime::createFromFormat('d-m-Y', $date_debut);
                    if ($date_obj && $date_obj->getTimestamp() < strtotime('today')) {
                        continue; // Passer à la prochaine itération si la date est dépassée pour les stages
                    }
                }
                ?>
        <a href="<?php the_permalink(); ?>" class="cours-similaire-item">
            <?php the_post_thumbnail('cours_similaires'); ?>
            <p class="post-type"><?php echo get_post_type(); ?></p> <!-- Afficher le type de post -->
            <h3>
                <?php the_title(); ?>
                <?php if (get_field('sous_titre')) : echo "<span>"; the_field('sous_titre');
                            echo "</span>"; endif; ?>
            </h3>
            <?php if (get_field('date_stage')) {
                        $date_debut = get_field('date_stage');
                        $date_debut = str_replace('/', '-', $date_debut);
                        $date_obj = DateTime::createFromFormat('d-m-Y', $date_debut);
                        if ($date_obj) {
                            $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                            $formatted_date = $formatter->format($date_obj);
                            echo "<p class='day'>" . $formatted_date . "</p>";
                        }
                    } ?>
            <?php if (get_field('jour_de_cours')) : echo "<p class='day'>";
                        the_field('jour_de_cours');
                        echo "</p>"; endif; ?>
            <?php if (get_field('heure_debut')) : echo "<p class='horaire'>";
                        the_field('heure_debut');
                        echo " - ";
                        echo the_field('heure_de_fin');
                        echo "</p>"; endif; ?>
        </a>
        <?php endwhile; ?>
    </div>
</div>
<?php
    // Réinitialiser la requête
    wp_reset_postdata();
}
?>


<?php
get_footer();