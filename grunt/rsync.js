module.exports = function (grunt) {
    'use strict';

    var config = {
        options: {
            exclude: [
                "assets/css/style.css.map",
                "assets/sass",
                "cache"
            ],
            args: ["--verbose"],
            recursive: true
        },
        prod: {
            options: {
                src: './site/',
                dest: '/srv/www/myles.city/www/html',
                host: 'bear',
                delete: true
            }
        }
    };

    grunt.config.set('rsync', config);
};
