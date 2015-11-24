module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        php: {
            options: {
                hostname: '0.0.0.0',
                port: 4000,
                base: 'site',
                keepalive: true
            },
            watch: {
                options: {
                    livereload: true
                }
            }
        },
        sass: {
            options: {
                includePaths: [
                    './bower_components/bourbon/app/assets/stylesheets/',
                    './bower_components/bitters/app/assets/stylesheets/',
                    './bower_components/neat/app/assets/stylesheets/',
                    './bower_components/modular-scale/stylesheets/'
                ],
                sourceMap: true
            },
            dev: {
                files: {
                    'site/assets/css/style.css': 'site/assets/sass/style.scss'
                }
            }
        },
        watch: {
            sass: {
                files: ['site/assets/sass/*.scss'],
                tasks: ['sass:dev'],
                options: {
                    livereload: false
                }
            },
            css: {
                files: ['site/assets/css/*.css'],
                tasks: [],
                options: {
                    livereload: true
                }
            }
        },
        concurrent: {
            target: {
                tasks: ['php:watch', 'watch'],
                options: {
                    logConcurrentOutput: true
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-php');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-concurrent');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['sass', 'concurrent']);
};
