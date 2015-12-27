module.exports = function (grunt) {
    'use strict';

    var config = {
        target: {
            files: [{
                expand: true,
                cwd: 'site/assets/javascript/libs/',
                src: '*.js',
                dest: 'site/assets/javascript/libs/'
            }]
        }
    };

    grunt.config.set('uglify', config);
};
