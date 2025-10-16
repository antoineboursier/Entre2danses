<?php get_header(); ?>

<div class="type-page content-area">

    <?php while ( have_posts() ) :
			the_post();?>

    <section id="principale">

        <!------------------->
        <!-- TEMPLATE HOME -->
        <!------------------->

        <?php if (is_page('les-cours')) {  

                    get_template_part('template-cours'); 

                } else { ?>

        <div id="princ_thumb">
            <?php the_post_thumbnail('thumb_page_cours' , ['class' => 'thumb']); ?>
        </div>
        <div id="princ_info">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p class="breadcrumbs reduce">','</p>');} ?>
            <h1 class="title">
                <?php the_title();?>
                <?php if( get_field( 'sous_titre' ) ): echo "<span>"; the_field('sous_titre'); echo "</span>"; endif; ?>
            </h1>
        </div>


        <?php } ?>

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

<!-- ------------------------------------- -->
<!-- SEPARATOR -->
<!-- ------------------------------------- -->

<div class="separator" aria-hidden="true"></div>

<!-- ------------------------------------- -->
<!-- COURS SIMILAIRES -->
<!-- ------------------------------------- -->

<?php
    // Récupérer les catégories du cours actuel
    $categories = get_the_category();
    if (!empty($categories)) {
        $category_ids = array();
        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }

        // Requête pour récupérer les autres cours ayant les mêmes catégories
        $args = array(
            'post_type' => 'cours',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'category__in' => $category_ids,
            'post__not_in' => array(get_the_ID()),
        );
        $query = new WP_Query($args);

        // Vérifier si des cours similaires ont été trouvés
        if ($query->have_posts()) {
            ?>
<div class="cours-similaires">
    <h2>Ces cours et stages peuvent aussi vous faire kiffer !</h2>
    <div>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
        <a href="<?php the_permalink();?>" class="cours-similaire-item">
            <?php the_post_thumbnail('cours_similaires'); ?>
            <h3>
                <?php the_title(); ?>
                <?php if( get_field( 'sous_titre' ) ): echo "<span>"; the_field('sous_titre'); echo "</span>"; endif; ?>
            </h3>
            <?php if( get_field( 'jour_de_cours' ) ): echo "<p class='day'>"; the_field('jour_de_cours'); echo "</p>"; endif; ?>
            <?php if( get_field( 'heure_debut' ) ): echo "<p class='horaire'>"; the_field('heure_debut'); echo " - "; echo the_field('heure_de_fin'); echo "</p>"; endif; ?>
        </a>
        <?php endwhile; ?>
    </div>
</div>
<?php
            // Réinitialiser la requête
            wp_reset_postdata();
        }
    }
    ?>

<?php
get_footer();