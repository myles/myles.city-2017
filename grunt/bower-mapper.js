module.exports = function (grunt) {
    'use strict';

    var config = {
        js: {
            src: [
                'jquery',
                'svg-injector',
                'FitText.js',
                'letteringjs'
            ],
            dest: 'site/assets/javascript/libs'
        }
    };

    grunt.config.set('bower-mapper', config);
};
