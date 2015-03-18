require.config({
    baseUrl: '/wp-content/themes/ripples/assets/scripts',
    paths: {
        'jquery': '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min'
    }
});

require(['app'], function (App) {
    new App().init();
});