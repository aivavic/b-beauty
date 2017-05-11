<?
    if($subact=="remind")
    {
		$item = $_logic['cabinet_remind'];
		if($item['subact2']=='ok')
		{
			?>
				<div><?= $item['message']; ?></div>
			<?
		}
		else
		{
	?>
		<center>
				<div style="color:red; font-weight:bold;"><?= $item['message']; ?></div><br/>
		<form method="post" action="/work.php">
				<input type="hidden" name="act" value="remind">
				<table>
				<tr>
						<td>Логин(email):</td><td><input type="text" value="" name="email" onfocus="if(this.value=='Логин') this.value='';"></td>
				</tr>
				<tr>
						<td>&nbsp;</td><td><input type="submit" value="Напомнить"></td>
				</tr>
				<tr>
						<td>&nbsp;</td><td><br><a href="/cabinet/subact/register">Регистрация</a>
						<a href="/cabinet/subact/login">Войти</a></td>
				</tr>
				</table>
		</form>
		</center>
	<?
		}
    }
?>
