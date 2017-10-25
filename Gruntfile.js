module.exports = function(grunt) {
	var path = process.cwd();
	var cwd = path.substring( path.lastIndexOf( '/' ) + 1 );
	
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),
		cwd: cwd,
		copy: {
			main: {
				files: [ 
					{ expand: true, src: 'README.md', rename: function( dest, src ) { return src.replace( '.md', '.txt' ); } }
				]
			},
			prepare: {
				files: [
					{ expand: true, src: [ '**', '!Gruntfile.js', '!package.json', '!sass/**', '!node_modules/**', '!**/*.map' ], dest: '/home/stephen/<%= cwd %>', filter: 'isFile' }
				]
			}
		},
		sass: {
			devel: {
				options: {
					style: 'nested',
					sourcemap: 'auto',
					loadPath: path + '/sass/normalize',
					// update: true
				},
				files: [ {
					'style.css' : 'sass/style.scss',
					'rtl.css' : 'sass/rtl.scss',
					'inc/css/editor-style.css' : 'sass/editor-style.scss'
				} ]
			},
			prepare: {
				options: {
					style: 'compact',
					sourcemap: 'none',
					loadPath: path + '/sass/normalize',
					// update: true
				},
				files: [ {
					'style.css' : 'sass/style.scss',
					'rtl.css' : 'sass/rtl.scss',
					'inc/css/editor-style.css' : 'sass/editor-style.scss',
				} ]
			}
		},
		postcss: {
			options: {
      		map: false,
				processors: [
					require( 'autoprefixer' )( {
						browsers: [ '> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1' ]
        	} )
				]
    	},
    	dist: {
	    		src: [ 'style.css', 'rtl.css', 'inc/css/editor-style.css' ]
    	}
		},
		watch: {
			css: {
				files: '**/*.scss',
				tasks: [ 'sass:devel', 'postcss' ]
			},
			readme: {
				files: 'README.md',
				tasks: [ 'copy:main' ]
			}
		}
	} );
	grunt.loadNpmTasks( 'grunt-postcss' );
	grunt.loadNpmTasks( 'grunt-contrib-sass' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );
	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.registerTask( 'default', [ 'copy:main', 'sass:devel', 'postcss', 'watch' ] );
	grunt.registerTask( 'prepare', [ 'sass:prepare', 'postcss', 'copy:main', 'copy:prepare' ] );
}
