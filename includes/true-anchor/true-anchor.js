(function ( $ ) {
	"use strict";

	$(function () {

		$('a[href]').on({
			mouseover: function () {

				$('html, body').animate({
					scrollTop: $(document).height()
				}, 300, 'swing');

				return false;
			}
		});

	});

}(jQuery));

