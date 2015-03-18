(function () {
    define(['jquery'], function ($) {
        "use strict";
        var App;

        App = function () {
            return {
                init: function () {
                    console.log('Hello App!');
                }
            };
        };

        return App;

    });
})();