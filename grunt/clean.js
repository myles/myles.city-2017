module.exports = function (grunt) {
    'use strict';

    var config = {
        build: [
            './site/assets/css/style.*'
        ]
    };

    grunt.config.set('clean', config);
};
