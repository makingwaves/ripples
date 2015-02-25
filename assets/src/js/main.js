require.config({
    "baseUrl": "<%= conf.get('contentDir') %>/themes/<%= conf.get('themeDir') %>/assets/src/js",
    "paths": {
        "jquery": "../../vendor/jquery/jquery"
    }
});

require(['jquery'], function($) {
    console.log('Working!!');
});