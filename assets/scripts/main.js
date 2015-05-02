require.config({
    baseUrl: '/example.dev/wp-content/themes/ripples/assets/scripts',
    paths: {
        'jquery': '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min'
    }

});

require(['app'], function (App) {
    new App().init();
});
