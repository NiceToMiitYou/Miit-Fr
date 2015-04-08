
var config = require('./gulp_config.js');

module.exports = {

    // Temp files
    TMP_CONCAT_DIST:  'app.concat.js',
    TMP_UGILFY_DIST:  'app.min.js',

    // Fonts files
    FONTS_ALL: [
        config.FRONTEND_RESOURCES + '/fonts/**.*'
    ],
    FONTS_DIST:       config.DIST + '/fonts/',

    // Sass files
    SASS_ALL:         config.FRONTEND_RESOURCES + '/sass/**.scss',
    SASS_FLEX_MASTER: config.FRONTEND_RESOURCES + '/sass/flex-it/master.scss',
    SASS_WWW_MASTER:  config.FRONTEND_RESOURCES + '/sass/www/master.scss',
    SASS_TEAM_MASTER: config.FRONTEND_RESOURCES + '/sass/team/master.scss',
    SASS_FLEX_DIST:   config.DIST + '/css/flex/',
    SASS_WWW_DIST:    config.DIST + '/css/www/',
    SASS_TEAM_DIST:   config.DIST + '/css/team/',

    // Libs of the scripts
    SCRIPTS_ALL: [
        config.FRONTEND_RESOURCES + '/scripts/**.js'
    ],
    SCRIPTS_DIST:     config.DIST + '/js/',

    // Libs of the project
    LIBS_ALL: [
        config.BOWER + '/react/react.min.js'
    ],
    LIBS_DIST:        config.DIST + '/lib/'
};