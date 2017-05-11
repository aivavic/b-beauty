$(document).ready(function(){$("a.gallery2").fancybox({"padding":3,"imageScale":!1,"zoomOpacity":!1,"zoomSpeedIn":0,"zoomSpeedOut":0,"zoomSpeedChange":1000,"overlayShow":!0,"overlayOpacity":0.8,"hideOnContentClick":!1,"centerOnScroll":!1})});function GetTovarov(d)
{if(d%100>=11&&d%100<=19)return 'товаров';if(d%10==0)return ' товаров';if(d%10==1)return ' товар';if(d%10==2)return ' товара';if(d%10==3)return ' товара';if(d%10==4)return ' товара';return 'товаров'}
function AddToBasket(id,price,size,num)
{rand1=Math.random();if(num==undefined)num=1;if(size==undefined||size=='')size='';$.ajax({url:'/forajax.php?act=addtobasket&id='+id+'&num='+num+'&size='+size+'&rand1='+rand1,success:function(data,textStatus){$('#product-add2').html(data);var c=$('.basketnum').html();c=c*1+num*1;$('.basketnum').html(c);$('.baskettovarov').html(GetTovarov(c))}})}
var spaceRe=/ +/g;function removeSpaces(s){var ss=s;return ss.replace(spaceRe,"")}
function trim(str){var newstr=str.replace(/^\s*(.+?)\s*$/,"$1");if(newstr==" "){return ""}
	return newstr}
function drop_spaces(str){var newstr=trim(str);return newstr.replace(/(\s)+/g,"")}
function checkmail(email){var template=/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z])+$/;email=drop_spaces(email);if(template.test(email)){return!0}
	return!1}
function changebasket(size,oldcount,id,price,count)
{rand1=Math.random();$.ajax({type:"POST",url:"/forajax.php",data:{act:"changebasket",id:id,price:price,count:count,oldcount:oldcount,size:size,rand1:rand1},dataType:'JSON',success:function(data,textStatus){$('.cart-summ').html(data.allsumstr);$('.basketnum').html(data.inbasket);$('.baskettovarov').html(GetTovarov(data.inbasket))}})}
function delbacket(id)
{rand1=Math.random();$.ajax({type:"POST",url:"/forajax.php",data:{act:"delbacket",deltov:id,rand1:rand1},success:function(data,textStatus){$('#product-add2').html(data);var c=$('.basketnum').html();c=c*1-1;$('.basketnum').html(c);$('.baskettovarov').html(GetTovarov(c))}})}