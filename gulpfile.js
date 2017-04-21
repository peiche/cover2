var autoprefixer = require('autoprefixer'),
    browserSync  = require('browser-sync').create(),
    cssnano      = require('cssnano'),
    del          = require('del'),
    gulp         = require('gulp'),
    jscs         = require('gulp-jscs'),
    lec          = require('gulp-line-ending-corrector'),
    phpcs        = require('gulp-phpcs'),
    postcss      = require('gulp-postcss'),
    sass         = require('gulp-sass'),
    scss         = require('postcss-scss'),
    sort         = require('gulp-sort'),
    stripDebug   = require('gulp-strip-debug'),
    stylelint    = require('stylelint'),
    svgSprite    = require('gulp-svg-sprite'),
    todo         = require('gulp-todo'),
    uglify       = require('gulp-uglify'),
    util         = require('gulp-util'),
    wpPot        = require('gulp-wp-pot'),
    zip          = require('gulp-zip');

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
  production: !!util.env.production,
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
gulp.task('todo', function() {
  del([config.report_loc]);

  gulp.src(
    [
	    '!node_modules*',
      'assets/stylesheets/**/*.scss',
      'assets/js/**/*.js',
      '**/*.php'
    ]
  )
    .pipe(todo({
      customTags: [
        'TODO',
        'FIXME',
        'NOTE',
        'XXX'
      ]
    }))
    .pipe(gulp.dest(config.report_loc));
});

/**
 * Removes the generated files.
 */
gulp.task('clean', function() {
  return del(['dist', 'languages', config.report_loc, config.release_loc, 'style.css']);
});

gulp.task('copy', function() {
  return gulp.src([
    'node_modules/headroom.js/dist/headroom*.js',
    'node_modules/flexslider/jquery.flexslider*.js',
    'node_modules/@vimeo/player/dist/player*.js',
    'node_modules/svg-morpheus/compile/unminified/svg-morpheus.js'
  ]).pipe(gulp.dest('dist/js'));
});

/**
 * Lints the Sass stylesheet.
 */
gulp.task('stylelint', function() {
  var processors = [
    stylelint({
      syntax: scss
    })
  ];
  return gulp.src('./assets/stylesheets/**/*.scss')
    .pipe(postcss(processors, {
      parser: scss
    }));
});

/**
 * Compiles the Sass stylesheet and runs it through the PostCSS processor array.
 */
gulp.task('css', ['stylelint'], function() {
  var processors = [
    autoprefixer({browsers: AUTOPREFIXER_BROWSERS})
  ];

  // Minify the stylesheet if we're running production tasks
  if (config.production) {
    processors.push(cssnano);
  }

  return gulp.src('./assets/stylesheets/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss(processors))
    .pipe(gulp.dest('./'))
    .pipe(browserSync.stream())
    .pipe(lec());
});

/**
 * Lint and uglify the JavaScript.
 */
gulp.task('js', function() {
  return gulp.src('assets/js/*.js')
    .pipe(jscs())
    .pipe(jscs.reporter())
    .pipe(config.production ? stripDebug() : util.noop())
    .pipe(config.production ? uglify() : util.noop())
    .pipe(gulp.dest('dist/js'));
});

/**
 * Generate pot file.
 */
gulp.task('pot', function () {
  return gulp.src([
    '!node_modules*',
    './**/*.php'
  ])
    .pipe(sort())
    .pipe(wpPot( {
      domain: config.name,
      destFile: config.name + '.pot',
      bugReport: 'https://eichefam.net/projects/cover2',
      headers: false
    } ))
    .pipe(gulp.dest('languages'));
});

/**
 * Lint PHP files. (Requires phpcs)
 */
gulp.task('phplint', function() {
  return gulp.src(
    [
      '**/*.php',
      '!node_modules/**'
    ]
  )
    .pipe(phpcs({
      standard: 'codesniffer.ruleset.xml',
      warningSeverity: 0
    }))
    .pipe(phpcs.reporter('log'));
});

/**
 * Generate SVG sprite.
 */
gulp.task('svg', function() {
  return gulp.src([
      // Web App Icons
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_folder.svg',        // category
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_tag.svg',           // tag
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_pencil.svg',        // edit links

      // Post Format Icons
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_thumb-tack.svg',    // pinned posts
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_play-circle.svg',   // video
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_play-circle-o.svg', // video (hollow)
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_music.svg',         // audio
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_picture-o.svg',     // image
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_quote-right.svg',   // quote
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_sticky-note-o.svg', // aside
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_link.svg',          // link
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_comments.svg',      // chat
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_comment.svg',       // status

      // Directional Icons
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_arrow-left.svg',    // left arrow
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_arrow-right.svg',   // right arrow
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_angle-down.svg',    // down chevron
      
      // Aesop Icons
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_bookmark.svg',      // bookmark
      
      // Navigation Icons
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_bars.svg',          // menu
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_search.svg',        // search
      'node_modules/bem-font-awesome-icons/icon/_bg/icon_bg_times.svg'          // close "x"
    ])
    .pipe(svgSprite(config.svg_options))
    .pipe(gulp.dest('dist'))
});

/**
 * Create a task that ensures the `js` task is complete before
 * reloading browsers
 */
gulp.task('js-watch', ['js'], function (done) {
    browserSync.reload();
    done();
});

/**
 * Proxy server
 */
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: 'localhost/wordpress'
    });
});

/**
 * Static Server + watching scss/html files
 */
gulp.task('serve', ['browser-sync', 'copy', 'css', 'js', 'svg'], function() {
    gulp.watch('assets/stylesheets/**/*.scss', ['css']);
    gulp.watch('assets/js/*.js', ['js-watch']);
    gulp.watch('**/*.php').on('change', browserSync.reload);
});

/**
 * The default task will run the `clean` task first, then the `serve`, and `js`
 * tasks. The `serve` task will run the `css` task as a requirement.
 */
gulp.task('default', ['clean'], function() {
  gulp.start('copy', 'css', 'js', 'pot', 'svg');
});

gulp.task('zip', function() {
  del([config.release_loc]);

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
    .pipe(zip(config.name + '.zip'))
    .pipe(gulp.dest(config.release_loc));
});
