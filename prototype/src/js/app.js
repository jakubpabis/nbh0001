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

function plusOne($el)
{
	var $input = $($el).parent().find('input[type="number"]');
	var maxVal = $input.attr('max');
	var newVal = parseInt($input.val(), 10) + 1;
	if(newVal <= maxVal) {
		$input.val(newVal);
	}
}

function minusOne($el)
{
	var $input = $($el).parent().find('input[type="number"]');
	var newVal = parseInt($input.val(), 10) - 1;
	if(newVal > 0) {
		$input.val(newVal);
	}
}

function selectChange()
{
	if($(document).find('.select > select').prop('selectedIndex') > 0){
		$(document).find('.select > select').prev('label').css({'display' : 'block'});
	}
	$(document).on('change', '.select > select', function() {
		if($(this).prop('selectedIndex') > 0){
			$(this).prev('label').fadeIn(200);
		} else {
			$(this).prev('label').fadeOut(200);
		}
		if($(document).find('input[name="quantity"]').attr('max') == 1) {
			$(document).find('input[name="quantity"]').parent().parent().css({'display' : 'none'});
		} else {
			$(document).find('input[name="quantity"]').parent().parent().css({'display' : 'block'});
		}
	});
}

function hideQty() 
{
	if($(document).find('input[name="quantity"]').attr('max') == 1) {
		$(document).find('input[name="quantity"]').parent().parent().css({'display' : 'none'});
	}
	$(document).on('change', 'input[name="quantity"]', function() {
		if($(this).attr('max') == 1) {
			$(this).parent().parent().css({'display' : 'none'});
		} else {
			$(this).parent().parent().css({'display' : 'block'});
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

$(document).ready(function() {

	if($('.products__single-modal')) {
		centerZoom();
	}
	selectChange();
	hideQty();

});

$(window).on('load', function() {

	lazyImages();

});