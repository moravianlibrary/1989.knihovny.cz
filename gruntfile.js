module.exports = function (grunt) {

    grunt.initConfig({
        watch: {
            style: {
                files: ['files_src/style/**/*.scss'],
                tasks: ['sass:dist'],
            }
        },
        sass: {
            dist: {
                files: {
                    'www/files/style/style.css': 'files_src/style/style.scss'
                }
            }
        },
        uglify: {
            ugly: {
                files: {
                    'www/files/script/page.js': ['']
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.registerTask('default', ['watch:style']);
    grunt.registerTask('style', ['sass:dist']);
    grunt.registerTask('script', ['uglify']);

};
