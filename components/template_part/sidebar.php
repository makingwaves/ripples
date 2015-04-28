<?php
$sidebar = !empty($value) ? 'sidebar-' . $value : 'sidebar-primary';
if ( is_active_sidebar( $sidebar ) ) { dynamic_sidebar($sidebar); }