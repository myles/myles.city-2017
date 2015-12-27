module.exports = function (grunt) {
    'use strict';

    var config = {
        files: ['./site/*.php']
    };

    grunt.config.set('phplint', config);
};
