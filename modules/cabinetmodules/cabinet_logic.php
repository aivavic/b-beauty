<?	
	//логика кабинета
	
	if($act=="cabinet" && $subact=="register")
	{
		$formemail = '';
		$formname = '';
		$formaddress = '';
		$formphone = '';
		$message = '';
		
		$success_register_flag = 0; // 0 - повторно вывести форму регистрации.

		if(isset($_SESSION['register_result']) && $_SESSION['register_result']=='submit')
		{
			$success_register_flag = 1;
			$message = 'Вам было отправлено письмо с кодом подтверждения.';
		}

		if(isset($_SESSION['register_result']) && $_SESSION['register_result']=='submitok')
		{
			$success_register_flag = 1;
			$message = 'Ваша учетная запись активирована. Приятной работы.';
		}

		if($success_register_flag!=0)
		{
	  
			//echo '<div style="font-weight:bold;">'.$message.'</div>';
		}
		else
		{
			if(isset($_SESSION['register_result']) && $_SESSION['register_result']=='alreadyexistemail')
			{
				//echo '<div style="color:red; font-weight:bold;">Данный e-mail уже используется в системе.</div>';
				$message = 'Данный e-mail уже используется в системе.';
			
				$formaddress = $_SESSION['regform']['address'];
				$formemail = '';
				$formname = $_SESSION['regform']['name'];
				$formphone = $_SESSION['regform']['phone'];
			}
			
			if(isset($_SESSION['register_result']) && $_SESSION['register_result']=='badcode')
			{
				//echo '<div style="color:red; font-weight:bold;">Введен неверный код, попробуйте снова.</div>';
				$message = 'Введен неверный код, попробуйте снова.';
			
				$formaddress = $_SESSION['regform']['address'];
				$formemail = $_SESSION['regform']['email'];
				$formname = $_SESSION['regform']['name'];
				$formphone = $_SESSION['regform']['phone'];
			}
			
			//$_SESSION['register_result'] = '';
		}

		//Данные которые отправлялись с формы при неверной капче. (Служат для подстановки в поля формы при повторной попытке)
		
		if(isset($_SESSION['register_result'])) $register_result = $_SESSION['register_result'];
		else $register_result = '';
		
		$_logic['cabinet_register'] = Array(
				'form_address'=>$formaddress, 'form_email'=>$formemail, 'form_name'=>$formname, 'form_phone'=>$formphone,
				'register_result' => $register_result, 'success_register_flag'=>$success_register_flag, 'message' => $message, 
		);
		
	}
	
	if($act=="cabinet" && $subact=="remind")
	{
		if(!isset($subact2)) $subact2='';
      echo '<h1>Напоминание пароля</h1>';
        
		$message = '';
		
        if($subact2=='ok')
        {
            $message = 'Пароль выслан на ваш почтовый ящик.';
        }
        else
        {
            if($subact2=='badcode')
            {
                $message = 'Данный e-mail не зарегистрирован в системе.';
            }

        }
        $_logic['cabinet_remind'] = Array('message' => $message, 'subact2'=>$subact2, );
	}	
	
?>