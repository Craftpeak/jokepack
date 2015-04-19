/**
 * Jokepack - Magnet script
 */

(function($){

  /**
   * Simple console logging
   * @param  {String} logThis
   * @return {none}
   */
  function log(logThis) {
    console.log(logThis);
  }

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

  /**
   * Set the position of stuckWords to the cursor position
   */
  function attachStuckWordsToMouse(offset) {
    $('body').mousemove(function( event ) {
      $('#stuckWords').offset({
        left: event.pageX - offset,
        top: event.pageY- offset
      });
    });
  }

  $(document).ready(function() {
    var $magnet = $('#magnet')
        ,words = $magnet.text().split(' ')
        ,wrappedWords = wrapWords(words)
        ,$stuckWords = $('#stuckWords')
        ,stuckWordsOffset = $stuckWords.width()
        ,counter = 1
        ,rotationClass;

    // Make $stuckWords follow mouse
    attachStuckWordsToMouse(stuckWordsOffset);

    // Replace $magnet html
    $magnet.html(wrappedWords);

    $('body').on('hover', '.magnetized', function(event) {
      $this = $(this);

      if (! $this.hasClass('hidden')) {
        // Create new word element and hide it
        var $addedWord = $(document.createElement('span')).hide();

        // Append to stuckWords
        $stuckWords.append($addedWord);

        // Set rotation
        if (counter == 1) {
          rotationClass = 'bounce';
        }
        else if (counter == 2) {
          rotationClass = 'bounce__rotateNeg30';
        }
        else if (counter == 3){
          rotationClass = 'bounce__rotate60';
        }
        else if (counter == 4){
          rotationClass = 'bounce__rotateNeg60';
        }
        else if (counter == 5){
          rotationClass = 'bounce__rotate30';
        }

        // Add word content, position and style
        $addedWord
          .html($this.text())
          .css({
             left: -(($addedWord.width() - stuckWordsOffset) * 0.5)
            ,top: -(($addedWord.height() - stuckWordsOffset) * 0.5)
          })
          .addClass('word ' + rotationClass)
          .show()
          .addClass('bounce');
        
        // Hide original word
        $this.addClass('hidden');

        // Increment counter
        counter++;
        if (counter > 5) {
          counter = 1
        }
      }
    });
  });

})(jQuery);