//////////////fancybox//////////////////////
    $(document).ready(function() {

	    $("a.gallery2").fancybox(
	    {						
	    "padding" : 3, // отступ контента от краев окна
	    "imageScale" : false, // Принимает значение true - контент(изображения) масштабируется по размеру окна, или false - окно вытягивается по размеру контента. По умолчанию - TRUE
	    "zoomOpacity" : false,	// изменение прозрачности контента во время анимации (по умолчанию false)
	    "zoomSpeedIn" : 0,	// скорость анимации в мс при увеличении фото (по умолчанию 0)
	    "zoomSpeedOut" : 0,	// скорость анимации в мс при уменьшении фото (по умолчанию 0)
	    "zoomSpeedChange" : 1000, // скорость анимации в мс при смене фото (по умолчанию 0)
//			"frameWidth" : 650,	 // ширина окна, px (425px - по умолчанию)
//			"frameHeight" : 450, // высота окна, px(355px - по умолчанию)
	    "overlayShow" : true, // если true затеняят страницу под всплывающим окном. (по умолчанию true). Цвет задается в jquery.fancybox.css - div#fancy_overlay 
	    "overlayOpacity" : 0.8,	 // Прозрачность затенения 	(0.3 по умолчанию)
	    "hideOnContentClick" :false, // Если TRUE  закрывает окно по клику по любой его точке (кроме элементов навигации). Поумолчанию TRUE		
	    "centerOnScroll" : false // Если TRUE окно центрируется на экране, когда пользователь прокручивает страницу		
	    });

	    
    });



/////////////BASKET FUNCTION/////////////////////////////////////////////////////////////////
    function GetTovarov(d)
    {
	    if(d%100>=11 && d%100<=19) return 'товаров';
	    if(d%10==0) return ' товаров';
	    if(d%10==1) return ' товар';
	    if(d%10==2) return ' товара';
	    if(d%10==3) return ' товара';
	    if(d%10==4) return ' товара';
	    return 'товаров';
    }


    function AddToBasket(id,price,size,num)
    {
	rand1 = Math.random();
	if(num == undefined) num = 1;
	if(size == undefined || size=='') size = '';

	$.ajax({
	    url: '/forajax.php?act=addtobasket&id='+id+'&num='+num+'&size='+size+'&rand1='+rand1, 
	    success: function (data, textStatus) {
		
		$('#product-add2').html(data);
		
		//alert('Товар добавлен в ваши заказы', 'Уважаемый покупатель');
        var c = $('.basketnum').html();
        c = c*1 + num*1;
        $('.basketnum').html(c);

        $('.baskettovarov').html(GetTovarov(c));
//
//		document.getElementById('baskettovarov').innerHTML = GetTovarov(d);
//		d = document.getElementById('basketsum').innerHTML;
//		d = d*1 + price*num;
//		document.getElementById('basketsum').innerHTML = d;

	    }
	});	
    }

	/////////////////////EMAIL CHECKER//////////////////////////////////////////////////
	
				var spaceRe = / +/g;
			function removeSpaces(s) {
				 var ss = s;
				return ss.replace(spaceRe, "");
			}
			function trim(str) {
			var newstr = str.replace(/^\s*(.+?)\s*$/, "$1");
			if (newstr == " ") {
				return "";
			}
			return newstr;
			}
			function drop_spaces(str) {
			var newstr = trim(str); //функцию trim() см. выше
			return newstr.replace(/(\s)+/g, "");
			}
			function checkmail(email) {
			var template = /^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z])+$/;
			email = drop_spaces(email); //функцию drop_spaces() см. выше
			if (template.test(email)) {
				return true;
			}
			return false;
			}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////



function changebasket(size,oldcount,id,price,count)
{
    rand1 = Math.random();
    //if(num == undefined) num = 1;
//    if(size == undefined || size=='') size = '';

    $.ajax({
        type: "POST",
        url: "/forajax.php",
        data:
        {
            act:"changebasket",
            id:id,
            price:price,
            count:count,
            oldcount:oldcount,
            size:size,
            rand1:rand1
        },

        dataType:'JSON',
        success: function (data, textStatus) {

            $('.cart-summ').html(data.allsumstr);
            $('.basketnum').html(data.inbasket);
            $('.baskettovarov').html(GetTovarov(data.inbasket));

           // alert('Товар добавлен в ваши заказы', 'Уважаемый покупатель');
            //var c = $('.basketnum').html();
            //c = c*1 + num*1;

//
//		document.getElementById('baskettovarov').innerHTML = GetTovarov(d);
//		d = document.getElementById('basketsum').innerHTML;
//		d = d*1 + price*num;
//		document.getElementById('basketsum').innerHTML = d;

        }
    });
}


//
function delbacket(id)
{
    rand1 = Math.random();
    $.ajax({
        type: "POST",
        url: "/forajax.php",
        data:
        {
            act:"delbacket",
            deltov:id,
            rand1:rand1
        },
//        dataType:'JSON',
        success: function (data, textStatus) {
            $('#product-add2').html(data);
            var c = $('.basketnum').html();
            c = c*1 - 1;
            $('.basketnum').html(c);
            $('.baskettovarov').html(GetTovarov(c));
        }
    });
}
//