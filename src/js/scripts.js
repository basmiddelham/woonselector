import $ from 'jquery';
import WebFont from 'webfontloader';
import 'magnific-popup';

import 'bootstrap/js/dist/alert'
import 'bootstrap/js/dist/base-component'
import 'bootstrap/js/dist/button'
import 'bootstrap/js/dist/carousel'
import 'bootstrap/js/dist/collapse'
import 'bootstrap/js/dist/dropdown'
import 'bootstrap/js/dist/modal'
import 'bootstrap/js/dist/offcanvas'
import 'bootstrap/js/dist/popover'
import 'bootstrap/js/dist/scrollspy'
import 'bootstrap/js/dist/tab'
import 'bootstrap/js/dist/toast'
import 'bootstrap/js/dist/tooltip'

import './components/navigation.js';
import './components/skip-link-focus-fix.js';
import './components/woning-selector.js';

// Web Font Loader
WebFont.load({
    google: {
        families: ['IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap'],
    }
});

// Magnific Lightbox image links
$('.lightbox').magnificPopup({
    type: 'image'
});

// Magnific Lightbox galleries
$('.gallery').each(function () { // the containers for all your galleries
    jQuery(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});

