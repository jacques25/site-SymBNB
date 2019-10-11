const $ = require('jquery');

global.$ = global.jQuery = $;
require('bootstrap');
require('./bootstrap-datepicker.min.js')

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
