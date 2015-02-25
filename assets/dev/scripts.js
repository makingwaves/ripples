+function ( $ ) {
	'use strict';

	$( document ).ready(function( $ ) {

		if( _theme_config.load_fancybox && $.fn.fancybox ) {
			$( 'a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".gif"]' ).each(function() {
				var $this = $( this );
				var $wrap = $this.parents( '.gallery' );
				if( $wrap.length !== 0 ) {
					$this.attr( 'rel', $wrap.attr( 'id' ) );
				}
			}).fancybox({
				type: 			'image',
				maxWidth: 		'90%',
				maxHeight: 		'90%',
				openEffect: 	'elastic',
				closeEffect: 	'elastic',
				nextEffect: 	'elastic',
				prevEffect: 	'elastic'
			});
		}

		if( _theme_config.load_tooltips && $.fn.tooltip ) {
			$( '[rel="tooltip"]' ).tooltip();
		}

		if( _theme_config.load_popovers && $.fn.popover ) {
			$( '[rel="popover"]' ).popover();
		}

		if( _theme_config.wrap_embeds ) {
			$( 'iframe, embed, object' ).each(function() {
				var $this = $( this );
				if( $this.parents( '.embed-responsive' ).length === 0) {
					$this.wrap( '<div class="embed-responsive embed-responsive-16by9"></div>' );
				}
			});
		}

	});

}(jQuery);
