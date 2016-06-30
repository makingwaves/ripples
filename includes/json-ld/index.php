<?php
/**
 * Created by Making Waves.
 * User: Peder A. Nielsen
 * Date: 17.06.2016
 * Time: 13.50
 */

namespace MW\Ripples\JsonLD;

//http://json-ld.org/
?>

<?php

global $jsonLDData;
//print_r($jsonLDData);

$jsonLD = [];

function getJsonLD($file, $value = null) {
	return json_decode( req( 'json-ld/types', $file, $value, $componentType = '', $path = 'includes' ) );
}


/////////////////////////

//this var could be used to decide which type file to load and could also set som vars that can be passed from the actual page / post / hook / atomic module etc to the json ld templ
//eg.
if(!empty($jsonLDData->type)) {
	switch($jsonLDData->type) {
		case 'frontpage':
			array_push( $jsonLD, getJsonLD('product', $jsonLDData->name) );
			break;

		default;
	}
}

//or we could do the logic here

//if ( is_home() ) {
//	array_push( $jsonLD, getJsonLD('home') );
//} else {
//	array_push( $jsonLD, getJsonLD('product', "Makrell") );
//}

/////////////////////////

if(!empty( $jsonLD )) :
	echo "<script type='application/ld+json'>\n"
		.json_encode( $jsonLD )."\n" //stripslashes for the forward slashes? Only on the url?
		."</script>\n";
endif;