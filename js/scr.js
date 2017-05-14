/* image nice change */
function niceImageChange() {
	$('.product-tiny-image').click(function() {
		var toShowImgId = $(this).data('imageid');

		$('.product-image').stop().animate({'opacity':'0'}, 600);

		$('.product-image[data-imageId="'+toShowImgId+'"]').stop().animate({'opacity':'1'},  600, function(){
			$('.product-image').removeClass('active');
			$('.product-image[data-imageId="'+toShowImgId+'"]').addClass('active');
		});

	return false;
	event.preventDefault();
	});
}

/* yTabs */
function yTabs() {
	var yTabsCap = $('.product-tab-caption');
	var yTabs = $('.product-tab');




	yTabsCap.click(function() {
		var tabId = $(this).data('ytabsid');
		yTabsCap.removeClass('active');
		yTabs.removeClass('active');

		$('.product-tab-caption[data-yTabsId="'+tabId+'"]').addClass('active');
		$('.product-tab[data-yTabsId="'+tabId+'"]').addClass('active').jNice();

	})

	$('.product-tab-caption.active').trigger('click');
}

function removeItem() {
	$('.cart-product-cancel a').click(function(){
		productInCartCount = $('#cart-product-count');
		productInCartCountword = $('#cart-product-countword');

		afterRemoveCount = +productInCartCount.html() - 1;

		$(this).closest('.cart-product-item').remove();
		productInCartCount.html('');
		productInCartCountword.html('');

		if (afterRemoveCount != 0) {productInCartCount.html(afterRemoveCount) }
			else {productInCartCount.html('товаров нет');};

		var stringNumber = afterRemoveCount.toString();
		var lastSymbol = stringNumber.charAt( stringNumber.lenght - 1 );

			 switch(lastSymbol)
          {
                       case '0','5','6','7','8','9': productInCartCountword.html('товаров');break;
                       case '1': productInCartCountword.html('товар');break;
                       case '2', '3', '4': productInCartCountword.html('товара');break;
          }

	})
	return false;
}

//$('.catalog-sort a').click(function() {
//	$(this).find('.sort-up').toggleClass('active');
//	$(this).find('.sort-down').toggleClass('active');
//	return false;
//})

function columinazer(itemsPerCount) {
	$('.top-menu .submenu-box .submenu-box-col').each(function() {
		var colItemsArray = [''];
		var colItemsCount = $(this).find('li').length;

		var x = 0;
		while (x < colItemsCount) {
			var li = $('.submenu-box-col li:eq('+x+')');
			colItemsArray.push('<li>'+li.html()+'</li>');
			x++;
		}

		if (colItemsCount % itemsPerCount == 1 &&  itemsPerCount !=2 ) { itemsPerCount++;}

		var strToInput = '<div class=\"submenu-box-col\"><ul>';
		var i = 1;
		while ( i <= colItemsCount){
			strToInput += colItemsArray[i];
			if (i % itemsPerCount == 0 && i == colItemsCount ) {
				strToInput += '</ul></div>';
			} 	if (i % itemsPerCount == 0 && i != colItemsCount ) {
					strToInput += '</ul></div><div class=\"submenu-box-col\"><ul>';
				}
			i++;
		}


		var papa = $(this).closest('.submenu-box');
		papa.find('.submenu-box-col').remove();
		papa.append(strToInput);


	})
}


$(document).ready(function() {
	/*submenu Slide down*/



	$('.top-menu>li').each(function() {
		var subMenuHeight = $('.sub-menu-w',this).height();

		$(this).find('.sub-menu-w').css({height:0,paddingTop:0, paddingBottom:0,display:'none'});
		$(this).hover(function() {
			$(this).find('.sub-menu-w').stop().show().animate({height:subMenuHeight,paddingTop:17, paddingBottom:20},300,'linear');
		},function() {
			$(this).find('.sub-menu-w').stop().animate({height:0,paddingTop:0,paddingBottom:0},300,'linear',function(){
				$(this).hide();
			});

		})

	});

	niceImageChange();
	yTabs();
	removeItem();
	columinazer(6);

	$('.product-add-exit').click(function() {
		$.fancybox.close();
	})


//	$('.catalog-sort a').click(function() {
//		var papa = $(this).closest('.sort-method');
//		papa.find('.sort-up').toggleClass('active').toggleClass('hidden');
//		papa.find('.sort-down').toggleClass('active').toggleClass('hidden');
//		return false;
//	})

	/* fancybox */
	$('.fancybox').fancybox({
		padding:8,
		nextEffect 	:	'fade',
		prevEffect : 'fade',
		fitToView: false,
		autoSize: true,
		changeSpeed : 600
	});

	/* input focus clear */
	$('input, textarea').focus(function() {
		var curentPh = $(this).attr('placeholder');
		$(this).attr('placeholder', '');
		var p = $(this).closest('.required').removeClass('required');

		$(this).focusout(function() {
			$(this).attr('placeholder', curentPh);
			if ($(this).val() == '' ) {$(p[0]).addClass('required')}
		});


	})



	/* placeholder */
	$('[placeholder]').each(function(){
	   $(this).watermark($(this).attr('placeholder'))
	});

	/* slick slider */
    $('.product-tiny-images').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        nextArrow: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
    });

    $('.similar .products-wrapper').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        nextArrow: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
        prevArrow: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
    });
});

$(window).load(function() {
	/* anything slider */
	$('#slider, #slider-small').anythingSlider({
		hashTags : false,
		autoPlay : true,
		resizeContents : false,
		buildStartStop : false,
		buildArrows  : false,
		buildNavigation : false,
		buildPageinfo : false,
		expand: true,
		delay  : sdelay
	});

});