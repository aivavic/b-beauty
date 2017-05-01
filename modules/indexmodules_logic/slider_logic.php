<?
//echo "asd";exit;
if ($act=='none' || $act=='novinki')
{
    $sliderarr = Array();
    $sql = "SELECT * FROM $par->mainfotortable WHERE hide=0";

    $res = mysql_query($sql);
    while($line = mysql_fetch_array($res,MYSQL_ASSOC))
    {
        $fname = ''; $addstr = '';
        $big_fname = ''; $big_addstr = '';
        //определяем картинку
        if(is_file('fotos/mainslider'.$line['id'].'.jpg')) $fname = 'fotos/mainslider'.$line['id'].'.jpg';
        if(is_file('fotos/mainslider_big'.$line['id'].'.jpg'))   $fname = 'fotos/mainslider_big'.$line['id'].'.jpg';


        //если картинка больше нужных размеров приводим ее к нужным
        if($fname!='')
        {
            $addstr = GetAddStrH(246,$fname);
            $fname = '/'.$fname;
        }

        $sliderarr[] = Array('title'=>$line['title'],'fname'=>$fname,'addstr'=>$addstr);
    }
    $_logic['sliderarr'] = $sliderarr;
    //debug($sliderarr);
}


if ($act=='cat')
{

    $sliderarr1 = Array();
    $sql1 = "SELECT * FROM $par->fotortable WHERE hide=0 AND reportid=$id";

    $res1 = mysql_query($sql1);
    while($line1 = mysql_fetch_array($res1,MYSQL_ASSOC))
    {
        $fname = ''; $addstr = '';
        $big_fname = ''; $big_addstr = '';
        //определяем картинку
        if(is_file('fotos/catslide'.$line1['id'].'.jpg')) $fname = 'fotos/catslide'.$line1['id'].'.jpg';
       // if(is_file('fotos/mainslider_big'.$line['id'].'.jpg'))   $fname = 'fotos/mainslider_big'.$line['id'].'.jpg';


        //если картинка больше нужных размеров приводим ее к нужным
        if($fname!='')
        {
            $addstr = GetAddStr(730,139,$fname);
            $fname = '/'.$fname;
        }

        $sliderarr1[] = Array('title'=>$line1['title'],'fname'=>$fname,'addstr'=>$addstr);
    }
    if (empty($sliderarr1))
    {
        $sliderarr1 = Array();
        $sql1 = "SELECT * FROM $par->fotortable WHERE hide=0 AND reportid=$activemenuid";

        $res1 = mysql_query($sql1);
        while($line1 = mysql_fetch_array($res1,MYSQL_ASSOC))
        {
            $fname = ''; $addstr = '';
            $big_fname = ''; $big_addstr = '';
            //определяем картинку
            if(is_file('fotos/catslide'.$line1['id'].'.jpg')) $fname = 'fotos/catslide'.$line1['id'].'.jpg';
            // if(is_file('fotos/mainslider_big'.$line['id'].'.jpg'))   $fname = 'fotos/mainslider_big'.$line['id'].'.jpg';


            //если картинка больше нужных размеров приводим ее к нужным
            if($fname!='')
            {
                $addstr = GetAddStr(730,139,$fname);
                $fname = '/'.$fname;
            }

            $sliderarr1[] = Array('title'=>$line1['title'],'fname'=>$fname,'addstr'=>$addstr);
        }
    }

    $_logic['sliderarr1'] = $sliderarr1;

}
//debug($sliderarr1);

?>