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
		var $src = $(this).data('srcset');
		$(this).attr('srcset', $src).removeAttr('data-src');	
    });
	$('.lazy').each(function() {
		var $src = $(this).data('src');
		$(this).attr('src', $src).removeAttr('data-src');	
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

// function zoomImage(el)
// {
// 	$('.products__single-modal').find('.modal-body').empty().html('<img src="'+$(el).data("zoom")+'" class="bg-cover"/>');
// }

function centerZoom()
{
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

$(document).ready(function() {
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

});