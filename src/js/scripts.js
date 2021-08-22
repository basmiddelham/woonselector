import $ from 'jquery';
import WebFont from 'webfontloader';
import 'magnific-popup';

import '@popperjs/core';
import bootstrap from 'bootstrap/dist/js/bootstrap'


import './components/navigation.js';
import './components/skip-link-focus-fix.js';
import './components/woning-selector.js';

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})


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

