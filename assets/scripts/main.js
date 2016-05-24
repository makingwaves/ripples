require.config({
    baseUrl: '/wp-content/themes/ripples/assets/scripts',
    paths: {
        'jquery': '../../bower_components/jquery/dist/jquery'
    }

});

require(['app'], function (App) {
    new App().init();
});
