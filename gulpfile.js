var autoprefixer = require('autoprefixer'),
    browserSync  = require('browser-sync').create(),
    cssnano      = require('cssnano'),
    del          = require('del'),
    gulp         = require('gulp'),
    jscs         = require('gulp-jscs'),
    lec          = require('gulp-line-ending-corrector'),
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
  name: 'recover',
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
      doctypeDeclaration: false
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
      '!bower_components*',
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
    'bower_components/headroom.js/dist/headroom.min.js',
    'bower_components/flexslider/jquery.flexslider-min.js'
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
    '!bower_components*',
    '!node_modules*',
    './**/*.php'
  ])
    .pipe(sort())
    .pipe(wpPot( {
      domain: config.name,
      destFile: config.name + '.pot',
      bugReport: 'https://eichefam.net/projects/recover',
      headers: false
    } ))
    .pipe(gulp.dest('languages'));
});

/**
 * Generate SVG sprite.
 */
gulp.task('svg', function() {
  return gulp.src([
      // Web App Icons
      'bower_components/Font-Awesome-SVG-PNG/black/svg/folder.svg',             // category
      'bower_components/Font-Awesome-SVG-PNG/black/svg/tag.svg',                // tag
      'bower_components/Font-Awesome-SVG-PNG/black/svg/pencil.svg',             // edit links

      // Post Format Icons
      'bower_components/Font-Awesome-SVG-PNG/black/svg/thumb-tack.svg',         // pinned posts
      'bower_components/Font-Awesome-SVG-PNG/black/svg/play-circle.svg',        // video
      'bower_components/Font-Awesome-SVG-PNG/black/svg/music.svg',              // audio
      'bower_components/Font-Awesome-SVG-PNG/black/svg/picture-o.svg',          // image
      'bower_components/Font-Awesome-SVG-PNG/black/svg/quote-right.svg',        // quote
      'bower_components/Font-Awesome-SVG-PNG/black/svg/sticky-note-o.svg',      // aside
      'bower_components/Font-Awesome-SVG-PNG/black/svg/link.svg',               // link
      'bower_components/Font-Awesome-SVG-PNG/black/svg/comments.svg',           // chat
      'bower_components/Font-Awesome-SVG-PNG/black/svg/comment.svg',            // status

      // Directional Icons
      'bower_components/Font-Awesome-SVG-PNG/black/svg/arrow-left.svg',
      'bower_components/Font-Awesome-SVG-PNG/black/svg/arrow-right.svg',
      'bower_components/Font-Awesome-SVG-PNG/black/svg/angle-down.svg'
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
      '!./bower_components',
      '!./bower_components/**/*',
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
