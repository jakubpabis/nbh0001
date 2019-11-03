'use strict';

(function($) {
	$.each(['show', 'hide'], function(i, ev) {
		var el = $.fn[ev];
		$.fn[ev] = function() {
			this.trigger(ev);
			return el.apply(this, arguments);
		};
	});
})(jQuery);

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookieMessage()
{
	if(getCookie('cookieConfirm') !== 'yes') {
		document.getElementById('cookieMessage').classList.add('show');
	}
}

function cookieAgree()
{
	setCookie('cookieConfirm', 'yes', 365);
	document.getElementById('cookieMessage').classList.remove('show');
}

var freezeVp = function(e) {
    e.preventDefault();
};

function stopBodyScrolling (bool) {
    if (bool === true) {
        document.body.addEventListener("touchmove", freezeVp, false);
    } else {
        document.body.removeEventListener("touchmove", freezeVp, false);
    }
}

/**
 * Parse url
 */
function urlParser($url)
{	
	var parser = document.createElement('a');
	parser.href = $url;

	var $result = parser.hostname;

	return $result;
}

function slideTo(el)
{
	$('html, body').animate({
		scrollTop: $(el).offset().top-60
	}, 500);
}

function menuScroll()
{
	var $nav = $('.main-navigation');
	var $scroll = $(window).scrollTop();
	if($scroll >= 100) {
		if(!$nav.hasClass('scrolled')) {
			$nav.addClass('scrolled');
		}
	} else {
		if($nav.hasClass('scrolled')) {
			$nav.removeClass('scrolled');
		}
	}
}

function menuOpen(el)
{
	if($(el).hasClass('opened')) {
		$('.main-menu-container').removeClass('opened');
		$(el).removeClass('opened');
		$(el).find('i').removeClass().addClass('fas fa-bars');
	} else {
		$(el).find('i').removeClass().addClass('fas fa-times');
		$(el).addClass('opened');
		$('.main-menu-container').addClass('opened');
	}
}

function lazyImages()
{

	$('.lazyset').each(function() {
		if($(this).visible( true ) && !$(this).hasClass('loaded')) {
			$(this).attr('srcset', $(this).data('srcset')).removeAttr('data-srcset').addClass('loaded');
		}
	});
	$('.lazy').each(function() {
		if($(this).visible( true ) && !$(this).hasClass('loaded')) {
			$(this).attr('src', $(this).data('src')).removeAttr('data-src').addClass('loaded');
		}	
	});
	
	$(window).on('scroll', function() {
	
		$('.lazyset').each(function() {
			if($(this).visible( true ) && !$(this).hasClass('loaded')) {
				$(this).attr('srcset', $(this).data('srcset')).removeAttr('data-srcset').addClass('loaded');
			}
		});
		$('.lazy').each(function() {
			if($(this).visible( true ) && !$(this).hasClass('loaded')) {
				$(this).attr('src', $(this).data('src')).removeAttr('data-src').addClass('loaded');
			}	
		});

	});

}

function plusOne(el)
{
	var newVal = parseInt($(el).val(), 10) + 1;
	$(el).val(newVal);
}

function minusOne(el)
{
	var newVal = parseInt($(el).val(), 10) - 1;
	if(newVal > 0) {
		$(el).val(newVal);
	}
}

