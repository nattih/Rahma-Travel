jQuery(document).ready(function($){
	/** Preloader **/
	$(window).on('load', function() {
		$("#resoto-preloader").fadeOut("slow");
	});

	/** Sidemenu **/
	var resoto_smenu = $('#simple-menu').sidr({
		name: 'resoto-smenu',
		source: '#resoto-sidemenu'
	});

	$('body').on('click', ':not(.sidr)', function() {
		$.sidr('close', 'resoto-smenu');
	});

	/** Wow & Animate js **/
	new WOW().init();

	/** Resoto Main Slider **/
	var rtl_site = false;
	rtl_site = $('body').hasClass('rtl') ? true : false;
	var resoto_slider = $('.resoto-slider').owlCarousel({
		items: 1,
		nav: true,
		navText: ['<i class="lni-angle-double-left"></i>', '<i class="lni-angle-double-right"></i>'],
		navElement: 'span',
		loop: true,
		dots: true,
		rtl: rtl_site
	});

	resoto_slider.on('changed.owl.carousel', function(event) {
		var item = event.item.index - 2;     // Position of the current item
		$('.caption-text *').removeClass('animated fadeInUp');
		$('.owl-item').not('.cloned').eq(item).find('.caption-text *').addClass('animated fadeInUp');
	});

	/** Search Popup **/
	$('.resoto-search > span').on('click', function(e) {
		e.preventDefault();

		$(this).next('.resoto-search-form').addClass('active');
	});

	$('.resoto-search-form span').on('click', function(e) {
		e.preventDefault();

		$(this).parents('.resoto-search-form').removeClass('active');
	});

	/** Cart Remove item **/
	$('.hb_mini_cart_remove').on('click', function() {
		var cart_qty = $(this).parents('.resoto-hotelcart').find('i.resoto-cart-qty');
		var qty = cart_qty.text();
		qty = parseInt(qty);
		qty -= 1;
		cart_qty.text(qty);
	});

	/** Single Room Gallery **/
	$('.resoto_hb_gallery').owlCarousel({
		items: 1,
		nav: true,
		navText: ['<i class="lni-arrow-left"></i>', '<i class="lni-arrow-right"></i>'],
		navElement: 'span',
		loop: true,
		dots: true,
		singleItem: true,
		dots: true
	});

	$(window).on('scroll', function(){
		if( $(window).scrollTop() >= 500 ) {
			$('#resoto-goto-top').addClass('active');
		} else {
			$('#resoto-goto-top').removeClass('active');
		}
	});	

	/** Scroll To Top **/
	$("#resoto-goto-top").on( 'click', function(e) {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});

    $(document).on('focusin', 'li.menu-item a', function(event) {
        $(this).parent('li.menu-item').addClass('is-focused');
        $(this).parent().siblings('li.menu-item').removeClass('is-focused');
    });

    $(document).on('focusin', '#simple-menu', function(event) {
        $(this).trigger('click');
    });

    $('#simple-menu').blur(function(event) {
        $('#content').trigger('click');
    });

});