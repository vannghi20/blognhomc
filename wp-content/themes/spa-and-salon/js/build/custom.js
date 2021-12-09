jQuery(document).ready(function ($) {
	// The slider being synced must be initialized first
	$('#slider .slides').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		fade: true,
		arrows: true,
		asNavFor: '.nav-thumb',
		infinite: false
	});
	$('#carousel .nav-thumb').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		asNavFor: '.slides',
		dots: false,
		arrows: false,
		centerMode: false,
		focusOnSelect: true,
		infinite: false,
		responsive: [{

			breakpoint: 540,
			settings: {
				slidesToShow: 2,
			}
		}]
	});


	$('.mobile-nav .toggle-button').on( 'click', function() {
		$('.mobile-nav .main-navigation').slideToggle();
	});

	$('.mobile-nav-wrap .close ').on( 'click', function() {
		$('.mobile-nav .main-navigation').slideToggle();

	});

	// $('.mobile-nav .menu-item-has-children').prepend('<span class="submenu-toggle"></span>');

	// $('.mobile-nav .menu-item-has-children .submenu-toggle').on( 'click', function() {
	// 	$(this).siblings('ul').slideToggle();
	// 	$(this).toggleClass('open');
	// });


	$('<button class="submenu-toggle"></button>').insertAfter($('.mobile-nav ul .menu-item-has-children > a'));
	$('.mobile-nav ul li .submenu-toggle').on( 'click', function() {
		$(this).next().slideToggle();
		$(this).toggleClass('open');
	});

	if ($('.promotional-block .col').length > 0) {
		$('.text-holder').each(function () {
			new PerfectScrollbar($(this)[0]);
		});
	}

	if ($('.testimonial #slider .slick-slide').length > 0) {
		$('.text-holder .holder').each(function () {
			new PerfectScrollbar($(this)[0]);
		});
	}

	//accessible menu for edge
	 $("#site-navigation ul li a").on( 'focus', function() {
	   $(this).parents("li").addClass("focus");
	}).on( 'blur', function() {
	    $(this).parents("li").removeClass("focus");
	 });
});


