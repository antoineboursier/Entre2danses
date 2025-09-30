<?php
// Liste des cours et stages
?>

<div id="princ_thumb" class="categorie">
    <?php the_post_thumbnail('thumb_categorie' , ['class' => '']); ?>
</div>

<div id="princ_info" class="categorie">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p class="breadcrumbs reduce">','</p>');} ?>
    <h1><?php the_title();?> de danse</h1>
    <p class="reduce">Tous nos <?php if (is_page('les-cours')) { echo "cours"; } elseif (is_page('stage')) { echo "stages";    
    }?> de danse sur Villeneuve d’Ascq (Croix / Hem / Wasquehal / Lille / Roubaix)</p>
</div>

<div class="list_cat">

    <?php
    $categories = get_categories(array(
        'taxonomy' => 'category',
        'post_type' => 'cours',
        'hide_empty' => false
    ));

    if ($categories) {
        foreach ($categories as $category) {
            $args = array(
                'post_type' => 'cours',
                'category_name' => $category->slug,
                'posts_per_page' => -1
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                echo '<h2 class="category-title">' . $category->name . '</h2>';
                echo '<div class="list_cards">';
                
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>

    <a class="card" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php if( get_field('complete_cours') ): ?><p class="complete_tag">Cours complet</p><?php endif; ?>
        <?php the_post_thumbnail('thumb_vignette', array('class' => 'img_card')); ?>
        <div class="vign_txt">
            <h3>
                <?php the_title(); ?>
                <?php if (get_field('sous_titre')) : echo "<span>"; the_field('sous_titre'); echo "</span>"; endif; ?>
            </h3>
            <?php if (get_field('jour_de_cours')) : echo "<p class='day'>"; the_field('jour_de_cours'); echo "</p>"; endif; ?>
            <?php if (get_field('heure_debut')) : echo "<p class='horaire'>"; the_field('heure_debut'); echo " - "; echo the_field('heure_de_fin'); echo "</p>"; endif; ?>
        </div>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/imgs/chevron_dir.svg'); ?>" class="chevron_dir"
            alt="" />

    </a>

    <?php
                }

                echo '</div>';
            }

            wp_reset_postdata();
        }
    }
    ?>

</div>