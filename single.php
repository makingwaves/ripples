Single.php
<?php inc( 'atom', 'main-start' ); ?>
<?php get_template_part('components/template_part/content-single', get_post_type()); ?>
<?php inc( 'atom', 'main-end' ); ?>