<?php inc( 'atom', 'main-start' ); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php inc('template_part', 'content', 'flexible-content', 'page'); ?>
<?php endwhile; endif; ?>
<?php inc( 'atom', 'main-end' ); ?>
