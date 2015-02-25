<?php
/**
 * The footer for our theme.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package mywptheme
 */
?>

	</div><!-- #content -->

	<footer role="contentinfo">

		<div class="container">

			<p class="copyright">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></p>

		</div>

	</footer>

<?php wp_footer(); ?>

</body>
</html>
