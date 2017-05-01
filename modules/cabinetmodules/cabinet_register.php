<?
	$item = $_logic['cabinet_register'];
?>
	<h1>Регистрация</h1>
	
	<?
		if($item['success_register_flag'])
		{
			?>
				<div><?= $item['message']; ?></div></br>
			<?
		}
		else
		{
			?>
				<div style="color:red; font-weight:bold;"><?= $item['message']; ?></div><br/>
			<?
	?>
    
		<script>
		    function CheckFill()
		    {
			if(document.getElementById('firstname').value=='') { alert('Заполните имя'); return false; }
			if(document.getElementById('address').value=='') { alert('Заполните адрес'); return false; }
			if(checkmail(document.getElementById('email').value)==false) { alert('Введите корректный e-mail'); return false; }
			if(document.getElementById('password').value=='') { alert('Введите пароль'); return false; }
			if(document.getElementById('password').value != document.getElementById('repassword').value) { alert('Пароли не совпадают'); return false; }
			if(document.getElementById('keystring').value=='') { alert('Заполните цифровой код'); return false; }
			return true;
		    }
		</script>
	    
			  <form method="post" action="/work.php" onsubmit="return CheckFill();">
				  <input type="hidden" name="act" value="register">
			  <table border="0">
    
			  <tr valign="top"><td>
				  <label>E-mail:</label>
			  </td><td>
				  <input type="text" value="<?= htmlspecialchars($item['form_email']); ?>" name="email" id="email" />
			  </td></tr>
    
			  <tr valign="top"><td>
				  <label>Пароль:</label>
			  </td><td>
				  <input type="text" value="" name="password" id="password" />
			  </td></tr>
    
			  <tr valign="top"><td>
				  <label>Повторите пароль:</label>
			  </td><td>
				  <input type="text" value="" name="repassword" id="repassword" />
			  </td></tr>
    
			  <tr valign="top"><td>
				  <label>Ф.И.О.:</label>
			  </td><td>
				  <input type="text" value="<?= htmlspecialchars($item['form_name']); ?>" name="firstname" id="firstname" />
			  </td></tr>
			  <tr valign="top"><td>
				  <label>Адресс</label>
			  </td><td>
				  <input type="text" value="<?= htmlspecialchars($item['form_address']); ?>" name="address" id="address" />
			  </td></tr>
    
			  <tr valign="top"><td>
				  <label>Телефон:</label>
			  </td><td>
				  <input type="text" value="<?= htmlspecialchars($item['form_phone']); ?>" name="phone" id="phone" />
			  </td></tr>
    
			  <tr valign="top"><td>
				  <label>Введите код с картинки:</label>
			  </td><td>
				  
			  </td></tr>
    
			  <tr valign="top"><td>
				  <div class="captcha_block">
					  <? echo '<img src="/utils/kaptcha/iii.php/?id=0&'.session_name().'=.'.session_id().'">'; ?>
				  </div>
			  </td><td>
			  <br>
				  <input type="text" name="keystring" id="keystring" />	
				  </div>
			  </td></tr>
			  <tr>
					  <td></td>
					  <td>
							  <input type="submit" value="Зарегистрироваться">
					  </td>
							  
			  </tr>
			  
			  </table>
			  </form>
			  
	<?
		}
	?>
<?
	
	
	$_SESSION['register_result'] = '';
	
	$_SESSION['regform']['address'] = '';
	$_SESSION['regform']['email'] = '';
	$_SESSION['regform']['name'] = '';
	$_SESSION['regform']['phone'] = '';
	
	
?>
