<?php
	if(!isset($user))
	{
		include("lib/check_login.php");
		if(!isset($user))
		{
			echo "ERRORE";
			exit;
		}
	}
	if(!isset($fun_mail))
		$fun_mail=$GLOBALS['fun_mail'];
	if(!isset($fun_gruppi))
		$fun_gruppi=$GLOBALS['fun_gruppi'];
	//print_r($fun_mail);
	//print_r($fun_gruppi);
	//print_r($user->menu);
?>
	<div align="center" style="text-align: center;height:536px;background-image: url(img/sfondo.jpg);background-repeat: no-repeat;">
	
	<table border="1" align="center">
		<?php 
			foreach($user->menu as $key => $value)
			{
				//echo "VALUE:$value";
				//print_r($fun_mail);
				//print_r($fun_gruppi);
				if(in_array($value,$fun_mail))
				{
					//echo "KEY:$key";
					
					//style=\"color: #0000FF; width: 220px; height: 26px;background: url('img/bottonelungo2.jpg');\" 
					$menu_mail .="<button class=\"bottonimenu\" id=\"".$value."\" onmouseup=\"document.getElementById('".$value."').style.background = '#0000FF url(img/bottonelungo2.jpg) center no-repeat';\" onmousedown=\"document.getElementById('".$value."').style.background = '#FF0000 url(img/bottonelungo2.jpg) center no-repeat';\" onclick=\"window.location='".$dove."?fun=".$value."'\">".$key."</button><br><br>\n";
					//$menu_gite .= "<a href=\"$dove?fun=$value\"><img src=\"img/".$value.".jpg\" title=\"".$key."\" alt=\"".$key."\"></a><br><br>\n";
				}
				if(in_array($value,$fun_gruppi))
				{
					//$menu_amm .= "<a href=\"$dove?fun=$value\"><img src=\"img/".$value.".jpg\" title=\"".$key."\" alt=\"".$key."\"></a><br><br>\n";
					$menu_gruppi .="<button class=\"bottonimenu\" id=\"".$value."\" onmouseup=\"document.getElementById('".$value."').style.background = '#0000FF url(img/bottonelungo2.jpg) center no-repeat';\" onmousedown=\"document.getElementById('".$value."').style.background = '#FF0000 url(img/bottonelungo2.jpg) center no-repeat';\" onclick=\"window.location='".$dove."?fun=".$value."'\">".$key."</button><br><br>\n";
				}
			}
			echo "<tr><td align=\"center\">$menu_mail</td><td align=\"center\">$menu_gruppi<a href=\"logout.php\"><img src=\"img/logout.jpg\" title=\"LogOut\" alt=\"LogOut\"></a><br><br></td></tr>";
?>
	</table>
</div>