module.exports = function (grunt) {
    'use strict';

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json')
    });

    grunt.loadNpmTasks('grunt-php');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-rsync');
    grunt.loadNpmTasks('bower-mapper');
    grunt.loadNpmTasks('grunt-svg2png');
    grunt.loadNpmTasks('grunt-phplint');
    grunt.loadNpmTasks('grunt-scss-lint');
    grunt.loadNpmTasks('grunt-concurrent');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.task.loadTasks('./grunt/');
};
