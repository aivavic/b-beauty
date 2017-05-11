<?

	class AdminFunc
	{
		var $path = '/admin/drawer/drawer_oc/';

		function DrawLine($v)
		{
			$ret = '';
			$ret.= '<tr valign="top"><td width="200"><b>'.$this->DrawItem($v[0]).'</b></td><td>'.$this->DrawItem($v[1]);
			$ret.= '</td></tr>';
			$ret.= '<tr valign="top"><td colspan="2"><div class="admhr"></div></td></tr>';
			
			return $ret;
			
		}
		
		function DrawItem($v)
		{
			if(count($v)>0)
			{
				if($v['type']=='line')
				{
					return $this->DrawLine($v['value']);
				}

				if($v['type']=='text') return $v['value'];
				if($v['type']=='html') return $v['value'];
				
				if($v['type']=='multiline')
				{
					//echo 'MULTILINE';
					//print_r($v);
					$ret = '';
					foreach($v['value'] AS $vline)
					{
						$ret.=$this->DrawItem($vline);
					}
					return $ret;
				}

				//if($v['type']=='input') $this->DrawInput($v['value']);
			}
		}
		
		function DrawTableLine($v,$v2='',$v3='') //печатает строку таблицы списка элементов
		{
			$ret = '';
			
			if($v=='table_begin')
			{
				if($v2=='noneform')
				{
					$ret = '            
					        <table class="list">
							<tbody>';
				}
				
				if($v2=='editform')
				{
					$ret = 	'
					<table class="width95"><tbody>';

				}
			}
			else if($v=='table_end')
			{
				$ret = '</tbody></table>';
			}
			else
			{
				$ret = '';
				
				$ret.= '
				<tr class="'.$v3.'">';
				
				foreach($v AS $key1=>$value1)
				{
					$key = $value1['type']; $value = $value1['value'];
					if($key=='td')
					{
						$ret.= '
						<TD >'.$value.'</td>';
					}
					
					if($key=='td_22')
					{
						$ret.= '
						<TD width="22">'.$value.'</td>';
					}
				}
				$ret.= '
				</tr>';
				
			}
			return $ret;
		}
		
		
		function DrawTableHeader($v,$v2='',$v3='') //печатает строку таблицы списка элементов
		{
			$ret = '';
			
			$ret.= '
			<tr class="'.$v3.'">';
			
			foreach($v AS $key1=>$value1)
			{
				$key = $value1['type'];
				if(isset($value1['tdname'])) $value = $value1['tdname']; else $value = ' ';
				if(isset($value1['sorturl'])) $sorturl = $value1['sorturl']; else $sorturl = '#';
				if(isset($value1['ascdesc'])) $ascdesc = $value1['ascdesc']; else $ascdesc = '';
				
				$adds = '';
				//Debug($value1);
				if(isset($value1['listeditable']) && $value1['listeditable']==true)
				{
					$adds.=' <a href="#" onclick="ChangeFields(); return false;">'.$this->DrawIcon('save',' width="16" ').'</a>';
				}

				if($key=='td')
				{
					$ret.= '
					<TD style="font-weight:bold;"><a '.($sorturl==''?'':'href="'.$sorturl.'"').'>'.$value.'</a>'.($ascdesc==''?'':$this->DrawIcon($ascdesc)).$adds.'</td>';
				}
				
				if($key=='td_22')
				{
					$ret.= '
					<TD width="22" style="font-weight:bold;">'.$value.$adds.'</td>';
				}
			}
			$ret.= '
			</tr>';

			return $ret;
		}
		    
        //Начало шапки
        function DrawAdminHeader()
        {
?><!DOCTYPE html>
<html dir="ltr" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Панель управления</title>

<link rel="stylesheet" type="text/css" href="/admin/drawer/drawer_oc/adminfiles/style.css">
	

<script src="plugins/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="/admin/drawer/drawer_oc/adminfiles/gallery.css">

<script src="/admin/adminjs/fancybox/jquery-1.3.2.min.js"></script>

<script>
	function ChangeFields()
	{
		msg = $(".listeditablefield").serialize();
		
		r = Math.random(1,1000);
		$.ajax({
			type: "POST",
			url: "workajax.php?act=changefields&r="+r,
			//data: { 'msg': msg, },
			data: msg,
			success: function(data) {
			  alert('Сохранено');
			},
			error:  function(xhr, str){
			      alert('Возникла ошибка: ' + xhr.responseCode);
			  }			
		});		
	}
</script>
	
</head>
<body>

<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2">
	<a href="/admin/admin.php">Панель управления</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="/">На сайт</a>
	
	</div>
	
    <div class="div3">
		
	<?= GetDrawerSelect(); ?>
		
		<img src="/admin/drawer/drawer_oc/adminfiles/lock.png" alt="" style="position: relative; top: 3px;">
    <? echo date("d.m.Y",time()); ?>&nbsp;&nbsp;<BR>
          <? if(isset($_SESSION['loguser']) && $_SESSION['loguser']==1) echo htmlspecialchars($_SESSION['loguserfio']); else echo 'admin'; ?>&nbsp;&nbsp;(<A
      href="admin.php?act=logout"><B>Выход</B></A>)&nbsp;&nbsp;
	
	</div>
  </div>
    <div id="menu">
    <ul class="left sf-js-enabled" style="display: block;">
<?          
        }


        function DrawHeadCategory($act,$temp1_act,$temp1_title,$temp1_file,$temp1_url,$subitems)
        {
		
		$subitems_html = '';
		if(isset($subitems)):
			$subitems_html.='
			<ul class="sub_menu">';
				foreach($subitems AS $key=>$oneitem):
					if(trim($oneitem['act'])=='') $oneitem_url = ''; else $oneitem_url = 'admin.php?act='.$oneitem['act'];
					$subitems_html.=' <li><a '.($oneitem_url=='' ? : 'href="admin.php?act='.$oneitem['act'] ).'">'.htmlspecialchars($oneitem['title']).'</a></li> ';
				endforeach;
			$subitems_html.= ' </ul> ';
		endif;
	    
            if($act == $temp1_act)
            {
?>				
			<li class="selected" ><a <? if($temp1_url!='') echo ' href="'.$temp1_url.'" '; ?> " class="top"><?= $temp1_title; ?></a>
			<?= $subitems_html ?>
			</li>
<?					  
            }
            else
			{
				?>
				<li ><a <? if($temp1_url!='') echo ' href="'.$temp1_url.'" '; ?> class="top"><?= $temp1_title; ?></a><?= $subitems_html ?></li>
				<?
			}
            
        }

        
        function DrawAdminHeaderEnd()
        {
?>            
    </ul>
<!--	
    <ul style="display: block;" class="right sf-js-enabled">
      <li id="store"><a onclick="window.open('http://oc1/');" class="top">Store Front</a>
        <ul style="display: none; visibility: hidden;">
                  </ul>
      </li>
      <li id="store"><a class="top" href="http://oc1/admin/index.php?route=common/logout&amp;token=7ee779551259f2a7446bec66d622bf0d">Logout</a></li>
    </ul>
-->	
  </div>
  </div>
<?
        }
        
        
        function DrawAdminHeadRow2Start()
        {
?>            
<TABLE
      style="BORDER-RIGHT: #345560 1px solid; BORDER-LEFT: #345560 1px solid; BORDER-BOTTOM: #345560 1px solid"
      height=22 cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR style="BACKGROUND-COLOR: #8498a3">
<?        
        }
        
        function DrawAdminHeadRow2Item($item)
        {
?>
            <TD style="PADDING-LEFT: 5px; COLOR: #ffffff;" vAlign=center>
            <?= $item; ?>
            </td>
<?            
        }
        
        function DrawAdminHeadRow2End()
        {
?>            
<TD style="PADDING-LEFT: 5px; COLOR: #ffffff" vAlign=center>&nbsp;</td>

                  </TR></TBODY></TABLE>

                  </TD></TR>
</TBODY></TABLE>
<?            
        }


        //Начало блока контента
        function DrawAdminContentBegin()
        {
?>
<div id="content">

      <div class="box">
    <div class="heading">
     
     
    </div>
    <div class="content">
<?
        }
        
        
        
        //Конец блока контента
        function DrawAdminContentEnd()
        {
?>
    </div>
  </div>
</div>
</div>
<?
        }
        
        
        
        function DrawAdminFooter()
        {
?>            
<div id="footer">
	<? echo date("Y",time()); ?>
</div>
</body></html>
<?
        }


		/////////////////////////////////////////
		function DrawIcon($iconname,$addparam='')
		{
			$ret = '';
			
			if($iconname=='on') $ret = '<img src="'.$this->path.'adminfiles/on.gif" border="0" '.$addparam.'>';
			if($iconname=='off') $ret = '<img src="'.$this->path.'adminfiles/off.gif" border="0" '.$addparam.'>';
			if($iconname=='up') $ret = '<img src="'.$this->path.'adminfiles/b_up.gif" border="0" '.$addparam.'>';
			if($iconname=='down') $ret = '<img src="'.$this->path.'adminfiles/b_doun.gif" border="0" '.$addparam.'>';
			if($iconname=='add') $ret = '<img src="'.$this->path.'adminfiles/add.png" border="0" '.$addparam.'>';
			if($iconname=='edit') $ret = '<img src="'.$this->path.'adminfiles/b_edit.png" border="0" '.$addparam.'>';
			if($iconname=='del') $ret = '<img src="'.$this->path.'adminfiles/b_drop.png" border="0" '.$addparam.'>';

			if($iconname=='asc') $ret = '<img src="'.$this->path.'adminfiles/asc.png" border="0" '.$addparam.'>';
			if($iconname=='desc') $ret = '<img src="'.$this->path.'adminfiles/desc.png" border="0" '.$addparam.'>';
			
			if($iconname=='save') $ret = '<img src="'.$this->path.'adminfiles/save.png" border="0" '.$addparam.'>';
			if($iconname=='xls') $ret = '<img src="'.$this->path.'adminfiles/xls.png" border="0" '.$addparam.'>';
			
			return $ret;
		}
			
    
    }

?>