<?php

use MW\Ripples\Config;
use MW\Ripples\Wrapper;

?>

<?php inc('atom', 'head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
	<div class="alert alert-warning">
		<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'ripples'); ?>
	</div>
    <![endif]-->
    <?php inc('organism', 'header'); ?>
    <div class="wrap container" role="document">
		<?php include Wrapper\template_path(); ?>

	    <?php if (Config\display_sidebar()) : ?>
		<aside class="sidebar" role="complementary">
			<?php include Wrapper\sidebar_path(); ?>
		</aside>
		<?php endif; ?>
    </div>
    <?php
        inc('organism', 'footer');
        wp_footer();
        include dirname( __FILE__ ) . '/includes/schema/index.php';
    ?>
  </body>
</html>
