module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    assets_dir: 'assets/',
    less: {
      development: {
        options: {
          compress: true,
          yuicompress: true,
          optimization: 2
        },
        files: {
          "<%= assets_dir %>css/compiled.min.css": "<%= assets_dir %>css/src/app/app.less",
        }
      }
    },
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: [
          '<%= assets_dir %>js/src/bootstrap/*.js',
          '<%= assets_dir %>js/src/misc/*.js',
          '<%= assets_dir %>js/src/app/*.js'
        ],
        dest: '<%= assets_dir %>js/compiled.js'
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      },
      dist: {
        files: {
          '<%= assets_dir %>js/compiled.min.js': '<%= concat.dist.dest %>'
        }
      }
    },
    imagemin: {
      optimize: {
        options: {
          optimizationLevel: 5,
          svgoPlugins: [{ removeViewBox: false }]
        },
        files: [{
          expand: true, 
          cwd: 'assets/img/src/',
          src: ['*.{png,jpg,gif,svg}','**/*.{png,jpg,gif,svg}'],
          dest: 'assets/img/'
        }]
      }
    },
    watch: {
      images: {
        files: ['<%= assets_dir %>/img/src/*.{png,jpg,gif}','<%= assets_dir %>/img/src/**/*.{png,jpg,gif}'],
        tasks: ['newer:imagemin'],
        options: {
          nospawn: true,
          interrupt: false,
          debounceDelay: 250
        }
      },
      styles: {
        files: ['<%= assets_dir %>css/src/**/*.less','<%= assets_dir %>css/src/**/*.css'],
        tasks: ['less','concat','uglify'],
        options: {
          nospawn: true,
          interrupt: false,
          debounceDelay: 250,
          livereload: true,
        }
      },
      scripts: {
        files: ['<%= assets_dir %>js/src/**/*.js'],
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

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-notify');
  grunt.loadNpmTasks('grunt-newer');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('default', ['watch']);
};
