<?php
/*
	Creare le funzioni per le varie operazioni che saranno chiamate
	dalla funzione call_user_func richiamata qui sotto :)
	:D
*/

	$dove = "admin.php";
	include_once("lib/class.php");
	//array(entered_user=>admin,entered_password=>ciaobella)
	if ($_GET['reqpass'] == 1)
	{
		if ($_GET['sub'] == 1)
		{
			include_once(dirname(__FILE__)."/lib/db_mysql.php");
			$db = new db_local();
			
			$caratteri = array("'", " ");
			$email = str_replace($caratteri, "", trim($_POST['email']));
			$caratteri = array("'", " ", ".", "@");
			$nome = strtolower(str_replace($caratteri, "", trim($_POST['nome'])));
			$cognome = strtolower(str_replace($caratteri, "", trim($_POST['cognome'])));
			if($db->query("SELECT user, pw, email FROM anagrafiche WHERE TRIM(user) = '".$nome.".".$cognome."' AND TRIM(email) = '".$email."';"))
			{
				if ($db->next_record())
				{
					$reqpass = date("d").date("m").date("Y").rand(1,100000);
					$db->query("UPDATE anagrafiche SET reqpass = '".$reqpass."' WHERE TRIM(user) = '".$nome.".".$cognome."' AND TRIM(email) = '".$email."' LIMIT 1;");
					mail("webmaster@biciedintorni.it", "Richiesta Password - Bici&Dintorni", "Qualcuno ha richiesto la modifica della password.<br>".
							"Dati inseriti:<br>".
							"E-Mail: ".$email."\r\n<br>".
							"Nome: ".$nome."\r\n<br>".
							"Cognome: ".$cognome."\r\n<br>",
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n");
					if(mail($email, "Richiesta Password - FIAB Torino Bici e Dintorni", "Qualcuno ha richiesto la modifica della password. ".
							"Se questa richiesta è autentica, cliccare sul link seguente per ricevere una email con i dati: ".
							"'http://www.biciedintorni.it/application/admin.php?reqpass=1&sub=2&code=".$reqpass."'",
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n"))
					{
						$message = "E-mail inviata correttamente.";
					}
					else
					{
						$message = "Errore nell'invio dell'e-mail.";
					}
				}
				else
				{
					$message = "Nessuna corrispondenza trovata, forse i dati sul database non contengono la vostra email, contattate il WebMaster.";
				}
			}
			else 
			{
				$message = "Errore search_email, query falsa.";
				include(dirname(__FILE__)."/lib/reqpass.php");
				$db->close();
				unset($db);
				exit;
			}
			$db->close();
			unset($db);
		}
		elseif ($_GET['sub'] == 2)
		{
			include_once(dirname(__FILE__)."/lib/db_mysql.php");
			$db = new db_local();
			
			$caratteri = array("'", " ");
			$code = str_replace($caratteri, "", trim($_GET['code']));
			if($db->query("SELECT user, pw, email FROM anagrafiche WHERE TRIM(reqpass) = '".$code."';"))
			{
				if ($db->next_record())
				{
					$email = $db->record['email'];
					$user = $db->record['user'];
					$pass = date("d").date("m").date("Y");
					
					$db->query("UPDATE anagrafiche SET reqpass = '', pass = MD5('".$pass."'), pw = '".$pass."', passch = '0' WHERE TRIM(reqpass) = '".$code."' LIMIT 1;");
					mail("webmaster@biciedintorni.it", "Modifica Password Effettuata- Bici&Dintorni", $user." ha modificato la propria password.<br>".
							"Dati:<br>".
							"E-Mail: ".$email."\r\n<br>".
							"User: ".$user."\r\n<br>".
							"Password: ".$pass."\r\n<br>",
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n");
					if(mail($email, "Modifica Password - FIAB Torino Bici e Dintorni", "La modifica della password è avvenuta correttamente. ".
							"Ecco i suoi nuovi dati. "."\r\n".
							"User: ".$user."\r\n".
							"Password: ".$pass."\r\n",
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n"))
					{
						$message = "E-mail inviata correttamente.";
					}
					else
					{
						$message = "Errore nell'invio dell'e-mail.";
					}
				}
				else
				{
					$message = "Nessuna corrispondenza trovata, forse i dati sul database non contengono la vostra email, contattate il WebMaster.";
				}
			}
			else 
			{
				$message = "Errore search_email, query falsa.";
				include(dirname(__FILE__)."/lib/reqpass.php");
				$db->close();
				unset($db);
				exit;
			}
			$db->close();
			unset($db);
		}
		else
		{
			include(dirname(__FILE__)."/lib/reqpass.php");
			exit;
		}
	}
	if (is_numeric($_GET['iscr']))
	{
		//echo "<div id=\"msg\" align=\"center\" style=\"color: #FFFFFF\">[DEBUG admin.php] iscr gita -- _GET['iscr']=".$_GET['iscr']."</div>\n";
		iscr_gita();
	}
	else
	{
		if (($_GET['fun'] != 'etichette') && ($_GET['fun'] != 'listautenti'))
			makeHead("Amministrazione","","onload=\"init();\"");
	}
		
	include("lib/check_login.php");
	if(!isset($user))
	{
		echo "ERRORE";
		exit;
	}
	if(isset($_GET['fun']))
	{
		if(array_key_exists($_GET['fun'],array_flip($user->menu)))
		{
			/*if(($_GET['fun'] == 'modgita') && (is_numeric($_POST['invio'])))
				mail("dibella.antonino@gmail.com","Controllo Titolo gita. 0 < $user->rand >","Prima di chiamare modgita.\nTitoloPOST=<".$_POST['titolo'].">\n".$_SERVER["HTTP_USER_AGENT"]);*/
			call_user_func(array(&$user,$_GET['fun']));
		}
		else
		{
		  echo "ERRORE, PERMESSI NON SUFFICENTI PER UTILIZZARE QUESTA FUNZIONE.<br>CONTATTARE L'AMMINISTRATORE DEL SITO";
		  exit;
		}
	}
	if($_GET['menu'] == 'no')
	{
		makeTail();
		exit;
	}
?>

<h1><em>my</em> Bici&amp;Dintorni [area riservata]
</h1>
<div id="welcome">Ciao, <b><a href="admin.php?fun=consulta_profilo"><?echo $user->nome." ".$user->cognome; 
?></a></b></div>
<p>Consulta i <a href="http://www.biciedintorni.it/wordpress/associazione/verbali/">verbali delle assemblee e dei consigli direttivi</a></p>
<p>Scarica la <a href="http://www.biciedintorni.it/wordpress/associazione/modulistica-interna/">modulistica ad uso interno</a></p>
<div align="center"><?php echo $user->get_area(); ?></div>
<!-- <div align="center" style="text-align: center;height:536px;background-image: url(img/sfondo.jpg);background-repeat: no-repeat;">  -->
<div align="center" style="text-align: center;height:536px;background-repeat: no-repeat;">
<table border="1" align="center">
<tr><th>Menu Gite &amp; Eventi</th><th>Menu Amministrativo</th><th>Menu Biblioteca</th></tr>
<?php 
	foreach($user->menu as $key => $value)
	{
		if(in_array($value,$fun_gite))
		{
			//style=\"color: #0000FF; width: 220px; height: 26px;background: url('img/bottonelungo2.jpg');\" 
			$menu_gite .="<button class=\"bottonimenu\" id=\"".$value."\" onmouseup=\"document.getElementById('".$value."').style.background = '#0000FF url(img/bottonelungo2.jpg) center no-repeat';\" onmousedown=\"document.getElementById('".$value."').style.background = '#FF0000 url(img/bottonelungo2.jpg) center no-repeat';\" onclick=\"window.location='".$dove."?fun=".$value."'\">".$key."</button><br><br>\n";
			//$menu_gite .= "<a href=\"$dove?fun=$value\"><img src=\"img/".$value.".jpg\" title=\"".$key."\" alt=\"".$key."\"></a><br><br>\n";
		}
		if(in_array($value,$fun_amm))
		{
			//$menu_amm .= "<a href=\"$dove?fun=$value\"><img src=\"img/".$value.".jpg\" title=\"".$key."\" alt=\"".$key."\"></a><br><br>\n";
			$menu_amm .="<button class=\"bottonimenu\" id=\"".$value."\" onmouseup=\"document.getElementById('".$value."').style.background = '#0000FF url(img/bottonelungo2.jpg) center no-repeat';\" onmousedown=\"document.getElementById('".$value."').style.background = '#FF0000 url(img/bottonelungo2.jpg) center no-repeat';\" onclick=\"window.location='".$dove."?fun=".$value."'\">".$key."</button><br><br>\n";
		}
		if(in_array($value,$fun_biblio))
		{
			//$menu_amm .= "<a href=\"$dove?fun=$value\"><img src=\"img/".$value.".jpg\" title=\"".$key."\" alt=\"".$key."\"></a><br><br>\n";
			$menu_biblio .="<button class=\"bottonimenu\" id=\"".$value."\" onmouseup=\"document.getElementById('".$value."').style.background = '#0000FF url(img/bottonelungo2.jpg) center no-repeat';\" onmousedown=\"document.getElementById('".$value."').style.background = '#FF0000 url(img/bottonelungo2.jpg) center no-repeat';\" onclick=\"window.location='".$dove."?fun=".$value."'\">".$key."</button><br><br>\n";
		}
	}
	//echo "<tr><td align=\"center\">$menu_gite</td><td align=\"center\">$menu_amm <a href=\"logout.php\"><img src=\"img/logout.jpg\" title=\"LogOut\" alt=\"LogOut\"></a></td><td align=\"center\">$menu_biblio</td></tr>";
	echo "<tr><td align=\"center\">$menu_gite</td><td align=\"center\">$menu_amm <a href=\"http://www.biciedintorni.it/wordpress/associazione/verbali/\"><button class=\"bottonimenu\" id=\"verbali\" onmouseup=\"document.getElementById('verbali').style.background = '#0000FF url(img/bottonelungo2.jpg)
	center no-repeat';\" onmousedown=\"document.getElementById('verbali').style.background = '#FF0000 url(img/bottonelungo2.jpg) center no-repeat';\" onclick=\"http://www.biciedintorni.it/wordpress/associazione/verbali/\">Visualizza i Verbali</button></a><br><br><a href=\"logout.php\"><img src=\"img/logout.jpg\" title=\"LogOut\" alt=\"LogOut\"></a><br><br></td><td align=\"center\">$menu_biblio</td></tr>";
	//echo "<tr><td align=\"center\">$menu_gite</td><td align=\"center\">$menu_amm <button class=\"bottonimenu\" id=\"verbali\" onmouseup=\"document.getElementById('verbali').style.background = '#0000FF url(img/bottonelungo2.jpg) 
	//center no-repeat';\" onmousedown=\"document.getElementById('verbali').style.background = '#FF0000 url(img/bottonelungo2.jpg) center no-repeat';\" onclick=\"window.location='../index.php?option=com_content&task=view&id=27'\">Visualizza i Verbali</button><br><br><a href=\"logout.php\"><img src=\"img/logout.jpg\" title=\"LogOut\" alt=\"LogOut\"></a><br><br></td><td align=\"center\">$menu_biblio</td></tr>";
?>
</table>
</div>
<?php 
  /*foreach($user->menu as $key => $value)
  {
  	
  	
  	
  	echo '<a href="'.$dove.'?fun='.$value.'">'.$key."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$value<br>";
  }
  	//echo $value."<br>";*/
makeTail();
?>
