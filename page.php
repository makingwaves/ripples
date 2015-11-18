<?php inc( 'atom', 'main-start' ); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php inc('template_part', 'content-page', null, basename(get_page_template_slug(), '.php'));  //standard page, includes components/template_part/content-page[-template] with no flexible layout ?>
<?php endwhile; endif; ?>
<?php inc( 'atom', 'main-end' ); ?>
