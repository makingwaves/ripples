<?php inc( 'atom', 'main-start' ); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php //inc('template_part', 'content', 'flexible-content', 'page'); //flexible content, includes components/template_part/content-page with 'flexible-content' as the name of acf flexible content value ?>
	<?php inc('template_part', 'content', null, 'page'); //standard page, includes components/template_part/content-page with no flexible layout  ?>
<?php endwhile; endif; ?>
<?php inc( 'atom', 'main-end' ); ?>
