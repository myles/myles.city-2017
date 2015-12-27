module.exports = function (grunt) {
    'use strict';

    var config = {
        build: [
            './site/assets/css/style.*',
            './site/assets/fonts/',
            './site/assets/javascript/libs/'
        ]
    };

    grunt.config.set('clean', config);
};
