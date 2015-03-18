<?php
/**
 * Created by Making Waves.
 * User: Peder A. Nielsen
 * Date: 12.06.14
 * Time: 09:34
 */
?>
<?php if(isset($value->img) && !empty($value->img)) : ?>
	<div class="img-flow ratio-<?php echo $value->ratio; ?>"><?php echo $value->img; ?></div>
<?php endif; ?>