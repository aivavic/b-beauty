<?
    if($subact=="editprofile")
    {
        //print_r($_SESSION);
        //print_r($userline);
?>
        <script>
            function CheckFill()
            {
                if(document.getElementById('firstname').value=='') { alert('Заполните имя'); return false; }
                if(document.getElementById('password').value != document.getElementById('repassword').value) { alert('Пароли не совпадают'); return false; }
                return true;
            }
        </script>

                    <form method="post" action="/work.php" onsubmit="return CheckFill();">
                            <input type="hidden" name="act" value="editprofile">
                    <table border="0">

                    <tr valign="top"><td>
                            <label>E-mail:</label>
                    </td><td>
                            <input type="text" value="<?= htmlspecialchars($userline['email']); ?>" name="email" id="email" disabled />
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
                            <input type="text" value="<?= htmlspecialchars($userline['firstname']); ?>" name="firstname" id="firstname" />
                    </td></tr>

                    <tr valign="top"><td>
                            <label>Телефон:</label>
                    </td><td>
                            <input type="text" value="<?= htmlspecialchars($userline['phone']); ?>" name="phone" id="phone" />
                    </td></tr>

                    <tr valign="top"><td>
                            &nbsp;
                    </td><td>
                    <br>
                        <span class="br"></span><input type="submit" value="Изменить">
                    </td></tr>
                    </table>
                    </form>
<?
    }
?>    