<?php
//http://codex.wordpress.org/Function_Reference/register_post_type
//add cpts
$customPostTypes = array(); //array('template-cpt-book');
for($i = 0; $i < count($customPostTypes); $i++) {
	require_once dirname( __FILE__ ) . '/'.$customPostTypes[$i].'.php';
}
