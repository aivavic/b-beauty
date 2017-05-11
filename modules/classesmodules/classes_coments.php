<?
function PrintComentsBlock($materialid, $tabletype = 1, $comentstype = 1, $revers = 0, $start = 0, $limit = 0, $linkstr = '')
{
    if ($tabletype == 1) $tablename = "coments";

    ?>
    <style>
        .comentstable1 {
            border: 0px;
            width: 100%;
        }

        .comentname {
            font-size: 13px;
            font-weight: bold;
        }

        .comentdate {
            font-size: 12px;
            color: #808080;
            font-weight: normal;
        }

        .comment_text {
        }

        .mess_answer_a {
            font-weight: bold;
            font-size: 12px;
        }

        .coment_p_title {
            color: #f5821f;
            font-weight: bold;
            padding-bottom: 10px;
            padding-top: 5px;
        }

        .comentdiv {
            border-left: 1px dashed #c7c7c7;
            border-bottom: 1px dashed #c7c7c7;
        }

    </style>

    <script>
        function ShowComents() {
            document.getElementById('startcoments').style.display = 'block';
            /*
             setEqualHeight($("#content > div"));
             setEqualHeight($("#wrapper > div"));
             $("#content .left").css({'height': $(".menubar").outerHeight()});
             */
        }

        function ShowComForm(p) {
            document.getElementById('comform' + p).style.display = 'block';
        }
    </script>

    <?
    echo '
		<a name="startcoments"></a>
		<div id="startcoments" style="display:block;">

			<div class="comments">

			<div style="border-bottom: 1px dashed #ccc; padding-top:5px;"></div>
			
			';


    if (isset($_SESSION['badcode']) && $_SESSION['badcode'] == 1) {
        $_SESSION['badcode'] = 0;
        echo '<div style="color:red; font-size:18px; text-align:center;">Введен неверный код.</div>';
    }

    $sqlpager = "SELECT COUNT(id) AS ccc FROM $tablename WHERE parentid=$materialid AND hide=0 AND parentcomid=0 AND comentstype=$comentstype ";
    PrintPager($sqlpager, $linkstr, TrueStr($limit != 0, $limit, 10), '#startcoments');

    PrintComents($materialid, 0, 1, $tabletype, $comentstype, $revers, $start, $limit);


    echo '</div>


			<div class="clear_div"></div>';

    PrintComentsForm($materialid, $tabletype, $comentstype);

    echo '
		</div>';
}


