var util = require('gulp-util');

var production = util.env.production || util.env.prod || false;
var destPath = 'frontend/web/build';

var config = {
    env       : 'development',
    production: production,

    src: {
        root         : 'frontend/src',
        templates    : 'frontend/src/templates',
        templatesData: 'frontend/src/templates/data',
        pagelist     : 'frontend/src/index.yaml',
        sass         : 'frontend/src/sass',
        // path for sass files that will be generated automatically via some of tasks
        sassGen      : 'frontend/src/sass/generated',
        js           : 'frontend/src/js',
        img          : 'frontend/src/img',
        svg          : 'frontend/src/img/svg',
        icons        : 'frontend/src/icons',
        // path to png sources for sprite:png task
        iconsPng     : 'frontend/src/icons',
        // path to svg sources for sprite:svg task
        iconsSvg     : 'frontend/src/icons',
        // path to svg sources for iconfont task
        iconsFont    : 'frontend/src/icons',
        fonts        : 'frontend/src/fonts',
        lib          : 'frontend/src/lib',
        video        : 'frontend/src/video',
        php          : 'frontend/src/php',
        json         : 'frontend/src/json'
    },
    dest: {
        root : destPath,
        html : destPath,
        css  : destPath + '/css',
        js   : destPath + '/js',
        img  : destPath + '/img',
        fonts: destPath + '/fonts',
        lib  : destPath + '/lib',
        video : destPath + '/video',
        php   : destPath + '/php',
        json  : destPath + '/json'
    },

    setEnv: function(env) {
        if (typeof env !== 'string') return;
        this.env = env;
        this.production = env === 'production';
        process.env.NODE_ENV = env;
    },

    logEnv: function() {
        util.log(
            'Environment:',
            util.colors.white.bgRed(' ' + process.env.NODE_ENV + ' ')
        );
    },

    errorHandler: require('./util/handle-errors')
};

config.setEnv(production ? 'production' : 'development');

module.exports = config;
