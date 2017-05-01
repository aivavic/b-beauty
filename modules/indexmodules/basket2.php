 <h1>Оформление заказа</h1>
    

        <!-- Контент -->
<?
        if($subact=="topay")
        {
            echo '<br><br><br><center><b>Ваш заказ отправлен администартору.</b></center><br><br><br><br><br><br>';
            
        }
        else
        {
?>        
<br/>
        <form action="/work.php" method="post" name="form1" id="form1">
		
<script>
    function CheckFill2()
    {
      //if(document.getElementById('name').value=='') { alert('Заполните имя'); return false; }
       if(checkmail(document.getElementById('email').value)==false) return false;
      //if(document.getElementById('phone').value=='') { alert('Заполните телефон'); return false; }
      //if(document.getElementById('address').value=='') { alert('Заполните адрес доставки'); return false; }
      return true;
    }
</script>	
<?

?>		
        <input type="hidden" name="act" value="order">
		
		<table id="cform">
	    <tr><td><label>Ф.И.О.:</label></td>
		<td><input type="text"  name="name" id="name" value="<?if(isset($_SESSION['loguserid'])){echo  $userline['firstname']; }?>" /></td></tr>
                
		<tr><td>
                        <label>E-mail:</label></td>
		<td>
                        <input type="text" name="email" id="email" value="<?if(isset($_SESSION['loguserid'])){echo $userline['email'];}?>" /></td></tr>
		
		<tr><td>
			<label>Контактный телефон:</label></td>
		<td>
                        <input type="text" name="phone" id="phone" value="<?if(isset($_SESSION['loguserid'])){echo $userline['phone'];}?>"/></td></tr>
		    
                <tr><td>
                        <label>Адрес доставки:</label></td>
		<td>
                        <textarea cols="30" rows="5" name="address" id="address"></textarea>
                </td></tr>
		
                <tr><td>
                        <label>Дополнительно:</label></td>
		<td>
                        <textarea cols="30" rows="5" name="mess" id="mess" ></textarea>
		</td></tr>
		

		</table>
		<br/>
		<input type="image" src="/utils/images_z/b3.png" onclick="return CheckFill2();"/>
		<br/><br/>
        </form>



<?
        }
?>