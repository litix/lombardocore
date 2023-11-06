// quick search regex
var qsRegex;
var checkboxFilter;

// templating
var colors = ['red', 'green', 'blue', 'orange'];
var sizes = ['small', 'medium', 'large'];
var prices = [10, 20, 30];

createItems();

// init Isotope
var $container = $('#container')

var $output = $('#output');

// filter with selects and checkboxes
var $checkboxes = $('#form-ui input');

function createItems() {

  var $items;
  // loop over colors, sizes, prices
  // create one item for each
  for (var i = 0; i < colors.length; i++) {
    for (var j = 0; j < sizes.length; j++) {
      for (var k = 0; k < prices.length; k++) {
        var color = colors[i];
        var size = sizes[j];
        var price = prices[k];
        var $item = $('<div />', {
          'class': 'item ' + color + ' ' + size + ' price' + price
        });
        $item.append('<p>' + size + '</p><p>$' + price + '</p>');
        // add to items
        $items = $items ? $items.add($item) : $item;
      }
    }
  }

  $items.appendTo($('#container'));

}
var $quicksearch = $('#quicksearch')

// debounce so filtering doesn't happen every millisecond
function debounce(fn, threshold) {
  var timeout;
  threshold = threshold || 100;
  return function debounced() {
    clearTimeout(timeout);
    var args = arguments;
    var _this = this;

    function delayed() {
      fn.apply(_this, args);
    }
    timeout = setTimeout(delayed, threshold);
  };
}

function Filter() {
  // map input values to an array
  var inclusives = [];
  // inclusive filters from checkboxes
  $checkboxes.each(function(i, elem) {
    // if checkbox, use value if checked
    if (elem.checked) {
      inclusives.push(elem.value);
    }
  });

  // combine inclusive filters
  var filterValue = inclusives.length ? inclusives.join(', ') : '*';

  var text = $quicksearch.val()

  $container.isotope({
    filter: function() {
      var $this = $(this)
      var checkText = text == '' ? true : $this.text().includes(text)
      var checkClass = inclusives.length == 0 ? true : false;
      $.each(inclusives, function(index, c) {
        var _class = $this.hasClass(c)
        if (_class) {
          checkClass = true;
          return;
        }
      })
      return checkText && checkClass
    }
  })
  $output.text(filterValue);
}

$quicksearch.on('input', debounce(function() {
  Filter()
}));

$checkboxes.change(function() {
  Filter()
});