(function($){

  // break every word, then
  // a word is highlighted for some period of time
  // a ball bounces above the word
  // the ball bounces to the next word
  $(document).ready(function(){
    var words = $('#sing-a-long').text().split(' ');
    var word_instances = {};
    var current_word = null;
    var current_word_index = -1;
    var current_tick = 0; // relative to each word

    function make_class( str ){
        return 'singalong-' + str.replace(/\s+/g, '-').toLowerCase();
    }

    $( words ).each(function( index, val ){
      if ( ! word_instances[ val ] ) {
        word_instances[ val ] = {
          count: 1,
          timer: Math.ceil( val.length / 3 ),
          classes: make_class( val )
        };
      }
      else {
        word_instances[ val ].count += 1;
      }
    });

    setInterval( function(){
      // if the current word timer is less than the current_tick, continue
      if ( current_word && word_instances[ current_word ] &&
          ( word_instances[ current_word ].timer < current_tick )
         )
      {
        // increment the tick
        current_tick += 1;
      }
      // otherwise, move to the next word
      else if ( words[ current_word_index ] ) {
        current_word_index += 1;
        current_word = words[ current_word_index ];
      }

      // TODO ensure the current word is highlit

    }, 1000 );
  });

})(jQuery);