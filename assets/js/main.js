(function ($, root, undefined) {
	$(function () {

		'use strict';

	  // banner
	  $('.banner').slick({
	    dots: true,
	    arrows: false,
			infinite: false,
			fade: true,
	    speed: 500,
	    slidesToShow: 1,
	    slidesToScroll: 1,
	    autoplay: true,
      autoplaySpeed: 7000,
      rows: 0
	  });

	  // slider responsive
		$('.slider-responsive').slick({
			dots: true,
			arrows: false,
			infinite: false,
			speed: 500,
			slidesToShow: 3,
      slidesToScroll: 1,
      rows: 0,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
    });

		/*  Default Scripts */
    /* ----------------------------------------- */
    // form control
		$("#search-box input, .wpcf7-form input, .wpcf7-form textarea").focus(function() {
  		$(this).parent().siblings('label').addClass('has-value');
  		$(this).addClass('val');
  	}).blur(function() {
  		var text_val = $(this).val();
  		if(text_val === "") {
  			$(this).parent().siblings('label').removeClass('has-value');
  			$(this).removeClass('val');
  		}
  	});

  	$('.wpcf7-form .date').blur(function() {
	    if( $(this).val().length === 0 ) {
	      $(this).addClass('not-value');
	    }
    });
    
		// phone mask
		var SPMaskBehavior = function (val) {
			  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
			}, spOptions = { onKeyPress: function(val, e, field, options) { field.mask(SPMaskBehavior.apply({}, arguments), options); } };
		$('.mask-phone, input[type="tel"]').mask(SPMaskBehavior, spOptions);

    // select wrap
		$('select').not('.multiple').wrap('<div class="select-box"></div>');

		// smoth scroll
		$('a.scroll, li.scroll a').click(function() {
		  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		    var target = $(this.hash); target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		    if (target.length) { $('html,body').animate({ scrollTop: target.offset().top }, 1000); return false; }
		  }
		});
		/* -----------------------------------------  Default Scripts */
	});
})(jQuery, this);