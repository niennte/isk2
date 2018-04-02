$(window).load(centerImages = function(){
    setTimeout(function(){
		$("#productListings img.ui-li-thumb").each( function(){
			if($(this).height != 0)
				$(this).css('padding-top', ( 105-$(this).height() )/2+'px' );
			if($(this).width != 0)
				$(this).css('padding-left', 5+( 80-$(this).width() )/2+'px' );
		});
    }, 0);
});


$(document).off("pageinit").on("pageinit", function(event) {

	// disable cacheing
	$(document).on('pagebeforecreate', function () {
		$( '.ui-page' ).not( '.ui-page-active' ).remove();
		centerImages();
	});

	function isPositionFixedSupported() {
		return $( '[data-role="footer"]' ).css( 'position' ) === 'fixed';
	}

	// home page rotator
	$('#homePage').off('pageshow','displayRotator').on( 'pageshow', displayRotator = function() {
		$('.slider').flexslider({
			animation: "slide"
		});
	});



	// index page
	// format images for product listings

	$("#productListings img.ui-li-thumb").one('load', function(){
		$(this)
			.css('padding-top', ( 105-$(this).height() )/2+'px' )
			.css('padding-left', 5+( 80-$(this).width() )/2+'px' );
	});



	// product page

	// switch active option when its button is tapped
	$('.options .option img').off('tap').on('tap', function() {

		var nextSrc = $(this).attr('src');
		var activeImg = $('#activeImage');

		activeImg.parent().parent().css({
			background: "url(" + nextSrc + ") center top no-repeat",
			backgroundSize: 'contain'
		});

		activeImg.
			fadeOut(500, function() {
				$(this)
					.attr('src', nextSrc )
					.show();
			});

		$('#activeProductContainer p.optionTitle').html(
			$(this).closest('.option').find('.optionName').html()
		);

		$('#activeProductContainer [data-rel="popup"]').attr('href', '#popup'+$(this).attr('id'));

		if ($(this).closest('.option').find('.optionStock').html().length > 0 && $(this).closest('.option').find('.optionStock').html() == '0') {
			$('#activePrice')
				.html('Out of Stock')
				.closest('#addToCart')
				.removeClass('addToCart')
				.addClass('outOfStock');
		} else {
			$('#activePrice').html(
				$(this).closest('.option').find('.optionPrice').html()
			)
				.closest('#addToCart')
				.removeClass('outOfStock')
				.addClass('addToCart');
		}
		
		$('.activeHighlight').removeClass('activeHighlight');		       
		$(this).closest('.imageOrganizer').addClass('activeHighlight');	       

		$('#activeProductContainer .title').html( $(this).closest('.option').find('.optionTitle').html() );

		// replace option or color name -- currently hidden with CSS
		var optionName = $(this).closest('.option').find('.optionDescription').html();
		$('#activeProductContainer .subTitle.optionName').html( optionName );

		$('#activeProductContainer').add('#activeImageContainer').attr('class', $(this).attr('id') );

	});


	// Cart
	$('#addToCart.addToCart').off('tap').one('tap',function() {

		if ($(this).hasClass('outOfStock')) return false;

		var sku = $(this).closest('#activeProductContainer').attr('class');
		var skubase = $(this).closest('#singleProduct').attr('class');

		var button = $(this);
		button.find('.ui-btn-inner').css('background','#ddd');
		button.find('#activePrice').prepend('<img src="/historic/images/spinningred.gif" style="float:left;height:20px;"/>');

    	var addToCartMobile = function(sku, skubase, quantity) {

		if ( !sku || !skubase) return;
			quantity = quantity || 1;

			option = product['options'][sku];

			$.get( '/checkout/light?ajax=true&action=add&sku='+sku+'&quantity='+quantity,
			{ product : option },      
			function( response )
			{
				window.location = '/mobile/cart';
			});
		}
		addToCartMobile(sku, skubase);
	}); // addToCart handler	
    

    
    $('.productListItem .btn_remove').off("tap").one('tap',function(e) {

    	e.preventDefault();	    
    	var sku = $( this ).closest('.productListItem').attr('rel');
    	var cartIndex = $( this ).closest('.productItemContainer').attr('data-index');
    	    	
    	var removeItem = function(sku, index) {

		if ( !sku || !index ) { return; }
			$('#'+index).closest('.productListItem').fadeOut('slow', function() {

				$.get('/checkout/light?ajax=true&action=remove&sku='+sku+'&index='+index,
				function( response )
				{
					$('#'+index).closest('.productListItem').remove();
					window.location = '/mobile/cart';
				}); 
			});
		}
		removeItem( sku, cartIndex );
    });	 // remove handler





	$('.productListItem .btn_more').off("tap").on('tap',function() {

    	sku = $( this ).closest('.productListItem').attr('rel');
    	cartIndex = $( this ).closest('.productItemContainer').attr('id');

		$.get("/checkout/light", { ajax: 'true', quantity: 1, action: 'more', index: cartIndex }, function(response){

			var parts = response.split(':');
			var new_cart_total = parts.pop();
			var new_index = parts.shift();
			var new_quantity = parts.shift();
			var new_total_cost = parts.shift();
			var new_sub_total = parts.shift();


			if ( new_quantity == 0 ) {
				$('#'+new_index).find('.btn_remove').trigger('tap');
				return false;
			}

			$('#'+new_index+' .quantity').html(new_quantity);		
			$('#'+new_index+' .cartItemPrice').html('$'+new_total_cost);

			$('#cartTotal .total').html('$' + new_cart_total);
			
			
			// adjust promos
			 while (parts.length)
			{
				var other_index = parts.shift();
				var other_quantity = parts.shift();
				var other_total_cost = parts.shift();
				var other_sub_total = parts.shift();
								
				$('#'+other_index+' .quantity').html(new_quantity);		
				if (other_total_cost < 0) $('#'+other_index+' .cartItemPrice').html('-$'+(-other_total_cost).toFixed(2));
				else $('#'+other_index+' .cartItemPrice').html('$'+other_total_cost);
					
				if (other_quantity == 0) $('#row' + other_index).hide();
				
				if ( other_quantity == 0 ) {
					$('#'+other_index).closest('.productListItem').hide();
					return false;
				}
			}
		});
		return false;
	}); // more handler



	$('.productListItem .btn_less').off("tap").on('tap',function() {

    	sku = $( this ).closest('.productListItem').attr('rel');
    	cartIndex = $( this ).closest('.productItemContainer').attr('id');
    	
    	var currentQuantity = $('#'+cartIndex +' .quantity').html();
    	if ( currentQuantity == 1 ) {
    		$('#'+cartIndex).find('.btn_remove').trigger('tap');
		return;
	}

		$.get("/checkout/light", { ajax: 'true', quantity: 1, action: 'less', index: cartIndex },
		function(response){
			var parts = response.split(':');
			var new_cart_total = parts.pop();
			var new_index = parts.shift();
			var new_quantity = parts.shift();
			var new_total_cost = parts.shift();
			var new_sub_total = parts.shift();

			if ( new_quantity == 0 ) {
				$('#'+new_index).find('.btn_remove').trigger('tap');
				return false;
			}

			$('#'+new_index+' .quantity').html(new_quantity);		
			$('#'+new_index+' .cartItemPrice').html('$'+new_total_cost);	

			$('#cartTotal .total').html('$' + new_cart_total);

			// adjust other items
			 while (parts.length)
			{
				var other_index = parts.shift();
				var other_quantity = parts.shift();
				var other_total_cost = parts.shift();
				var other_sub_total = parts.shift();
								
				$('#'+other_index+' .quantity').html(new_quantity);		
				if (other_total_cost < 0) $('#'+other_index+' .cartItemPrice').html('-$'+(-other_total_cost).toFixed(2));
				else $('#'+other_index+' .cartItemPrice').html('$'+other_total_cost);
					
				if (other_quantity == 0) $('#row' + other_index).hide();
				
				if ( other_quantity == 0 ) {
					$('#'+other_index).closest('.productListItem').hide();
					return false;
				}
			}
		});
		return false;
	}); // less handler



	// coupons
	$('#applyCoupon').one('tap',function() {

		var coupon = $('#coupon_code').val();
		$.get("/historic/checkout/index.php?ajax=true&coupon_code="+coupon, function( res ){
		      window.location = 'cart.php';
		});
	});
    				     
}); // document page init handler