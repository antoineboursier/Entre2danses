<?php get_header(); ?>

<div class="type-page content-area">

    <?php while ( have_posts() ) :
		the_post();?>

    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p class="breadcrumbs reduce">','</p>');} ?>
    <h1 class="title">
        <?php the_title();?>
    </h1>

    <div id="princ_info">
        <?php the_content(); ?>
    </div>

    <?php endwhile; ?>

</div>

<?php
get_footer();