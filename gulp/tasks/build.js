var gulp        = require('gulp');
var runSequence = require('run-sequence');
var config      = require('../config');

gulp.task('build', function(cb) {
    config.setEnv('production');
    config.logEnv();
    build(cb);
});

gulp.task('build:dev', function(cb) {
    config.setEnv('development');
    config.logEnv();
    build(cb);
});

function build(cb) {
    runSequence(
      'clean',
        'sprite:svg',
        'svgo',
        'sass',
        'nunjucks',
        'webpack',
    'images',
    'copy',
      'list-pages',
      cb
);
}
