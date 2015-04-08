var gulp       = require('gulp');
var bower      = require('gulp-bower');
var clean      = require('gulp-clean');
var concat     = require('gulp-concat');
var sass       = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var react      = require('gulp-react');
var rename     = require('gulp-rename');
var gutil      = require('gulp-util');
var uglify     = require('gulp-uglify');


// Load the configuration
var config = require('./app/config/gulp_config.js');
var path   = require('./app/config/gulp_path.js');

// Default tasks
gulp.task('default', ['bower', 'copy', 'watch', 'build']);

gulp.task('bower', ['clean'], function() {
    // Bower install
    bower().pipe(gulp.dest(config.BOWER));
});

gulp.task('clean', function() {
    // Clean the dist folder
    return gulp.src(config.DIST, { read: false })
        .pipe(clean({force: true}));
});

gulp.task('copy', ['clean'], function() {
    // Copy libs
    gulp.src(path.LIBS_ALL)
        // Copy all libs files in LIBS_DIST
        .pipe(gulp.dest(path.LIBS_DIST));

    // Copy fonts
    return gulp.src(path.FONTS_ALL)
        // Copy all fonts files in FONTS_DIST
        .pipe(gulp.dest(path.FONTS_DIST));
});

gulp.task('sass', ['clean'], function () {
    // Compile SASS Master file of FLEX IT
    gulp.src(path.SASS_FLEX_MASTER)
        // Source map init
        .pipe(sourcemaps.init())

        // Compile sass
        .pipe(sass())

        // Source map write
        .pipe(sourcemaps.write('.'))

        // Destination of sass file
        .pipe(gulp.dest(path.SASS_FLEX_DIST))

        .on('error', gutil.log);
    
    // Compile SASS Master file of WWW
    gulp.src(path.SASS_WWW_MASTER)
        // Source map init
        .pipe(sourcemaps.init())

        // Compile sass
        .pipe(sass())

        // Source map write
        .pipe(sourcemaps.write('.'))

        // Destination of sass file
        .pipe(gulp.dest(path.SASS_WWW_DIST))

        .on('error', gutil.log);

    // Compile SASS Master file of TEAM
    gulp.src(path.SASS_TEAM_MASTER)
        // Source map init
        .pipe(sourcemaps.init())

        // Compile sass
        .pipe(sass())

        // Source map write
        .pipe(sourcemaps.write('.'))

        // Destination of sass file
        .pipe(gulp.dest(path.SASS_TEAM_DIST))

        .on('error', gutil.log);
});

gulp.task('concat-uglify', ['clean'], function() {
    // Uglify all scripts
    gulp.src(path.SCRIPTS_ALL)
        // Source map init
        .pipe(sourcemaps.init())

        // Concat
        .pipe(concat(path.TMP_CONCAT_DIST))

        // Uglify
        .pipe(uglify())

        // Rename in .min.js
        .pipe(rename(path.TMP_UGILFY_DIST))

        // Source map write
        .pipe(sourcemaps.write('.'))

        // Destination of uglifying
        .pipe(gulp.dest(path.SCRIPTS_DIST))

        .on('error', gutil.log);
});

gulp.task('build', ['sass', 'concat-uglify']);

gulp.task('watch', ['build'], function () {
    // Watch all sass files and compile them
    gulp.watch(path.SASS_ALL, ['sass']);

    // Watch all scripts and compile them
    gulp.watch(path.SCRIPTS_ALL, ['concat-uglify']);
});
