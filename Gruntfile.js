module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        php: {
            dev: {
                options: {
                    hostname: '0.0.0.0',
                    port: 4000,
                    base: 'site',
                    keepalive: true
                }
            }
        },
        sass: {
            options: {
                includePaths: [
                    './bower_components/bourbon/app/assets/stylesheets/',
                    './bower_components/bitters/app/assets/stylesheets/',
                    './bower_components/neat/app/assets/stylesheets/'
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
            php: {
                files: ['site/index.php'],
                tasks: ['php:dev'],
                options: {
                    livereload: true
                }
            },
            sass: {
                files: ['site/assets/sass/style.scss'],
                tasks: ['sass:dev'],
                options: {
                    livereload: true
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-php');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', [
        'sass',
        'php',
        'watch'
    ]);
};
