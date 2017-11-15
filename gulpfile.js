var autoprefixer = require( 'autoprefixer' ),
    browserSync  = require( 'browser-sync' ).create(),
    cssnano      = require( 'cssnano' ),
    del          = require( 'del' ),
    gulp         = require( 'gulp' ),
    jscs         = require( 'gulp-jscs' ),
    lec          = require( 'gulp-line-ending-corrector' ),
    phpcs        = require( 'gulp-phpcs' ),
    postcss      = require( 'gulp-postcss' ),
    sass         = require( 'gulp-sass' ),
    scss         = require( 'postcss-scss' ),
    sort         = require( 'gulp-sort' ),
    stripDebug   = require( 'gulp-strip-debug' ),
    stylelint    = require( 'stylelint' ),
    svgSprite    = require( 'gulp-svg-sprite' ),
    todo         = require( 'gulp-todo' ),
    uglify       = require( 'gulp-uglify' ),
    util         = require( 'gulp-util' ),
    wpPot        = require( 'gulp-wp-pot' ),
    zip          = require( 'gulp-zip' );

var AUTOPREFIXER_BROWSERS = [
  'ie >= 10',
  'ie_mob >= 10',
  'ff >= 30',
  'chrome >= 34',
  'safari >= 7',
  'opera >= 23',
  'ios >= 7',
  'android >= 4.4',
  'bb >= 10'
];

var config = {
  name: 'cover2',
  production: !! util.env.production,
  report_loc: 'report',
  release_loc: 'release',
  svg_options: {
    mode: {
      symbol: {
        dest: 'img',
        sprite: 'sprites.svg',
        example: false
      }
    },
    svg: {
      xmlDeclaration: false,
      doctypeDeclaration: false,
      rootAttributes: {
        'id': 'icons',
        'class': 'hide'
      }
    }
  }
};

/**
 * Report all TODO, FIXME, and NOTE instances in the project.
 * Checks all PHP, Sass, and JavaScript files.
 */
gulp.task( 'todo', function() {
  del( [config.report_loc] );

  gulp.src(
    [
	    '!node_modules*',
      'assets/stylesheets/**/*.scss',
      'assets/js/**/*.js',
      '**/*.php'
    ]
  )
    .pipe( todo( {
      customTags: [
        'TODO',
        'FIXME',
        'NOTE',
        'XXX'
      ]
    } ) )
    .pipe( gulp.dest( config.report_loc ) );
});

/**
 * Remove all generated files.
 */
gulp.task( 'clean', function() {
  return del( [ 'dist', 'languages', config.report_loc, config.release_loc, 'style.css' ] );
} );

/**
 * Copy third-party scripts.
 */
gulp.task( 'copy', function() {
  return gulp.src( [
    'node_modules/headroom.js/dist/headroom*.js',
    'node_modules/flexslider/jquery.flexslider*.js',
    'node_modules/@vimeo/player/dist/player*.js',
    'node_modules/scrollnav/dist/jquery.scrollnav*.js'
  ] ).pipe( gulp.dest( 'dist/js' ) );
} );

/**
 * Lint the Sass stylesheet.
 */
gulp.task( 'stylelint', function() {
  var processors = [
    stylelint( {
      syntax: scss
    } )
  ];
  return gulp.src( './assets/stylesheets/**/*.scss' )
    .pipe( postcss( processors, {
      parser: scss
    } ) );
} );

/**
 * Compile the Sass stylesheet and run it through the PostCSS processor array.
 */
gulp.task( 'css', [ 'stylelint' ], function() {
  var processors = [
    autoprefixer( { browsers: AUTOPREFIXER_BROWSERS } )
  ];

  // Minify the stylesheet if we're running production tasks
  if ( config.production ) {
    processors.push( cssnano );
  }

  return gulp.src( './assets/stylesheets/**/*.scss' )
    .pipe( sass().on( 'error', sass.logError ) )
    .pipe( postcss( processors ) )
    .pipe( gulp.dest( './' ) )
    .pipe( browserSync.stream() )
    .pipe( lec() );
} );

/**
 * Lint the JavaScript.
 */
gulp.task( 'jscs', function() {
  return gulp.src( [
    'gulpfile.js',
    'assets/js/*.js'
  ] )
    .pipe( jscs() )
    .pipe( jscs.reporter() );
} );

/**
 * Strip debug statements and uglify the JavaScript.
 */
gulp.task( 'js', [ 'jscs' ], function() {
  return gulp.src( [
    'assets/js/*.js'
  ] )
    .pipe( config.production ? stripDebug() : util.noop() )
    .pipe( config.production ? uglify() : util.noop() )
    .pipe( gulp.dest( 'dist/js' ) );
} );

/**
 * Generate pot file.
 */
gulp.task( 'pot', function() {
  return gulp.src( [
    '!node_modules*',
    './**/*.php'
  ] )
    .pipe( sort() )
    .pipe( wpPot( {
      domain: config.name,
      destFile: config.name + '.pot',
      bugReport: 'https://eichefam.net/projects/cover2',
      headers: false
    } ) )
    .pipe( gulp.dest( 'languages' ) );
} );

/**
 * Lint PHP files. (Requires phpcs)
 */
gulp.task( 'phplint', function() {
  return gulp.src(
    [
      '**/*.php',
      '!node_modules/**'
    ]
  )
    .pipe( phpcs( {
      standard: 'codesniffer.ruleset.xml',
      warningSeverity: 0
    } ) )
    .pipe( phpcs.reporter( 'log' ) );
} );

/**
 * Generate SVG sprite.
 */
gulp.task( 'svg', function() {
  return gulp.src( [
      'assets/svg/*.svg'
    ] )
    .pipe( svgSprite( config.svg_options ) )
    .pipe( gulp.dest( 'dist' ) );
} );

/**
 * Create a task that ensures the `js` task is complete before
 * reloading browsers
 */
gulp.task( 'js-watch', [ 'js' ], function( done ) {
    browserSync.reload();
    done();
} );

/**
 * Compile the theme's assets.
 */
gulp.task( 'build', function() {
  gulp.start( 'copy', 'css', 'js', 'svg' );
} );

/**
 * Proxy server
 */
gulp.task( 'browser-sync', function() {
  browserSync.init( {
      proxy: 'localhost/wordpress'
  } );
} );

/**
 * Static Server + watching files.
 */
gulp.task( 'serve', [ 'browser-sync', 'build' ], function() {
  gulp.watch( 'assets/stylesheets/**/*.scss', [ 'css' ] );
  gulp.watch( 'assets/js/*.js', [ 'js-watch' ] );
  gulp.watch( 'assets/svg/*.svg', [ 'svg' ] );
  gulp.watch( '**/*.php' ).on( 'change', browserSync.reload );
} );

/**
 * The default task will run the `clean` task first, then the necessary tasks
 * for compiling the theme's assets, along with generating a translation file.
 */
gulp.task( 'default', [ 'clean' ], function() {
  gulp.start( 'build', 'pot' );
} );

/**
 * Create a zip archive of the compiled theme.
 */
gulp.task( 'zip', function() {
  del( [ config.release_loc ] );

  return gulp.src(
    [
      '!./assets',
      '!./assets/**/*',
      '!./node_modules',
      '!./node_modules/**/*',
      '!./release',
      '!./release/**/*',
      '!./report',
      '!./report/**/*',
      '!.*',
      '!*.js',
      '!*.json',
      '!*.log',
      '!*.md',
      '!*.xml',
      '**/*'
    ]
  )
    .pipe( zip( config.name + '.zip' ) )
    .pipe( gulp.dest( config.release_loc ) );
} );
