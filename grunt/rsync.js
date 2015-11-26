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
        nfs: {
            options: {
                src: './site/',
                dest: '/home/public',
                host: 'nfs_myles-city',
                delete: true
            }
        }
    };

    grunt.config.set('rsync', config);
};
