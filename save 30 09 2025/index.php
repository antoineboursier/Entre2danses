<?php get_header(); ?>

<div class="type-page content-area">

    <?php while ( have_posts() ) :
			the_post();?>

    <section id="principale">

        <div id="hero_header">
            <div id="hero_photo">
                <img id="photo-hero"
                    src="<?php echo esc_url(get_template_directory_uri() . '/imgs/danseuse_en_posture_danse_moderne.jpg'); ?>"
                    alt="" aria-hidden="true" />
                <div id="mini_photo">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/imgs/hero_photo1.jpg'); ?>"
                        class="mini_hero" alt="" aria-hidden="true" />
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/imgs/hero_photo2.jpg'); ?>"
                        class="mini_hero" alt="" aria-hidden="true" />
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/imgs/hero_photo3.jpg'); ?>"
                        class="mini_hero" alt="" aria-hidden="true" />
                </div>
            </div>
            <div id="hero_text">
                <h1>
                    <span>Cours</span>
                    <span>&</span>
                    <span>Stages</span>
                    <span>de</span>
                    <span>danse</span>
                </h1>
                <span>à Villeneuve d'Ascq</span>
                <div class="btn_container">
                    <a class="btn primary" href="">Découvrir les cours</a>
                    <?php if (get_option('activer_stages_site', false)) : ?>
                    <a class="btn secondary" href="">Prochains stages</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div id="article_slider">
            <?php $slider_posts = new WP_Query(array(
        'category_name' => 'slider',
        'posts_per_page' => 5
    ));
    if ($slider_posts->have_posts()) : while ($slider_posts->have_posts()) : $slider_posts->the_post(); ?>
            <div class="slider_post">
                <?php the_post_thumbnail('photo_content_cours'); ?>
                <div class="slider_post_txt">
                    <h2><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                </div>
                <a class="btn primary" href="<?php the_permalink();?>" title="Lien vers <?php the_title(); ?>">
                    <?php 
                if( get_field( 'titre_du_bouton' ) ): {
                    echo the_field('titre_du_bouton');
                } else : {
                    echo "Lire l'article";
                } endif; ?>
                </a>
            </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>

    </section>

    <!-- ------------------------------------- -->
    <!-- SEPARATOR -->
    <!-- ------------------------------------- -->

    <div class="separator" aria-hidden="true"></div>

    <section id="content">

        <div id="princ_info">
            <?php the_content(); ?>
        </div>

    </section>

    <?php endwhile; ?>

</div>

<?php
get_footer();