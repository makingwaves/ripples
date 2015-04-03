({
    baseUrl: '../assets/scripts',
    paths: {
        requireLib : '../../bower_components/requirejs/require'
    },
    include: ['requireLib'],
    out: '../dist/scripts/main.min.js',
    name: 'main',
    mainConfigFile: '../assets/scripts/main.js',
    preserveLicenseComments: false,
    optimizeCss: 'standard'
})