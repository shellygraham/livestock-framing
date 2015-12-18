module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: ['script.js'],
        dest: 'script.min.js'
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      },
      dist: {
        files: {'script.min.js': '<%= concat.dist.dest %>'}
      }
    },
    watch: {
      scripts: {
        files: ['script.js'],
        tasks: ['concat','uglify'],
        options: {
          nospawn: true,
          interrupt: false,
          debounceDelay: 250,
          livereload: true,
        },
      }
    },
    notify_hooks: {
      options: {
        enabled: true,
        max_jshint_notifications: 5, // maximum number of notifications from jshint output 
        title: "Livestock Framing", // defaults to the name in package.json, or will use project directory's name 
        success: true, // whether successful grunt executions should be notified automatically 
        duration: 3 // the duration of notification in seconds, for `notify-send only 
      }
    }
  });
  
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('default', ['watch']);
};
