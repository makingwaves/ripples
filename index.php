<?php
/**
 * The main template file.
 *
 * @package mywptheme
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<main class="primary col-md-<?php echo ( is_active_sidebar( 'primary' ) ? 9 : 12 ); ?>" role="main">

				<?php if( have_posts() ) : ?>
					<?php while( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php edit_post_link( __( 'Edit Post', 'mywptheme' ), '<p class="text-right">', '</p>' ); ?>
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>

			</main>

			<?php if( is_active_sidebar( 'primary' ) ) : ?>
				<aside class="secondary col-md-3" role="complementary">
					<?php get_sidebar(); ?>
				</aside>
			<?php endif; ?>

		</div>
	</div>

<?php get_footer(); ?>
