module.exports = function (grunt) {
    'use strict';

    var config = {
        files: ['./site/index.php']
    };

    grunt.config.set('phplint', config);
};
