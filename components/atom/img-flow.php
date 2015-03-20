<?php
/**
 * Created by Making Waves.
 * User: Peder A. Nielsen
 * Date: 12.06.14
 * Time: 09:34
 */
?>
<?php if(!empty($value->img)) : ?>
	<div class="img-flow ratio-<?php echo $value->ratio; ?>"><img src="<?php echo $value->img->src; ?>" alt="<?php echo $value->img->alt; ?>"></div>
<?php endif; ?>