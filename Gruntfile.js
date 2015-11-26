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
