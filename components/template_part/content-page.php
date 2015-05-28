<article <?php post_class('col center push'); ?>>
	<?php inc('molecule', 'page-header'); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
<?php //wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'ripples'), 'after' => '</p></nav>']); ?>