<?php
/**
 * Created by Making Waves.
 * User: Peder A. Nielsen
 * Date: 17.06.2016
 * Time: 13.50
 */

namespace MW\Ripples\Schema;
?>

<?php

function getJsonLD($file, $value = null) {
	return json_decode( req( 'schema/types', $file, $value, $componentType = '', $path = 'includes' ) );
}
$jsonLD = [];



/////////////////////////

array_push( $jsonLD, getJsonLD('header') );

if ( is_home() ) {
	array_push( $jsonLD, getJsonLD('home') );
} else {
	array_push( $jsonLD, getJsonLD('product', 'Makrell') );
}

/////////////////////////

?>

<? if(!empty( $jsonLD )) : ?>
<script type="application/ld+json">
<?php
	echo json_encode( $jsonLD );
?>
</script>
<?php endif; ?>