function addToCartAjax()
{
 
	$(".single_add_to_cart_button").addClass("ajax_add_to_cart");

	$( ".post-type-archive-product" ).on( "click", ".quantity input", function() {
	return false;
	});

	$( ".archive" ).on( "change input", ".quantity .qty", function() {
		var add_to_cart_button = $( this ).parents( ".product" ).find( ".add_to_cart_button" );
		// For AJAX add-to-cart actions
		add_to_cart_button.data( "quantity", $( this ).val() );
		// For non-AJAX add-to-cart actions
		add_to_cart_button.attr( "href", "?add-to-cart=" + add_to_cart_button.attr( "data-product_id" ) + "&quantity=" + $( this ).val() );
	});

	$(".input-text.qty.text").bind('keyup mouseup', function () {
		var value = $(this).val();
	$(".product_quantity").val(value)
	});

	if ( typeof wc_add_to_cart_params === 'undefined' )
		return false;

	$( document ).on( 'click', '.ajax_add_to_cart', function(e) {
		e.preventDefault();
		var $thisbutton = $(this);          
		var $variation_form = $( this ).closest( '.variations_form' );
		var var_id = $variation_form.find( 'input[name=variation_id]' ).val();
		$( '.ajaxerrors' ).remove();
		var item = {},
			check = true;
			variations = $variation_form.find( 'select[name^=attribute]' );
			if ( !variations.length) {
				variations = $variation_form.find( '[name^=attribute]:checked' );
			}
			if ( !variations.length) {
				variations = $variation_form.find( 'input[name^=attribute]' );
			}
		variations.each( function() {
			var $this = $( this ),
				attributeName = $this.attr( 'name' ),
				attributevalue = $this.val(),
				index,
				attributeTaxName;
				$this.removeClass( 'error' );
			if ( attributevalue.length === 0 ) {
				index = attributeName.lastIndexOf( '_' );
				attributeTaxName = attributeName.substring( index + 1 );
				$this
					.addClass( 'required error' )
					.before( '<div class="ajaxerrors"><p>Please select ' + attributeTaxName + '</p></div>' )
				check = false;
			} else {
				item[attributeName] = attributevalue;
			}
		} );
		if ( !check ) {
			return false;
		}

		if ( $thisbutton.is( '.ajax_add_to_cart' ) ) {
			$thisbutton.removeClass( 'added' );
			$thisbutton.addClass( 'loading' );
			if ($( this ).parents(".variations_form")[0]){
			var product_id = $variation_form.find('input[name=product_id]').val();
			var quantity = $variation_form.find( 'input[name=quantity]' ).val();
							var data = {
							action: 'bodycommerce_ajax_add_to_cart_woo',
							product_id: product_id,
							quantity: quantity,
							variation_id: var_id,
							variation: item
							};
				}
			else {
			var product_id = $(this).parent().find(".product_id").val();
			var quantity = $(this).parent().find(".qty").val();
			var data = {
			action: 'bodycommerce_ajax_add_to_cart_woo_single',
			product_id: product_id,
			quantity: quantity
			};
			}

			$( 'body' ).trigger( 'adding_to_cart', [ $thisbutton, data ] );
			$.post( wc_add_to_cart_params.ajax_url, data, function( response ) {
				if ( ! response )
					return;
				var this_page = window.location.toString();
				this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );
				if ( response.error && response.product_url ) {
					window.location = response.product_url;
					return;
				}
				if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
					window.location = wc_add_to_cart_params.cart_url;
					return;
				} else {
					$thisbutton.removeClass( 'loading' );
					var fragments = response.fragments;
					var cart_hash = response.cart_hash;
					if ( fragments ) {
						$.each( fragments, function( key ) {
							$( key ).addClass( 'updating' );
						});
					}
					$( '.shop_table.cart, .updating, .cart_totals' ).fadeTo( '400', '0.6' ).block({
						message: null,
						overlayCSS: {
							opacity: 0.6
						}
					});
					$thisbutton.addClass( 'added' );
					if ( fragments ) {
						$.each( fragments, function( key, value ) {
							$( key ).replaceWith( value );
						});
					}
					$( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();
					$( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) &gt; *', function() {
					$( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();
					$( document.body ).trigger( 'cart_page_refreshed' );
					});
					$( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) &gt; *', function() {
					$( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
				});
				}
			});
			return false;
		} else {
			return true;
		}
	});

}

// function zoomImage(el)
// {
// 	$('.products__single-modal').find('.modal-body').empty().html('<img src="'+$(el).data("zoom")+'" class="bg-cover"/>');
// }

function centerZoom()
{
	var $img;
	$('.products__single-modal').on('show.bs.modal', function(el) {
		$img = ($(el['relatedTarget']).data('zoom'));
		$('.products__single-modal').find('.modal-body[data-zoom="'+$img+'"]').addClass('visible');
	});
	$('.products__single-modal').on('hidden.bs.modal', function(el) {
		$('.products__single-modal').find('.modal-body[data-zoom="'+$img+'"]').removeClass('visible');
	});
	$('.products__single-modal').on('shown.bs.modal', function() {
		$(this).find('.modal-body').animate({
			scrollTop: ($(this).find('img').height() - $(this).find('.modal-body').height()) / 2,
			scrollLeft: ($(this).find('img').width() - $(this).find('.modal-body').width()) / 2
		}, 200);
		$(window).on('resize', function() {
			$('.products__single-modal').find('.modal-body').animate({
				scrollTop: ($('.products__single-modal').find('img').height() - $('.products__single-modal').find('.modal-body').height()) / 2,
				scrollLeft: ($('.products__single-modal').find('img').width() - $('.products__single-modal').find('.modal-body').width()) / 2
			}, 200);
		});
	});
}

function cartOpen()
{
	if($('.cart').hasClass('opened')) {
		$('body').removeClass('modal-open');
		$('.cart').removeClass('opened');
		$('.cart-shadow').fadeOut(250);
	} else {
		$('body').addClass('modal-open');
		$('.cart').addClass('opened');
		$('.cart-shadow').fadeIn(250);
	}
}

$(document).ready(function() {

	var options = {
		prefetch: true,
		cacheLength: 10,
		onStart: {
			duration: 500, // Duration of our animation
			render: function ($container) {
				// Add your CSS animation reversing class
				$container.addClass('is-exiting');
				// Restart your animation
				smoothState.restartCSSAnimations();
			}
		},
		onReady: {
			duration: 500,
			render: function ($container, $newContent) {
				// Remove your CSS animation reversing class
				$container.removeClass('is-exiting');
				// Inject the new content
				$container.html($newContent);
			}
		},
		onAfter: function () {
			lazyImages();
		}
	},
	smoothState = $('#wrapper').smoothState(options).data('smoothState');

	centerZoom();
});

$(window).on('load', function() {

	lazyImages();
	var $owl = $('.owl-carousel');
	$owl.owlCarousel({
		loop: false,
		rewind: true,
		margin: 0,
		nav: false,
		dots: false,
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 2
			},
			768: {
				items: 3
			},
		}
	});
	
	$('.owl-next').click(function() {
		$owl.trigger('next.owl.carousel');
	});
	$('.owl-prev').click(function() {
		$owl.trigger('prev.owl.carousel');
	});

});