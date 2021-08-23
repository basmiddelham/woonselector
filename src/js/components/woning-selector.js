import $ from 'jquery';

// Price Range
// ------------------------------------>

// initial values
// var min = 0;
// var max = 4000;
// var pricesArray = [];

// // init Isotope
// var $grid = $('.grid').isotope({
//   itemSelector: '.grid-item',
//   // filter with function
//   filter: function( i, itemElem ) {
//     var $number = $( itemElem ).find('.price');
//     var number = parseInt( $number.text(), 10 );
//     // Gather all prices in an pricesArray
//     if ( pricesArray.indexOf(number) === -1 ) {
//       pricesArray.push(number);
//     }
//     return number >= min && number <= max;
//   }
// });

// // Calculate highest and lowest numbers
// max = Math.max.apply(Math, pricesArray);
// min = Math.min.apply(Math, pricesArray);

// // Initiate jQuery UI slider
// var $range = $('.price-range').slider({
//   range: true,
//   min: min,
//   max: max,
//   values: [ min, max ],
//   slide: function( event, ui ) {
//     min = ui.values[0];
//     max = ui.values[1];
//     updateOutput();
//     $grid.isotope();
//   }
// });

// // Display ranges text
// var $rangeOutput = $('.price-range-output');
// function updateOutput() {
//   $rangeOutput.text( min + ' - ' + max );
// }
// updateOutput();


// init Isotope
// initial values
var min = 0;
var max = 4000;
var pricesArray = [];


var $grid = $('.grid').isotope({
  layoutMode: 'vertical',
  itemSelector: '.grid-item',
  getSortData: {
    name: '.name',
    building: '.building',
    category: '.category',
    floor: '.floor',
    type: '.type',
    surface: '[data-surface] parseInt',
    price: '[data-price] parseInt',
    building: '[data-building]',
  },
  filter: function( i, itemElem ) {
    var $number = $( itemElem ).find('.price');
    var number = parseInt( $number.text(), 10 );
    // Gather all prices in an pricesArray
    if ( pricesArray.indexOf(number) === -1 ) {
      pricesArray.push(number);
    }
    return number >= min && number <= max;
  },
  sortAscending: {
    surface: false,
    price: false,
  },
  hiddenStyle: {
    opacity: 0,
  },
  visibleStyle: {
    opacity: 1,
  },
});

var iso = $grid.data('isotope');
var $filterCount = $('.filter-count span');

// Price Range
// ------------------------------------>
// Calculate highest and lowest numbers
max = Math.max.apply(Math, pricesArray);
min = Math.min.apply(Math, pricesArray);

// Initiate jQuery UI slider
var $range = $('.price-range').slider({
  range: true,
  min: min,
  max: max,
  values: [ min, max ],
  slide: function( event, ui ) {
    min = ui.values[0];
    max = ui.values[1];
    updateOutput();
    updateFilterCount();
    $grid.isotope();

  }
});

// Display ranges text
var $rangeOutput = $('.price-range-output');
function updateOutput() {
  $rangeOutput.text( min + ' - ' + max );
}
updateOutput();

$('#viewswitch').on( 'click' , function() {
  $('.grid').isotope('destroy');

  var $grid = $('.grid').isotope({
    itemSelector: '.grid-item',
    layoutMode: 'masonry',
  });
  
});

// Sort
$('.sort-button-group').on( 'click', 'button', function() {
  // Get the element name to sort
  var sortValue = $(this).attr('data-sort-value');
  // Get the sorting direction: asc||desc
  var direction = $(this).attr('data-sort-direction');
  // convert it to a boolean 
  var isAscending = (direction == 'asc');
  var newDirection = (isAscending) ? 'desc' : 'asc';
  // pass it to isotope 
  $grid.isotope({ sortBy: sortValue, sortAscending: isAscending });
  // Set new sort direction
  $(this).attr('data-sort-direction', newDirection);
  // Set icon
  var icon = $(this).find('.icon-sort');
  var otherIcons = $(this).siblings().find('.sort-down');
  icon.toggleClass('sort-down');
  otherIcons.toggleClass('sort-down');
});

// Filters
var filters = {};

$('.filters-select').on( 'change', function( event ) {
  var $select = $( event.target );
  // get group key
  var filterGroup = $select.attr('value-group');
  // set filter for group
  filters[ filterGroup ] = event.target.value;
  // combine filters
  var filterValue = concatValues( filters );
  console.log(filterValue);
  // set filter for Isotope
  $grid.isotope({ filter: filterValue });
  updateFilterCount();
});

// flatten object by concatting values
function concatValues( obj ) {
  var value = '';
  for ( var prop in obj ) {
    value += obj[ prop ];
  }
  return value;
}


function updateFilterCount() {
  $filterCount.text( iso.filteredItems.length );
}

updateFilterCount();


// change is-checked class on buttons
$('.sort-button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.active').removeClass('active');
    $( this ).addClass('active');
  });
});
