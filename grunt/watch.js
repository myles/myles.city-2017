module.exports = function (grunt) {
    'use strict';

    var config = {
        sass: {
            files: ['site/assets/sass/*.scss'],
            tasks: ['sass:dev'],
            options: {
                livereload: false
            }
        },
        css: {
            files: ['site/assets/css/*.css'],
            tasks: [],
            options: {
                livereload: true
            }
        }
    };

    grunt.config.set('watch', config);
};
