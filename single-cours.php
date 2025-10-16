<?php get_header(); ?>

<div class="type-page content-area template_cours">

    <?php while (have_posts()) : the_post(); ?>

    <?php if (get_field('complete_cours')) : ?>
    <div id="cours_complet">
        <img src="<?php echo get_template_directory_uri(); ?>/imgs/sad-emoji.svg" alt="" aria-hidden="true" />
        <div>
            <p class="complete_title">Cours complet pour cette année</p>
            <p>Une inscription en liste d’attente est possible, mais ne garantit pas une place.</p>
        </div>
    </div>
    <?php endif; ?>

    <section id="principale">

        <?php if (has_post_thumbnail()) : ?>
        <div id="princ_thumb">
            <?php the_post_thumbnail('thumb_page_cours', ['class' => 'thumb']); ?>
        </div>
        <?php endif; ?>

        <div id="princ_info">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p class="breadcrumbs reduce">', '</p>');
            } ?>

            <h1 class="title"><?php the_title(); ?>
                <?php if ($sous_titre = get_field('sous_titre')) : ?>
                <span><?php echo esc_html($sous_titre); ?></span>
                <?php endif; ?>
            </h1>

            <div class="infos_cours">
                <?php if ($jour = get_field('jour_de_cours')) : ?>
                <p class="day"><?php echo esc_html($jour); ?></p>
                <?php endif; ?>

                <?php if ($debut = get_field('heure_debut')) : ?>
                <p class="horaire">
                    <?php echo esc_html($debut); ?><?php if ($fin = get_field('heure_de_fin')) echo " - " . esc_html($fin); ?>
                </p>
                <?php endif; ?>

                <?php if ($profs = get_field('prof_user')) : ?>
                <p class="professor-list">
                    <?php echo implode(', ', array_map(fn($u) => esc_html($u['display_name']), $profs)); ?>
                </p>
                <?php endif; ?>

                <?php if ($lieu = get_field('localisation_adress')) : ?>
                <p class="lieu"><?php echo $lieu; ?></p>
                <?php endif; ?>

                <?php if ($tarif = get_field('tarif_cours')) : ?>
                <p class="tarif"><?php echo get_the_title($tarif); ?></p>
                <?php endif; ?>

                <?php if ($info = get_field('info_complementaire')) : ?>
                <p class="info_comp"><?php echo esc_html($info); ?></p>
                <?php endif; ?>
            </div>

            <?php echo do_shortcode('[button_inscription]'); ?>

        </div>

    </section>

    <div class="separator" aria-hidden="true"></div>

    <section id="description">
        <?php if ($desc = get_field('description_cours')) : ?>
        <h2 class="signature">Description</h2>
        <p><?php echo nl2br(esc_html($desc)); ?></p>
        <?php endif; ?>

        <?php if ($photo = get_field('photo_cours')) : ?>
        <img src="<?php echo esc_url($photo['url']); ?>" alt="Photo du cours" class="photo_cours" />
        <?php endif; ?>

        <?php if ($pedago = get_field('pedagogie')) : ?>
        <h2 class="signature">Pédagogie</h2>
        <p><?php echo nl2br(esc_html($pedago)); ?></p>
        <?php endif; ?>
    </section>

    <div class="separator" aria-hidden="true"></div>

    <section id="deroulement" class="details-part">
        <h2 class="signature">Déroulé type d’un cours</h2>
        <div class="deroul_bloc">
            <?php if ($time = get_field('echauffement_time')) : ?>
            <p class="deroul_time signature"><?php echo esc_html($time); ?></p>
            <?php endif; ?>
            <p class="deroul_title">Échauffement</p>
            <?php if ($desc = get_field('echauffement_description')) : ?>
            <p class="deroul_desc text-information"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>
        </div>

        <div class="deroul_bloc">
            <?php if ($time = get_field('exercice_time')) : ?>
            <p class="deroul_time signature"><?php echo esc_html($time); ?></p>
            <?php endif; ?>
            <p class="deroul_title">Exercice</p>
            <?php if ($desc = get_field('exercice_description')) : ?>
            <p class="deroul_desc text-information"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>
        </div>

        <div class="deroul_bloc">
            <?php if ($time = get_field('choregraphie_time')) : ?>
            <p class="deroul_time signature"><?php echo esc_html($time); ?></p>
            <?php endif; ?>
            <p class="deroul_title">Chorégraphie</p>
            <?php if ($desc = get_field('choregraphie_description')) : ?>
            <p class="deroul_desc text-information"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>
        </div>

        <?php if ($styles = get_field('styles_musiques')) : ?>
        <div id="style_music" class="deroul_bloc">
            <p><span>Styles de musiques :</span> <?php echo esc_html($styles); ?></p>
        </div>
        <?php endif; ?>
    </section>

    <div class="separator" aria-hidden="true"></div>

    <section id="tenue" class="details-part">
        <?php if ($tenue = get_field('tenue')) : ?>
        <h2 class="signature">Tenue conseillée</h2>
        <p><?php echo nl2br(esc_html($tenue)); ?></p>
        <?php endif; ?>

        <?php if ($photo = get_field('photo_tenue')) : ?>
        <img src="<?php echo esc_url($photo['url']); ?>" alt="Photo tenue" class="photo_tenue" />
        <?php else : ?>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/imgs/tenue-danse.jpg'); ?>" id="tenue-defaut-img"
            alt="" aria-hidden="true" />
        <?php endif; ?>
    </section>

    <?php endwhile; ?>

</div>

<?php get_template_part('template-parts/cours-similaires'); ?>
<?php get_footer(); ?>