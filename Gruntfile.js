module.exports = function (grunt) {
    'use strict';

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        php: {
            options: {
                hostname: '0.0.0.0',
                port: 4000,
                base: 'site',
                keepalive: true
            },
            watch: {
                options: {
                    livereload: true
                }
            }
        },
        sass: {
            options: {
                includePaths: [
                    './bower_components/bourbon/app/assets/stylesheets/',
                    './bower_components/bitters/app/assets/stylesheets/',
                    './bower_components/neat/app/assets/stylesheets/',
                    './bower_components/modular-scale/stylesheets/'
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
        }
    });

    grunt.loadNpmTasks('grunt-php');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-rsync');
    grunt.loadNpmTasks('grunt-phplint');
    grunt.loadNpmTasks('grunt-scss-lint');
    grunt.loadNpmTasks('grunt-concurrent');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.task.loadTasks('./grunt/');
};
