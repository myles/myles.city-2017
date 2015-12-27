module.exports = function (grunt) {
    'use strict';

    var config = {
        options: {
            includePaths: [
                './bower_components/bourbon/app/assets/stylesheets/',
                './bower_components/bitters/app/assets/stylesheets/',
                './bower_components/neat/app/assets/stylesheets/',
                './bower_components/modular-scale/stylesheets/',
                './bower_components/lato/scss/'
            ],
            sourceMap: true
        },
        dev: {
            files: {
                'site/assets/css/style.css': 'site/assets/sass/style.scss'
            }
        },
        deploy: {
            options: {
                outputStyle: 'compressed'
            },
            files: {
                'site/assets/css/style.css': 'site/assets/sass/style.scss'
            }
        }
    };

    grunt.config.set('sass', config);
};
