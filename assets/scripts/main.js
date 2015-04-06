require.config({
    baseUrl: './wp-content/themes/ripples/assets/scripts',
    paths: {
        'jquery': '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min' //ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min
    }
});

require(['app'], function (App) {
    new App().init();
});