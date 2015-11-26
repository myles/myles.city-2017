module.exports = function (grunt) {
    'use strict';

    var config = {
        options: {
            colourizeOutput: true
        },
        allFiles: [
            './site/assets/scss/*.scss',
            './site/assets/scss/**/*.scss'
        ]
    };

    grunt.config.set('scsslint', config);
};
