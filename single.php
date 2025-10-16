<?php get_header(); ?>

<div class="type-page content-area">

    <?php while ( have_posts() ) :
			the_post();
		?>

    <h1>
        <?php the_title();?>
    </h1>

    <div id="princ_info">
        <?php the_content(); ?>
    </div>

    <?php endwhile; ?>

</div>

<?php
get_footer();