module.exports = function (grunt) {
    'use strict';

    grunt.registerTask('assets', [
        'bower-mapper',
        'uglify',
        'svg2png'
    ]);

    grunt.registerTask('develop', [
        'assets',
        'sass:dev',
        'concurrent'
    ]);

    grunt.registerTask('deploy', [
        'assets',
        'sass:deploy',
        'rsync',
        'clean'
    ]);

    grunt.registerTask('test', [
        'scsslint',
        'phplint'
    ]);

    grunt.registerTask('default', ['develop']);
};
