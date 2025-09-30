<?php get_header(); ?>

	<div class="type-page content-area">
		
		<?php while ( have_posts() ) :
			the_post();
		?>
			
				<h1>
					<?php the_title();?>
					<?php if( get_field( 'sous_titre' ) ): echo "<span>"; the_field('sous_titre'); echo "</span>"; endif; ?>
				</h1>			
			
		<?php endwhile; ?>

	</div>

<?php
get_footer();
