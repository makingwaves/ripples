require.config((function () {
    var rjBaseUrl = './wp-content/themes/ripples';
    try {
        rjBaseUrl = php_vars.themeURI;
    } catch (e) {
        rjBaseUrl = './wp-content/themes/ripples';
    }
    rjBaseUrl += '/assets/scripts';
    return {
        baseUrl: rjBaseUrl,
        paths: {
            'jquery': '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min' //ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min
        }
    };
})());

require(['app'], function (App) {
    new App().init();
});
