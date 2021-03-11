var gulp = require('gulp');
var config = require('../config.js');

gulp.task('copy:rootfiles', function() {
  // return gulp
  //   .src(config.src.root + '/*.*')
  //   .pipe(gulp.dest(config.dest.root));
});

gulp.task('copy:fonts', function() {
  return gulp
    .src(config.src.fonts + '/**/*.{ttf,eot,woff,woff2, otf,svg}')
    .pipe(gulp.dest(config.dest.fonts));
});

// gulp.task('copy:video', function() {
//   return gulp
//     .src(config.src.video + '/*.*')
//     .pipe(gulp.dest(config.dest.video));
// });

// gulp.task('copy:php', function() {
//   return gulp
//     .src(config.src.php + '/*.*')
//     .pipe(gulp.dest(config.dest.php));
// });
//
// gulp.task('copy:json', function() {
//   return gulp
//     .src(config.src.json + '/*.*')
//     .pipe(gulp.dest(config.dest.json));
// });

gulp.task('copy:lib', function() {
  return gulp
    .src(config.src.lib + '/**/*.*')
    .pipe(gulp.dest(config.dest.lib));
});

gulp.task('copy:csslibs', function() {
  return gulp
    .src(config.src.sass + '/separate-css/**/*.*')
    .pipe(gulp.dest(config.dest.css));
});

gulp.task('copy', [
  'copy:rootfiles',

  // 'copy:video',
  // 'copy:php',
  // 'copy:json'

  'copy:lib',
  'copy:csslibs',
  'copy:fonts',


]);
gulp.task('copy:watch', function() {
  gulp.watch(config.src.root + '/*.*', ['copy:rootfiles']);
  gulp.watch(config.src.fonts + '/*.{ttf,eot,woff,woff2,otf,svg}', ['copy:fonts']);

  // gulp.watch(config.src.video + '/*.*', ['copy:video']);
  // gulp.watch(config.src.php + '/*.*', ['copy:php']);
  // gulp.watch(config.src.json + '/*.*', ['copy:json']);
});
