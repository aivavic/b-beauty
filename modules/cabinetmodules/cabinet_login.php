<?
    if($subact=="login")
    {
		?>
        <br><br>
        <center>
        <form method="post" action="/work.php">
                <input type="hidden" name="act" value="login">
                <table>
                <tr>
                        <td>Логин(email):</td><td><input type="text" value="" name="loginemail" onfocus="if(this.value=='Логин') this.value='';"></td>
                </tr>
                <tr>
                        <td>Пароль:</td><td><input type="password" value="" name="loginpassword" onfocus="this.value='';"></td>
                </tr>
                <tr>
                        <td>&nbsp;</td><td><input type="submit" value="Войти"></td>
                </tr>
                <tr>
                        <td>&nbsp;</td><td><br><a href="/cabinet/subact/register">Регистрация</a>
                        <a href="/cabinet/subact/remind">Забыли пароль?</a></td>
                </tr>
                </table>
        </form>
        </center>
		<?
    }
?>    