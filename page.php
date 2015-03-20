<?php inc( 'atom', 'main-start' ); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php inc('molecule', 'page-header'); ?>
	<?php inc('template_part', 'content', 'content', 'page'); ?>
<?php endwhile; endif; ?>
<?php inc( 'atom', 'main-end' ); ?>
