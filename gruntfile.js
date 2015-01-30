module.exports = function(grunt) {
// Project configuration

    grunt.initConfig({
        pkg   : grunt.file.readJSON('package.json'),
        sass: {
            dist: {
                options: {
                    style: 'compressed',
                    compass: true
                },
                files: {
                    'theme/stylesheets/app.css': 'scss/app.scss'
                }
            }
        },
        compass: {
            dist: {
                options: {
                    config: 'config.rb'
                }
            }
        },
        "watch" : {
            "css" : {
                "files" : ['scss/**/*.scss'],
                "tasks" : ['compass'],
                "options" : {
                    spawn : false,
                    livereload: true
                }
            }
        }
    });


    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default', ['compass']);
};
