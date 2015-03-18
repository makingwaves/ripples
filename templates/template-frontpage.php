<?php
/**
	Template Name: Frontpage
 */
?>
template-frontpage.php
<?php inc( 'atom', 'main-start' ); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php inc('molecule', 'page-header'); ?>
	<?php get_template_part('components/template_part/content', 'page'); ?>
<?php endwhile; endif; ?>
<?php inc( 'atom', 'main-end' ); ?>