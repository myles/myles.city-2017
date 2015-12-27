module.exports = function (grunt) {
    'use strict';

    grunt.registerTask('develop', [
        'bower-mapper',
        'uglify',
        'sass:dev',
        'concurrent'
    ]);

    grunt.registerTask('deploy', [
        'bower-mapper',
        'uglify',
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
