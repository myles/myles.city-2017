module.exports = function (grunt) {
    'use strict';

    var config = {
        all: {
            files: [{
                cwd: 'site/assets/images/',
                src: ['*.svg'],
                dest: 'site/assets/images/'
            }]
        }
    };

    grunt.config.set('svg2png', config);
};
