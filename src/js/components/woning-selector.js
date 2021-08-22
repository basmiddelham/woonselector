import $ from 'jquery';

// external js: isotope.pkgd.js

// $( function() {
//   $( "#slider-range" ).slider({
//     range: true,
//     min: 0,
//     max: 500,
//     values: [ 75, 300 ],
//     slide: function( event, ui ) {
//       $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
//     }
//   });
//   $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
//     " - $" + $( "#slider-range" ).slider( "values", 1 ) );
// } );

// initial values
var min = 0;
var max = 4000;

var prices = [];

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.grid-item',
  // filter with function
  filter: function( i, itemElem ) {
    var $number = $( itemElem ).find('.price');
    var number = parseInt( $number.text(), 10 );
    if ( prices.indexOf(number) === -1 ) {
      prices.push(number);
    }
    return number >= min && number <= max;
  }
});

console.log(prices);
max = Math.max.apply(Math, prices);
min = Math.min.apply(Math, prices);

var $range = $('.price-range').slider({
  range: true,
  min: min,
  max: max,
  values: [ min, max ],
  slide: function( event, ui ) {
    min = ui.values[0];
    max = ui.values[1];
    updateOutput();
    $grid.isotope();
  }
});

var $rangeOutput = $('.price-range-output');

function updateOutput() {
  $rangeOutput.text( min + ' - ' + max );
}

updateOutput();


// init Isotope
// var $grid = $('.grid').isotope({
//   itemSelector: '.grid-item',
//   layoutMode: 'vertical',
//   getSortData: {
//     name: '.name',
//     category: '.category',
//     building: '.building',
//     floor: '.floor',
//     type: '.type',
//   },
//   hiddenStyle: {
//     opacity: 0.4,
//     // transform: 'scaleY(1)'
//   },
//   visibleStyle: {
//     opacity: 1,
//     // transform: 'scaleY(1)'
//   },
//   // stagger: 50
// });
// var iso = $grid.data('isotope');
// var $filterCount = $('.filter-count');

// // bind filter button click
// $('#filters').on( 'click', 'button', function() {
//   var filterValue = $( this ).attr('data-filter');
//   // use filterFn if matches value
//   filterValue = filterFns[ filterValue ] || filterValue;
//   $grid.isotope({ filter: filterValue });
//   updateFilterCount();
// });


// // bind sort button click
// $('#sorts').on( 'click', 'button', function() {
//   var sortValue = $(this).attr('data-sort-value');
//   $grid.isotope({ sortBy: sortValue });
//   updateFilterCount();
// });

// // store filter for each group
// var filters = {};

// $('.filters-select').on( 'change', function( event ) {
//   var $select = $( event.target );
//   // get group key
//   var filterGroup = $select.attr('value-group');
//   // set filter for group
//   filters[ filterGroup ] = event.target.value;
//   // combine filters
//   var filterValue = concatValues( filters );
//   // set filter for Isotope
//   $grid.isotope({ filter: filterValue });
//   updateFilterCount();
// });

// // flatten object by concatting values
// function concatValues( obj ) {
//   var value = '';
//   for ( var prop in obj ) {
//     value += obj[ prop ];
//   }
//   return value;
// }


// function updateFilterCount() {
//   $filterCount.text( iso.filteredItems.length + ' items' );
// }

// updateFilterCount();


// // change is-checked class on buttons
// $('.button-group').each( function( i, buttonGroup ) {
//   var $buttonGroup = $( buttonGroup );
//   $buttonGroup.on( 'click', 'button', function() {
//     $buttonGroup.find('.is-checked').removeClass('is-checked');
//     $( this ).addClass('is-checked');
//   });
// });
  
