/**
 * Jokepack - Magnet script
 */

(function($){

  // TODO //
  // [done] Get all words
  // [done] Wrap each word with a span
  // [done] Add magnetized class and unique id to each word
  // [done] Track mouse position
  // Fix position of each word
  // On word hover
  // 1. Create duplicate word (added to new array)
  // 2. Hide old word
  // 

  /**
   * Simple console logging
   * @param  {String} logThis
   * @return {none}
   */
  function log(logThis) {
    console.log(logThis);
  }
  log('magnet.js script loaded');

  /**
   * Wraps each supplied word in html and returns new words
   * @param  {Array} words
   * @return {String}
   */
  function wrapWords(words) {
    var  wrappedWords = '';

    // Wrap each word with span
    $.each( words, function( key, value ) {
      if (key != 0) {
        wrappedWords += ' ';
      }
      wrappedWords += '<span id="magnetID_'+ key +'" class="magnetized">' + value + '</span>';
    });

    return wrappedWords;
  }

  function attachStuckWordsToMouse() {
    $('body').mousemove(function( event ) {
      $('#stuckWords').offset({left: event.pageX, top: event.pageY});
    });
  }

  $(document).ready(function() {
    var $magnet = $('#magnet')
        ,words = $magnet.text().split(' ')
        ,wrappedWords = wrapWords(words)
        ,$stuckWords = $('#stuckWords')
        ,counter = 1
        ,rotationClass;

    // Replace $magnet html
    $magnet.html(wrappedWords);

    // Make stuckWords follow mouse
    attachStuckWordsToMouse();

    $('body').on('hover', '.magnetized', function(event) {
      $this = $(this);

      if (! $this.hasClass('hidden')) {
        // Add hovered word to stuckWords
        $stuckWords.append($this[0].outerHTML);

        // Hide word
        $this.addClass('hidden');

        // Set rotation
        if (counter == 1) {
          rotationClass = '';
        }
        else if (counter == 2) {
          rotationClass = 'rotate30neg';
        }
        else if (counter == 3){
          rotationClass = 'rotate60';
        }
        else if (counter == 4){
          rotationClass = 'rotate60neg';
        }
        else if (counter == 5){
          rotationClass = 'rotate30';
        }

        // Position word
        $stuckWords.find('#'+ $this[0].id)
          .addClass(rotationClass)
          .css({
            left: '-' + $this.width()/2 + 'px'
          });

        // Increment counter
        counter++;
        if (counter > 5) {
          counter = 1
        }
      }
    });
  });

})(jQuery);