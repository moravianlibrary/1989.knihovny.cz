module.exports = function (grunt) {

    grunt.initConfig({
        watch: {
            style: {
                files: ['files_src/style/**/*.scss'],
                tasks: ['compass:dist'],
                options: {
                    spawn: false,
                }
            }
        },
        compass: {
            dist: {
                options: {  // Target options
                    sassDir: 'files_src/style',
                    cssDir: 'www/files/style',
                    environment: 'development'
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

    // grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.registerTask('default', ['watch:style']);
    grunt.registerTask('style', ['compass:dist']);
    grunt.registerTask('script', ['uglify']);

};
