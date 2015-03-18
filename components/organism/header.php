<?php use MW\Ripples\Nav; ?>

<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

	<p id="logo" class="h1" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>

	<nav id="menu" class="primary-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<?php
	if (has_nav_menu('primary_navigation')) :
		wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'topmenu']);
	endif;
	?>
	</nav>

</header>
