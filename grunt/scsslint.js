module.exports = function (grunt) {
    'use strict';

    var config = {
        allFiles: [
            './site/assets/scss/*.scss',
            './site/assets/scss/**/*.scss'
        ],
        options: {
            colourizeOutput: true
        }
    };

    grunt.config.set('scsslint', config);
};
