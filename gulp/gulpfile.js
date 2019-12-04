const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const header = require( 'gulp-header' );

function styles() {
  return gulp.src('./src/sass/**/*.scss', {sourcemaps: true})
  .pipe(plumber({
    errorHandler: notify.onError("Error: <%= error.message %>")
  }))
  .pipe(sass({outputStyle: 'expanded'}))
  .pipe(header('@charset "UTF-8";\n\n'))
  .pipe(autoprefixer({
    cascade: false
  }))
  .pipe(gulp.dest('./css/', {sourcemaps: '../maps/'}))
}

function watch() {
  gulp.watch('./src/sass/**/*.scss', styles);
}

exports.styles = styles;
exports.default = watch;
