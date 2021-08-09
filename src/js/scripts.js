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


// init Isotope

// init Isotope
var iso = new Isotope( '.grid', {
  itemSelector: '.element-item',
  layoutMode: 'fitRows'
});

// filter functions
var filterFns = {
  // show if number is greater than 50
  numberGreaterThan50: function( itemElem ) {
    var number = itemElem.querySelector('.number').textContent;
    return parseInt( number, 10 ) > 50;
  },
  // show if name ends with -ium
  ium: function( itemElem ) {
    var name = itemElem.querySelector('.name').textContent;
    return name.match( /ium$/ );
  }
};

// bind filter button click
var filtersElem = document.querySelector('.filters-button-group');
filtersElem.addEventListener( 'click', function( event ) {
  // only work with buttons
  if ( !matchesSelector( event.target, 'button' ) ) {
    return;
  }
  var filterValue = event.target.getAttribute('data-filter');
  // use matching filter function
  filterValue = filterFns[ filterValue ] || filterValue;
  iso.arrange({ filter: filterValue });
});

// change is-checked class on buttons
var buttonGroups = document.querySelectorAll('.btn-group');
for ( var i=0, len = buttonGroups.length; i < len; i++ ) {
  var buttonGroup = buttonGroups[i];
  radioButtonGroup( buttonGroup );
}

function radioButtonGroup( buttonGroup ) {
  buttonGroup.addEventListener( 'click', function( event ) {
    // only work with buttons
    if ( !matchesSelector( event.target, 'button' ) ) {
      return;
    }
    buttonGroup.querySelector('.active').classList.remove('active');
    event.target.classList.add('active');
  });
}

// Isotope Filtering with select
var $filtersSelect = $('.filters-select');

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.element-item',
  layoutMode: 'fitRows',
  filter: $filtersSelect.val(),
});

// bind filter on select change
$filtersSelect.on( 'change', function() {
  // get filter value from option value
  $grid.isotope({ filter: this.value });
});
