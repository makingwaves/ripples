<?php

switch($value) {
	case 'top_image':
		inc('atom', 'img-flow', (object)array(
			"img" => (object)array(
				"src" => get_sub_field('image'),
				"alt" => ""
			),
			"ratio" => '16-9'
		));
		echo '<p>'.get_sub_field('my_awesome_text').'</p>';
		break;
	case 'quote':
		echo '<p>'.get_sub_field('quote_text').'</p>';
		echo '<p>'.get_sub_field('quotee').'</p>';
		break;
	default:
		if(WP_DEBUG) {
			echo $value . ' not defined in swicth';
		}

}
