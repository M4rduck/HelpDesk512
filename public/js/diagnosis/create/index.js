// initialize Packery
var $grid = $('.grid').packery({
    itemSelector: '.grid-item',

    gutter: 10,
    // columnWidth helps with drop positioning
    columnWidth: 100
  });
  
  // make all grid-items draggable
  $grid.find('.grid-item').each( function( i, gridItem ) {
    var draggie = new Draggabilly( gridItem );
    // bind drag events to Packery
    $grid.packery( 'bindDraggabillyEvents', draggie );
  });

  $grid.on( 'dblclick', '.grid-item', function( event ) {
    // remove clicked element
    $grid.packery( 'remove', event.currentTarget )
      // shiftLayout remaining item elements
      .packery('shiftLayout');
  });

  $('.append-button').on('click', function() {
    // create new item elements
    var $items = $('<div class="grid-item grid-item--width2"></div>');
    // append items to grid
    $grid.append( $items )
      // add and lay out newly appended items
      .packery( 'appended', $items );
  });
//------------------------------------------------------------------------------------------Sub Categoria--------------------------------------------------------------------------------------

/*var $gridSub = $('.grid-sub-category').packery({
  itemSelector: '.grid-item-sub-category',

  gutter: 10,
  // columnWidth helps with drop positioning
  columnWidth: 100
});

// make all grid-items draggable
$gridSub.find('.grid-item-sub-category').each( function( i, gridItem ) {
  var draggie = new Draggabilly( gridItem );
  // bind drag events to Packery
  $gridSub.packery( 'bindDraggabillyEvents', draggie );
});

  $('.append-subcategory-button').on( 'click', function() {
    // create new item elements
    var $items = $('<div class="grid-item-sub-category"></div>');
    // append items to grid
    $gridSub.append( $items )
      // add and lay out newly appended items
      .packery( 'appended', $items );
  });*/