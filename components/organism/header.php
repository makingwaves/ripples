<?php use MW\Ripples\Nav; ?>

<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

	<div id="logo" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo.svg" alt="<?php _e( 'To the frontpage', 'ripples' ); ?>" /></a></div>

	<nav id="primary-navigation" class="navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<?php
		if (has_nav_menu('main_menu')) :
			wp_nav_menu(['theme_location' => 'main_menu', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'main-menu']);
		endif;
		?>
	</nav>

</header>
