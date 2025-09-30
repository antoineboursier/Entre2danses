<?php get_header(); ?>

<div class="type-page content-area">
    <section id="principale">
        <div id="princ_info">
            <?php if (is_home() && !is_front_page()) : ?>
            <h1 class="page-title"><?php single_post_title(); ?></h1>
            <?php else : ?>
            <h1 class="page-title">Blog</h1>
            <?php endif; ?>
        </div>
    </section>

    <div class="separator" aria-hidden="true"></div>

    <?php if (have_posts()) : ?>

    <section id="content">
        <div class="posts-list">
            <?php
			// Démarrage de la boucle
			while (have_posts()) :
				the_post();
				?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-meta">
                    <span><?php echo get_the_date(); ?></span>
                </div>
                <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('thumb_vignette'); ?>
                    </a>
                </div>
                <?php endif; ?>
                <div class="post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn primary">Lire la suite</a>
            </article>
            <?php endwhile; ?>
        </div>
    </section>

    <?php else : ?>

    <section id="content">
        <h2>Rien à afficher</h2>
        <p>Désolé, aucun article ne correspond à votre recherche.</p>
    </section>

    <?php endif; ?>

</div>