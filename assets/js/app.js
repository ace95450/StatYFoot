/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)
require('../css/app.css');

/ -- Chargement du CSS
require('./css/style.css');
// -- Chargement du JS
require('./js/jquery.min');
require('./js/bootstrap.js');
require('./js/owl.carousel.min.js');
require('./js/main.js');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
