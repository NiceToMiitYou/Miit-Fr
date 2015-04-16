
var config = require('./gulp_config.js');

module.exports = {

    // Temp files
    TMP_JS_CONCAT_DIST:  'app.concat.js',
    TMP_JS_UGILFY_DIST:  'app.min.js',
    TMP_CSS_CONCAT_DIST: 'master.concat.css',
    TMP_CSS_UGILFY_DIST: 'master.min.css',

    // Fonts files
    FONTS_ALL: [
        config.FRONTEND_RESOURCES + '/fonts/**/*.*'
    ],
    FONTS_DIST:          config.DIST + '/fonts/',

    // Sass files
    SASS_ALL: [
        config.FRONTEND_RESOURCES + '/sass/**/*.scss',
        config.APPS_RESOURCES     + '/sass/**/*.scss'
    ],
    SASS_AWESOME_MASTER: config.FRONTEND_RESOURCES + '/sass/font-awesome/font-awesome.scss',
    SASS_FLEX_MASTER:    config.FRONTEND_RESOURCES + '/sass/flex-it/master.scss',
    SASS_WWW_MASTER:     config.FRONTEND_RESOURCES + '/sass/www/master.scss',
    SASS_TEAM_MASTER:    config.FRONTEND_RESOURCES + '/sass/team/master.scss',
    SASS_APPS_MASTER:    config.APPS_RESOURCES + '/sass/master.scss',
    SASS_AWESOME_DIST:   config.DIST + '/css/font-awesome/',
    SASS_FLEX_DIST:      config.DIST + '/css/flex-it/',
    SASS_WWW_DIST:       config.DIST + '/css/www/',
    SASS_TEAM_DIST:      config.DIST + '/css/team/',
    SASS_APPS_DIST:      config.DIST + '/css/apps/',

    // Compile JSX templates 
    JSX_ALL: [
        config.FRONTEND_RESOURCES + '/jsx/**/*.jsx',
        config.APPS_RESOURCES     + '/jsx/**/*.jsx'
    ],
    JSX_DIST:            config.DIST + '/js/templates/',
    JSX_DIST_ALL:        config.DIST + '/js/templates/**/*.js',

    // Libs of the scripts
    SCRIPTS_ALL: [
        config.FRONTEND_RESOURCES + '/scripts/**/*.js'
    ],
    SCRIPTS_DIST:        config.DIST + '/js/',

    // Libs of the project
    LIBS_ALL: [
        config.BOWER + '/es5-shim/es5-shim.min.js',
        config.BOWER + '/es5-shim/es5-shim.map',
        config.BOWER + '/react/react-with-addons.min.js'
    ],
    LIBS_DIST:           config.DIST + '/lib/'
};