function PrintComents($id, $parentcomid, $level, $tabletype = 1, $comentstype = 1, $revers = 0, $start = 0, $limit = 0)
{
    global $par, $varsline, $userline, $privateditable;

    $needavatar = false;
    $withoutavatarimg = "/imgglobal/question1.jpg";
    $avatarprefix = "fotos/avatars/avatar";

    $mess_answer = 'Ответить';
    $mess_name = 'Имя';
    $mess_text = 'Текст комментария';
    $mess_number = 'Введите число';
    $mess_send = 'отправить';


    $tablename = "coments";

    $sql1 = "SELECT * FROM $tablename WHERE parentid=$id AND hide=0 AND parentcomid=$parentcomid AND comentstype=$comentstype ORDER BY id ";

    if ($revers == 1) $sql1 .= " DESC ";

    if ($level == 1) {
        if ($limit == 0) $limit = 1000000000;
        $sql1 .= " LIMIT $start, $limit";
    }

    $res1 = mysql_query($sql1);
    $nrows1 = mysql_num_rows($res1);
    while ($line1 = mysql_fetch_array($res1, MYSQL_ASSOC)) {
        $sql2 = "SELECT * FROM $par->userstable WHERE id=" . $line1['userid'];
        $res2 = mysql_query($sql2);
        $line2 = mysql_fetch_array($res2, MYSQL_ASSOC);

        $fname = $withoutavatarimg;
        if ($line1['userid'] != 0) {
            if (is_file($avatarprefix . $line1['userid'] . '.jpg')) $fname = "/" . $avatarprefix . $line1['userid'] . '.jpg';
        }
        $username = $line1['name'];
        $city = $line1['city'];

        if ($level <= 7) $shift = ($level - 1) * 30;
        else $shift = 6 * 30 + ($level - 7) * 10;

        echo '
					<div style="padding-top:5px;"></div>
					<div style="margin-left:' . $shift . 'px; " class="comentdiv">
					<a name="comentid' . $line1['id'] . '"></a>
					<table class="comentstable1">
					<tr valign="top">';

        if ($needavatar) {
            echo '
						<td width="50">';
            echo '<img src="' . $fname . '" width="50" border="0" >';
            echo '
						</td>';
        }

        echo '
					<td>
					<div style="padding-left:10px;">
					<p style="padding-bottom:10px;"><span class="comentname">' . htmlspecialchars($username) . '</span> <span class="comentdate">(' . date("d.m.y H:i", $line1['date']) . ')</span></p>
					<div class="comment_text">' . nl2br(htmlspecialchars($line1['text'])) . '</div>
					</div>
					';


        {
            echo '
						<p style="padding-top:5px; padding-bottom:5px;"><a href="#" class="mess_answer_a" onclick="ShowComForm(' . $line1['id'] . '); return false;">' . htmlspecialchars($mess_answer) . '</a>';

            echo '</p>';
            echo '
						<div id="comform' . $line1['id'] . '" style="display:none;">
							<form method="post" action="/work.php">
							<input type="hidden" name="act" value="addblogcoment">
							<input type="hidden" name="id" value="' . $id . '">
							';

            echo '<input type="hidden" name="tabletype" value="' . $tabletype . '">';
            echo '<input type="hidden" name="comentstype" value="' . $comentstype . '">';


            echo '
							<table border="0" width="90%" class="comformtable">
							<tr valign="top"><td width="150">' . htmlspecialchars($mess_name) . ':</td><td><input name="name" type="text" value="';
            if (isset($_SESSION['loguserid'])) {
                echo htmlspecialchars($userline['firstname']) . ' ' . htmlspecialchars($userline['lastname']);
            }
            echo '" id="contact_name" class="coment_name_input" /></td></tr>
							<tr valign="top"><td width="150">' . htmlspecialchars($mess_text) . ':</td><td><textarea name="text" id="contact_message" class="coment_mess_textarea"></textarea></td></tr>';

            if (!isset($_SESSION['loguserid'])) echo '<tr valign="top"><td width="150">' . htmlspecialchars($mess_number) . ':</td><td><br><img src="/iii2.php/?id=' . $id . '&id2=' . $line1['id'] . '&' . session_name() . '=.' . session_id() . '"><br><input name="keystring" type="text" value="" id="contact_name" class="coment_keystring_input" /></td></tr>';

            echo '<tr valign="top"><td width="150">&nbsp;</td><td><input value="' . htmlspecialchars($mess_send) . '" type="submit"></td></tr>
							</table>
							<input type="hidden" name="parentcomid" value="' . $line1['id'] . '">
							</form><br><br>
						</div>';
        }

        echo '			
					</td>
					</tr>
					</table>
					</div>
						<div class="coment_divider_line"></div>
					';

        PrintComents($id, $line1['id'], $level + 1, $tabletype, $comentstype);
    }
}


function PrintComentsForm($id, $tabletype, $comentstype)
{
    global $userline;

    $withoutregister = true;

    $messform_title = 'Комментарий к этому материалу:';
    $messform_onlyregister = 'Оставлять комментарии могут только зарегистрированные пользователи';
    $messform_register = 'Зарегистрироваться';
    $messform_login = 'Войти';

    echo '
            <a name="addcoments"></a>
	    ';

    if ($withoutregister || isset($_SESSION['loguserid'])) {
        echo '<p class="coment_p_title">' . htmlspecialchars($messform_title) . '</p>';

        echo '
			<form method="post" action="/work.php">
			<input type="hidden" name="act" value="addblogcoment">
			<input type="hidden" name="id" value="' . $id . '">';

        echo '<input type="hidden" name="tabletype" value="' . $tabletype . '">';
        echo '<input type="hidden" name="comentstype" value="' . $comentstype . '">';

        echo '
			<table border="0" width="90%" class="comformtable">
			<tr valign="top"><td width="150">Имя:</td><td><input name="name" type="text" value="';
        if (isset($_SESSION['loguserid'])) {
            echo htmlspecialchars($userline['firstname']) . ' ' . htmlspecialchars($userline['lastname']);
        }
        echo '" id="contact_name" style="width: 99%;" /></td></tr>
			<tr valign="top"><td width="150">Текст комментария:</td><td><textarea name="text" id="contact_message" style="width: 99%; height: 150px;"></textarea></td></tr>';

        if (!isset($_SESSION['loguserid'])) echo '<tr valign="top"><td width="150">Введите число:</td><td><br><img src="/iii2.php/?id=' . $id . '&id2=0&' . session_name() . '=.' . session_id() . '"><br><input name="keystring" type="text" value="" id="contact_name" style="width: 100px;" /></td></tr>';

        echo '<tr valign="top"><td width="150">&nbsp;</td><td><br><input type="submit" value="Отправить" ></td></tr>
			</table>
			<input type="hidden" name="parentcomid" value="0">
			</form><br><br>';
    } else {
        echo '<center><b>' . htmlspecialchars($messform_onlyregister) . '</b>
			<br>
			<a href="/register">' . htmlspecialchars($messform_register) . '</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/login">' . htmlspecialchars($messform_login) . '</a>
			</center>';
    }

}

?>