module.exports = function (grunt) {
    'use strict';

    grunt.registerTask('run', [
        'sass:dev',
        'concurrent'
    ]);

    grunt.registerTask('deploy', [
        'sass:deploy',
        'rsync',
        'clean'
    ]);

    grunt.registerTask('test', [
        'scsslint',
        'phplint'
    ]);

    grunt.registerTask('default', ['run']);
};
