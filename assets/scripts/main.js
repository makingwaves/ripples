require.config((function () {
    var ripplesFolder = './wp-content/themes/ripples',
        jsFolder,
        bowerUrl;
    try {
        ripplesFolder = php_vars.themeURI;
    } catch (e) {}
    bowerUrl = ripplesFolder + '/bower_components/';
    jsFolder = ripplesFolder + '/assets/scripts';
    return {
        baseUrl: jsFolder,
        paths: {
            'jquery': '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min'/*,
            'jquery.sidr' : bowerUrl + 'sidr/jquery.sidr.min'*/
        },
        shim: {
            'jquery.sidr': {
                deps: ['jquery'],
                exports: 'jquery.sidr'
            }
        }
    };
})());

require(['app'], function (App) {
    new App().init();
});
